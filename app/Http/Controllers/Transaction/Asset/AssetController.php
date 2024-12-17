<?php

namespace App\Http\Controllers\Transaction\Asset;

use App\Helper\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterAsset;
use App\Models\Setting\MasterSatgas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    public function index()
    {
        return view('transaction.asset.asset-index');
    }
    
    public function getAsset(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterAsset::all();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="btn btn-sm btn-warning edit" data-id="' . $row->id . '">
                    <i class="fas fa-edit"></i>
                    </button>';
                    $printBtn = '<button class="btn btn-sm btn-success edit" data-id="' . $row->id . '">
                    <i class="fas fa-file"></i>
                    </button>';
                    return $editBtn.' '.$printBtn ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return abort(403, 'Unauthorized action.');
    }
    public function getAssetFilter(Request $request)
    {
        if ($request->ajax()) {
            $data =  DB::table('master_assets as a')->select('a.*')
            ->join('master_satgas as b','a.satgas','b.name')
            ->where('b.type', $request->type)
            // ->groupBy('a.kondisi')
            ->get();
    
            return DataTables::of($data)->make(true);
        }
    
        return abort(403, 'Unauthorized action.');
    }
    function getMasterSatgas() {
        $data = MasterSatgas::all();
        return response()->json([
            'data'=>$data,
            
        ]);  
    
    }
    function addAsset(Request $request) {
        // try {
            for($i = 0; $i < 99 ; $i ++){
                $post =[
                    'satgas' =>$request->satgas,
                    'no_un' =>'DUMMY_'.$i,
                    'category' =>'CATEGORY_'.$i,
                    'sub_category' =>'SUBCATEGORY_'.$i,
                    'type' =>'DUMMY_TYPE_'.$i,
                    'brand' =>'DUMMY_BRAND_'.$i,
                    'no_mesin' =>'DUMMY_MACHIINE_'.$i,
                    'no_rangka' =>'DUMMY_NO_RANGKA_'.$i,
                    'kondisi' =>$request->kondisi,
                    'country' =>3,
                    'keterangan' =>'DUMMY TESTING',
                    'user_id' =>1,
                    'status_pengajuan' =>1,
                    'pengajuan' =>1,
                ];
                MasterAsset::create($post);
            }
            return ResponseFormatter::success(
                $post,
                 'Menus successfully added'
             );          
            
        // } catch (\Throwable $th) {
        //     return ResponseFormatter::error(
        //         $th,
        //         'Menus failed to update',
        //         500
        //     );
        // }
       

    }
    function getPengajuanAsset(Request $request)  {
        if ($request->ajax()) {
            $data = MasterAsset::whereIn('pengajuan',[1])->get();
            return DataTables::of($data)
                ->make(true);
        }
    }
    function getPengajuanAssetFilter(Request $request)  {
        // dd($request->pengajuan);
        if ($request->ajax()) {
            $data = MasterAsset::where('pengajuan',$request->pengajuan)->get();
            return DataTables::of($data)
                ->make(true);
        }
    }
}
