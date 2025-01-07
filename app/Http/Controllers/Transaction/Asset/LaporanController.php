<?php

namespace App\Http\Controllers\Transaction\Asset;

use App\Http\Controllers\Controller;
use App\Models\Master\Asset;
use App\Models\Transaction\Asset\Maintenance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    function index() {
        return view('transaction.asset.laporan.laporan-index');
    }

    function getMaintenance(Request $request) {
        $data = Maintenance::with([
            'assetRelation',
            'userRelation',
            'assetRelation.categoryRelation',
            'assetRelation.subCategoryRelation',
            'assetRelation.typeRelation',
            'assetRelation.merkRelation',
            'assetRelation.satgasRelation',
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
    function getAssetMaintenance(Request $request) {
        $data = Asset::with([
            'categoryRelation',
            'subCategoryRelation',
            'typeRelation',
            'merkRelation',
            'satgasRelation',
        ])->whereNot('kondisi',1)->get();
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
}
