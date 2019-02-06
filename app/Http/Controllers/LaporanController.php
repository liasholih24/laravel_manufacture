<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Penjualan;
use App\Pembelian;
use App\Satuan;
use App\Lokasi;
use App\Stock;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class LaporanController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function stocks()
    {
        $filters = Lokasi::where('depth', 0)->get();
        $id = "";
        $datenow = date('Y-m-d');

        return view('backEnd.laporan.stocks', compact('filters', 'id', 'datenow'));
    }

    public function tabungan()
    {
        return view('backEnd.laporan.tabungan');
    }

    public function penjualan()
    {
        $filters = Penadah::all();

        return view('backEnd.laporan.penjualan', compact('filters'));
    }
    public function pembelian()
    {
        $filters = Penadah::all();

        return view('backEnd.laporan.pembelian', compact('filters'));
    }

    public function stocksapi()
    {
        $filterdata= ""; $filterRange= "";
        $gudang = Input::get('gudang');
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');


        if (!empty($gudang)) {
            $filterdata = "AND gudang_id = '$gudang'";
        }
        if (!empty($fromDate) && empty($toDate)){
            $filterRange = "AND DATE(`date`) = '$fromDate' ";
        }
        if (!empty($toDate) && empty($fromDate)){
            $filterRange = "AND DATE(`date`) = '$toDate' ";
        }
        if (!empty($toDate) && !empty($fromDate)){
            $filterRange = "AND DATE(`date`) BETWEEN '$fromDate' AND '$toDate'";
        }

        $tables = DB::select(
                DB::raw("SELECT *
        FROM v_date_stocks
        WHERE 1 = 1 $filterdata $filterRange
        ORDER BY `created_at` asc")
      );
       

        return Datatables::of($tables)->make(true);
    }

    

   

    public function penjualanapi(Request $request)
    {
        $tables = Penjualan::select('id', 'code', 'perusahaan','total_kg', 'total_rp', 'perusahaan', 'keterangan','created_at')
        ->with(['getperusahaan'=> function ($query) {
            $query->select('id', 'name');
        }]);
        if ($request->fromDate&&$request->toDate) {
            $tables->whereBetween('created_at', [$request->fromDate,$request->toDate]);
        }
    
        $tables= $tables->get();
        return Datatables::of($tables)
        ->editColumn('total_rp', function ($tables) {
            return number_format($tables->total_rp, 0);
        })
        ->editColumn('total_kg', function ($tables) {
            return number_format($tables->total_kg, 0);
        })
      
        ->make(true);
    }
     public function pembelianapi(Request $request)
    {
        $tables = Pembelian::select('id', 'code', 'total_kg', 'total_rp', 'name', 'keterangan','created_at')
        ;
        if ($request->fromDate&&$request->toDate) {
            $tables->whereBetween('created_at', [$request->fromDate,$request->toDate]);
        }
        if ($request->gudang) {
            $tables->where('gudang', $request->gudang);
        }
        $tables= $tables->get();
        return Datatables::of($tables)
        ->editColumn('total_rp', function ($tables) {
            return number_format($tables->total_rp, 0);
        })
        ->editColumn('total_kg', function ($tables) {
            return number_format($tables->total_kg, 0);
        })
       
        ->make(true);
    }
}
