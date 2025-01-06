<?php

namespace App\Http\Controllers\Transaction\Asset;

use App\Helper\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\Asset\Inventaris\StoreInventaris;
use App\Http\Requests\Transaction\Asset\Inventaris\UpdateInventaris;
use App\Models\Master\Asset;
use App\Models\Master\AssetLog;
use App\Models\Setting\MasterSatgas;
use App\Models\Transaction\Asset\Inventaris;
use App\Models\Transaction\Asset\InventarisLog;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use NumConvert;
use Yajra\DataTables\Facades\DataTables;

class AssetInventarisController extends Controller
{
    function index() {
        return view('transaction.asset.asset_inventaris.asset_inventaris-index');
    }
    function getDetailAsset(Request $request) {
        $detail = Asset::with([
            'categoryRelation',
            'subCategoryRelation',
            'typeRelation',
            'merkRelation',
            'satgasRelation',
        ])->where('asset_code', $request->asset_code)->first();
        return response()->json([
            'detail'=>$detail,
        ]);
    }
    function getInventaris(Request $request) {
        $data = Inventaris::with(
            [
                'satgasRelation',
                'assetRelation.categoryRelation',
                'assetRelation.subCategoryRelation',
                'assetRelation.typeRelation',
                'assetRelation.merkRelation',
            ]
        )->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="btn btn-sm btn-warning edit" data-id="' . $row->id . '">
                    <i class="fas fa-edit"></i>
                    </button>';
                    $printBtn = '<button class="btn btn-sm btn-success print" data-id="' . $row->id . '">
                    <i class="fas fa-file"></i>
                    </button>';
                    $return =
                    ' '
                    .$printBtn ;
                    return $return;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return response()->json([
            'data'=>$data,
        ]);
        
    }
    function getInventarisLog(Request $request) {
    
        $data = InventarisLog::with(
            [
                'satgasRelation',
                'reporterRelation',
                'userRelation',
                'assetRelation.categoryRelation',
                'assetRelation.subCategoryRelation',
                'assetRelation.typeRelation',
                'assetRelation.merkRelation',
            ]
        )->where('inventaris_code',$request->inventaris_code)->get();
        
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="btn btn-sm btn-warning edit" data-id="' . $row->id . '">
                    <i class="fas fa-edit"></i>
                    </button>';
                    $printBtn = '<button class="btn btn-sm btn-success print" data-id="' . $row->id . '">
                    <i class="fas fa-file"></i>
                    </button>';
                    $return =
                    ' '
                    .$printBtn ;
                    return $return;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return response()->json([
            'data'=>$data,
        ]);
        
    }
    function addInventaris(Request $request, StoreInventaris $storeInventaris) {
        // try {
            // Validate input
            $storeInventaris->validated();

            // Get the last increment code
            $increment_code = Inventaris::orderBy('id', 'desc')->first();
            $file=null;
            // Get the current month and year
            $currentDate = strtotime(date('Y-m-d'));
            $month = idate('m', $currentDate);
            $year = idate('y', $currentDate);
        
            // Convert month to Roman numeral
            $month_convert = NumConvert::roman($month);
        
            // Generate ticket code
            if ($increment_code === null) {
                $ticket_code = '1/INV/' . $month_convert . '/' . $year;
            } else {
                $month_before = explode('/', $increment_code->inventaris_code);
        
                if ($month_convert !== $month_before[2]) {
                    $ticket_code = '1/INV/' . $month_convert . '/' . $year;
                } else {
                    $ticket_code = ($month_before[0] + 1) . '/INV/' . $month_convert . '/' . $year;
                }
            }
        
            // Replace '/' with '_' in the ticket code for file naming
            $sanitized_ticket_code = str_replace('/', '_', $ticket_code);
        
            // Handle file attachment upload
            $attachmentPath = '';
            $attachmentPathLog = '';
            $fileName='';
            $fileNameLog='';
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileNameLog = $sanitized_ticket_code . '_' . time() . '.' . $file->getClientOriginalExtension(); // Add timestamp to prevent overwriting
                $fileName = $sanitized_ticket_code . '.' . $file->getClientOriginalExtension();
                $attachmentPath = 'transaction/asset/inventaris/' . $fileName;
                $attachmentPathLog = 'transaction/asset/inventarisLog/' . $fileNameLog;
            }
        
