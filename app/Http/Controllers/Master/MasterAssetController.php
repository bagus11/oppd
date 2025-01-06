<?php

namespace App\Http\Controllers\Master;

use App\Helper\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreMasterAsset;
use App\Http\Requests\Master\UpdateMasterAsset;
use App\Models\Master\Asset;
use App\Models\Master\AssetLog;
use App\Models\Master\MasterAsset;
use App\Models\Setting\Inventory_type;
use App\Models\Setting\InventoryBrand;
use App\Models\Setting\InventoryCategory;
use App\Models\Setting\InventorySubCategory;
use App\Models\Setting\MasterSatgas;
use Database\Seeders\InventoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumConvert;
use Yajra\DataTables\Facades\DataTables;
class MasterAssetController extends Controller
{
    function index() {
        return view('master.asset.asset-index');
    }
    
    function getMasterAsset(Request $request) {
       
        $data = Asset::with([
            'categoryRelation',
            'subCategoryRelation',
            'typeRelation',
            'merkRelation',
            'satgasRelation',
        ])->get();
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
    function getInventoryCategory() {
        $data =  InventoryCategory::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    function getInventorySubCategory() {
        $data =  InventorySubCategory::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    function getInventoryType() {
        $data =  Inventory_type::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    
    function getInventoryBrand() {
        $data =  InventoryBrand::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    function addMasterAsset(Request $request, StoreMasterAsset $storeMasterAsset) {
        // try{
            $storeMasterAsset->validated();
            $increment_code= Asset::orderBy('id','desc')->first();
            $date_month =strtotime(date('Y-m-d'));
            $month =idate('m', $date_month);
            $year = idate('y', $date_month);
            $month_convert =  NumConvert::roman($month);
            if($increment_code ==null){
                $ticket_code = '1/ASSET/'.$month_convert.'/'.$year;
            }else{
                $month_before = explode('/',$increment_code->asset_code);
               
                if($month_convert != $month_before[2]){
                    $ticket_code = '1/ASSET/'.$month_convert.'/'.$year;
                }else{
                    $ticket_code = $month_before[0] + 1 .'/ASSET/'.$month_convert.'/'.$year;
                }   
            }
            // dd($ticket_code);
            $post=[
                'asset_code'    => $ticket_code,
                'no_un'         =>$request->no_un,
                'no_rangka'         =>$request->no_rangka,
                'no_mesin'         =>$request->no_mesin,
                'kategori'          =>$request->kategori,
                'subkategori'          =>$request->subkategori,
                'jenis'          =>$request->jenis,
                'merk'          =>$request->merk,
                'user_id'       =>auth()->user()->id,
                'pic'           =>0,
                'kondisi'           =>0,
                'lokasi'        =>0
            ];
            Asset::create($post);
            AssetLog::create($post);
            return ResponseFormatter::success(
                $post,
                 'Asset berhasil ditambahkan'
             );          
        // }catch (\Throwable $th) {
        //     return ResponseFormatter::error(
        //         $th,
        //         'Asset gagal ditambahkan',
        //         500
        //     );
        // }
       
    }
    function getLogAsset(Request $request) {
        $data = AssetLog::with([
            'categoryRelation',
            'subCategoryRelation',
            'typeRelation',
            'merkRelation',
            'picRelation',
        ])->where('asset_code', $request->asset_code)->orderBy('id','desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }
        return response()->json([
            'data'=>$data,
        ]);
    }
    function getSatgas() {
        $data = MasterSatgas::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    
    function updateAsset(Request $request, UpdateMasterAsset $updateMasterAsset ) {
         // try{
            $updateMasterAsset->validated();
            $detail = Asset::where('asset_code', $request->asset_code)->first();
            $post=[
                'asset_code'        => $detail->asset_code,
                'no_un'             =>$request->edit_no_un,
                'no_rangka'         =>$request->edit_no_rangka,
                'no_mesin'          =>$request->edit_no_mesin,
                'kategori'          =>$request->edit_kategori,
                'subkategori'       =>$request->edit_subkategori,
                'jenis'             =>$request->edit_jenis,
                'merk'              =>$request->edit_merk,
                'user_id'           =>$detail->user_id,
                'pic'               =>$detail->pic,
                'kondisi'           =>$detail->kondisi,
                'lokasi'            =>$detail->lokasi
            ];
            $post_log =[
                'asset_code'        => $detail->asset_code,
                'no_un'             =>$request->edit_no_un,
                'no_rangka'         =>$request->edit_no_rangka,
                'no_mesin'          =>$request->edit_no_mesin,
                'kategori'          =>$request->edit_kategori,
                'subkategori'       =>$request->edit_subkategori,
                'jenis'             =>$request->edit_jenis,
                'merk'              =>$request->edit_merk,
                'user_id'           =>auth()->user()->id,
                'pic'               =>$detail->pic,
                'kondisi'           =>$detail->kondisi,
                'lokasi'            =>$detail->lokasi
            ];
            Asset::where('asset_code', $request->asset_code)->update($post);
            AssetLog::create($post_log);
            return ResponseFormatter::success(
                $post,
                 'Asset berhasil ditambahkan'
             );          
        // }catch (\Throwable $th) {
        //     return ResponseFormatter::error(
        //         $th,
        //         'Asset gagal ditambahkan',
        //         500
        //     );
        // }
    }
 
    
}
