<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterAsset;
use App\Models\Setting\MasterSatgas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('dashboard-index');
    }
    public function getCountingAsset()
    {
        $oppd = DB::table('master_assets as a')
            ->join('master_satgas as b', 'a.satgas', '=', 'b.name')
            ->select(DB::raw('COUNT(a.id) as total'))
            ->whereNot('a.kondisi','')
            ->first();
    
        $countOppd = DB::table('master_assets as a')
            ->select(DB::raw('COUNT(a.id) as total, a.kondisi'))
            ->join('master_satgas as b', 'a.satgas', '=', 'b.name')
            ->groupBy('a.kondisi')
            ->whereNot('a.kondisi','')
            ->get();
    
        $labels = $countOppd->pluck('kondisi'); // Extract 'kondisi' values
        $data = $countOppd->pluck('total');    // Extract 'total' values
    
        $unifil = DB::table('master_assets as a')
            ->join('master_satgas as b', 'a.satgas', '=', 'b.name')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'UNIFIL')
            ->groupBy('b.type')
            ->get();
    
        $minusca = DB::table('master_assets as a')
            ->join('master_satgas as b', 'a.satgas', '=', 'b.name')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'KIZI MINUSCA')
            ->groupBy('b.type')
            ->get();
    
        $monusca = DB::table('master_assets as a')
            ->join('master_satgas as b', 'a.satgas', '=', 'b.name')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'KIZI MONUSCO')
            ->groupBy('b.type')
            ->get();
    
        $bgc_monusca = DB::table('master_assets as a')
            ->join('master_satgas as b', 'a.satgas', '=', 'b.name')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'BGC MONUSCO')
            ->groupBy('b.type')
            ->get();
    
        $group = MasterSatgas::select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->orderBy('id', 'asc')
            ->get();
    
        $country = DB::table('master_assets as a')
            ->join('master_satgas as c', 'a.satgas', '=', 'c.name')
            ->select(DB::raw('COUNT(a.id) as total, c.country, c.x, c.y'))
            ->groupBy('c.country', 'c.x', 'c.y')
            ->where('a.kondisi', '!=', '')
            ->get();

    
        return response()->json([
            'oppd' => $oppd,
            'countOppd' => $countOppd,
            'labels' => $labels,   // Add labels for the radial chart
            'data' => $data,       // Add data for the radial chart
            'unifil' => $unifil,
            'minusca' => $minusca,
            'monusca' => $monusca,
            'group' => $group,
            'bgc_monusca' => $bgc_monusca,
            'country' => $country,
        ]);
    }
    
    function assetChart() {
        $data = DB::table('master_assets as a')
        ->select(DB::raw('COUNT(a.id) as total'), 'a.kondisi')
        ->join('master_satgas as b','a.satgas','b.name')
        // ->where('b.type','like','%'.$request->type.'%')
        ->groupBy('a.kondisi')
        ->get();
     
        return response()->json([
            'data' => $data,
        ]);
    }
    function assetChartFilter(Request $request) {
        $data = DB::table('master_assets as a')
        ->select(DB::raw('COUNT(a.id) as total'), 'a.kondisi')
        ->join('master_satgas as b','a.satgas','b.name')
        ->where('b.type','like','%'.$request->type.'%')
        ->groupBy('a.kondisi')
        ->get();
     
        return response()->json([
            'data' => $data,
        ]);
    }
  
}