            // Get Satgas type and Asset
            $satgas_type = MasterSatgas::find($request->satgas);
            $asset = Asset::where('asset_code', $request->asset)->first();
        
            // Data for the inventaris table
            $postInventaris = [
                'inventaris_code' => $ticket_code,
                'bulan'           => $request->bulan,
                'satgas'          => $request->satgas,
                'satgas_type'     => $satgas_type->type,
                'reporter'        => $request->reporter,
                'asset_code'      => $request->asset,
                'kondisi'         => $request->kondisi,
                'user_id'         => auth()->user()->id,
                'catatan'         => $request->catatan,
                'attachment'      => $request->hasFile('attachment') ? $attachmentPath : '', // Store the attachment path
            ];
            // dd($attachmentPath);
            $postInventarisLog=[
                'inventaris_code'    => $ticket_code,
                'bulan'    => $request->bulan,
                'satgas'    => $request->satgas,
                'satgas_type'    => $satgas_type->type,
                'reporter'      =>$request->reporter,
                'asset_code'    =>$request->asset,
                'kondisi'       =>$request->kondisi,
                'user_id'       =>auth()->user()->id,
                'catatan'       =>$request->catatan,
                'attachment'      => $request->hasFile('attachment') ? $attachmentPathLog : '', // Store the attachment path
                'remark'        => auth()->user()->name.'telah mengupdate data aset'
            ];

            $assetLog=[
                'asset_code'    =>$request->asset,
                'no_un'         =>$asset->no_un,
                'no_rangka'     =>$asset->no_rangka,
                'no_mesin'      =>$asset->no_mesin,
                'kategori'      =>$asset->kategori,
                'subkategori'   =>$asset->subkategori,
                'jenis'         =>$asset->jenis,
                'merk'          =>$asset->merk,
                'user_id'       =>auth()->user()->id,
                'pic'           =>$request->reporter,
                'kondisi'       =>$request->kondisi,
                'lokasi'        =>$asset->lokasi == 0 ?$request->satgas : $asset->lokasi
            ];
            $assetPost =[
                'kondisi'   => $request->kondisi,
                'user_id'   => auth()->user()->id,
                'lokasi'   => $asset->lokasi == 0 ??$request->satgas,
            ];

            DB::transaction(function() use($request, $postInventaris,$postInventarisLog,$assetPost,$asset,$assetLog, $file,$fileName,$fileNameLog) {
                if($request->file('attachment')){
                    $file->storeAs('transaction/asset/inventaris',$fileName,'public');
                    $file->storeAs('transaction/asset/inventarisLog',$fileNameLog,'public');
                }
                Inventaris::create($postInventaris);
                InventarisLog::create($postInventarisLog);
                Asset::where('asset_code',$request->asset)->update($assetPost);
                AssetLog::create($assetLog);

            });
            
