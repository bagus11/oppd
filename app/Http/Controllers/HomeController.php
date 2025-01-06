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
    
        $countOppd = DB::table('assets as a')
            ->select(DB::raw('COUNT(a.id) as total, a.kondisi'))
            ->join('master_satgas as b', 'a.lokasi', '=', 'b.id')
            ->groupBy('a.kondisi')
            ->whereNot('a.kondisi','')
            ->get();
    
        $labels = $countOppd->map(function ($item) {
            switch ($item->kondisi) {
                case 1: return 'Baik';
                case 2: return 'RR OPS';
                case 3: return 'RB';
                case 4: return 'RR TDK OPS';
                case 5: return 'M';
                case 6: return 'D';
                default: return 'Unknown';
            }
        });
            
            // Get totals for labels
            $totals = $countOppd->pluck('total');
        $data = $countOppd->pluck('total');    // Extract 'total' values
    
        $unifil = DB::table('assets as a')
            ->join('master_satgas as b', 'a.lokasi', '=', 'b.id')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'UNIFIL')
            ->groupBy('b.type')
            ->get();
    
        $minusca = DB::table('assets as a')
            ->join('master_satgas as b', 'a.lokasi', '=', 'b.id')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'KIZI MINUSCA')
            ->groupBy('b.type')
            ->get();
    
        $monusca = DB::table('assets as a')
            ->join('master_satgas as b', 'a.lokasi', '=', 'b.id')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'KIZI MONUSCO')
            ->groupBy('b.type')
            ->get();
    
        $bgc_monusca = DB::table('assets as a')
            ->join('master_satgas as b', 'a.lokasi', '=', 'b.id')
            ->select(DB::raw('COUNT(a.id) as total, b.type'))
            ->where('b.type', 'BGC MONUSCO')
            ->groupBy('b.type')
            ->get();
    
        $group = MasterSatgas::select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->orderBy('id', 'asc')
            ->get();
    
            $country = DB::table('assets as a')
            ->join('master_satgas as c', 'a.lokasi', '=', 'c.id')
            ->select(DB::raw('COUNT(a.id) as total, c.country, c.x, c.y'))
            ->groupBy('c.country', 'c.x', 'c.y') // Include c.country in GROUP BY
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
        $data = DB::table('assets as a')
        ->select(DB::raw('COUNT(a.id) as total'), 'a.kondisi')
        ->join('master_satgas as b','a.lokasi','b.id')
        // ->where('b.type','like','%'.$request->type.'%')
        ->groupBy('a.kondisi')
        ->get();
        $mappedData = $data->map(function ($item) {
            $item->kondisi_label = match ($item->kondisi) {
                1 => 'Baik',
                2 => 'RR OPS',
                3 => 'RB',
                4 => 'RR TDK OPS',
                5 => 'M',
                6 => 'D',
                default => 'Unknown',
            };
            return $item;
        });
    
        return response()->json([
            'data' => $mappedData,
        ]);
    }
    function assetChartFilter(Request $request) {
        $data = DB::table('assets as a')
        ->select(DB::raw('COUNT(a.id) as total'), 'a.kondisi')
        ->join('master_satgas as b','a.lokasi','b.id')
        ->where('b.type','like','%'.$request->type.'%')
        ->groupBy('a.kondisi')
        ->get();
        $mappedData = $data->map(function ($item) {
            $item->kondisi_label = match ($item->kondisi) {
                1 => 'Baik',
                2 => 'RR OPS',
                3 => 'RB',
                4 => 'RR TDK OPS',
                5 => 'M',
                6 => 'D',
                default => 'Unknown',
            };
            return $item;
        });
    
        return response()->json([
            'data' => $mappedData,
        ]);
    }
  
}