            return ResponseFormatter::success(
                $postInventaris,
                'Asset berhasil ditambahkan'
            );
        // } catch (\Throwable $th) {
        //     return ResponseFormatter::error(
        //         $th->getMessage(),
        //         'Asset gagal ditambahkan',
        //         500
        //     );get
        // }
        
    }
   
    function updateInventaris(Request $request, UpdateInventaris $updateInventaris)
{
    // Validate the incoming request
    $updateInventaris->validated();
    $file=null;
    // Sanitize the inventaris code
    $sanitized_ticket_code = str_replace('/', '_', $request->inventaris_code);

    // Handle file attachment upload
    $attachmentPath = '';
    $attachmentPathLog = '';
    $fileName = '';
    $fileNameLog = '';
    if ($request->hasFile('edit_attachment')) {
        $file = $request->file('edit_attachment');
        $fileNameLog = $sanitized_ticket_code . '_' . time() . '.' . $file->getClientOriginalExtension(); // Add timestamp to prevent overwriting
        $fileName = $sanitized_ticket_code . '.' . $file->getClientOriginalExtension();
        $attachmentPath = 'transaction/asset/inventaris/' . $fileName;
        $attachmentPathLog = 'transaction/asset/inventarisLog/' . $fileNameLog;
    }

    // Get Satgas type and Asset
    $satgas_type = MasterSatgas::find($request->edit_satgas);
    $asset = Asset::where('asset_code', $request->edit_asset)->first();

    // Data for the inventaris table
    $postInventaris = [
        'bulan'           => $request->edit_bulan,
        'satgas'          => $request->edit_satgas,
        'satgas_type'     => $satgas_type->type,
        'reporter'        => $request->edit_reporter,
        'asset_code'      => $request->edit_asset,
        'kondisi'         => $request->edit_kondisi,
        'user_id'         => auth()->user()->id,
        'catatan'         => $request->edit_catatan,
        'attachment'      => $request->hasFile('edit_attachment') ? $attachmentPath : '', // Store the attachment path
    ];
    // dd($postInventaris);
    // Data for the inventaris log table
    $postInventarisLog = [
        'inventaris_code' => $request->inventaris_code,
        'bulan'           => $request->edit_bulan,
        'satgas'          => $request->edit_satgas,
        'satgas_type'     => $satgas_type->type,
        'reporter'        => $request->edit_reporter,
        'asset_code'      => $request->edit_asset,
        'kondisi'         => $request->edit_kondisi,
        'user_id'         => auth()->user()->id,
        'catatan'         => $request->edit_catatan,
        'attachment'      => $request->hasFile('edit_attachment') ? $attachmentPathLog : '', // Store the attachment path
        'remark'          => auth()->user()->name . ' telah mengupdate data aset',
    ];

    // Data for the asset log table
    $assetLog = [
        'asset_code'  => $request->edit_asset,
        'no_un'       => $asset->no_un,
        'no_rangka'   => $asset->no_rangka,
        'no_mesin'    => $asset->no_mesin,
        'kategori'    => $asset->kategori,
        'subkategori' => $asset->subkategori,
        'jenis'       => $asset->jenis,
        'merk'        => $asset->merk,
        'user_id'     => auth()->user()->id,
        'pic'         => $request->edit_reporter,
        'kondisi'     => $request->edit_kondisi,
        'lokasi'      => $asset->lokasi == 0 ? $request->edit_satgas : $asset->lokasi,
    ];

    // Data for the asset update
    $assetPost = [
        'kondisi' => $request->edit_kondisi,
        'user_id' => auth()->user()->id,
        'lokasi'  => $asset->lokasi == 0 ? $request->edit_satgas : $asset->lokasi,
    ];

    DB::transaction(function () use ($request, $postInventaris, $postInventarisLog, $assetPost, $asset, $assetLog, $file, $fileName,$fileNameLog) {
        if ($request->hasFile('edit_attachment')) {
            // Store file in the specified directories
            $oldFilePath = 'public/transaction/asset/inventaris/' . $fileName;

            // Check if the old file exists
            if (Storage::exists($oldFilePath)) {
                Storage::delete($oldFilePath); // Delete the old file
            }
        
            // Store the new file
            $file->storeAs('transaction/asset/inventaris', $fileName, 'public');
            $file->storeAs('transaction/asset/inventarisLog', $fileNameLog, 'public');
        }

        // Insert data into the respective tables
        Inventaris::where('inventaris_code',$request->inventaris_code)->update($postInventaris);
        InventarisLog::create($postInventarisLog);
        Asset::where('asset_code', $request->edit_asset)->update($assetPost);
        AssetLog::create($assetLog);
    });

    return ResponseFormatter::success(
        $postInventaris,
        'Asset berhasil ditambahkan'
    );
}

}
