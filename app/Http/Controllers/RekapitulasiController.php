<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Penjualan;
use App\Tabungan;
use App\Sedekah;
use App\Penadah;
use App\Sampah;
use App\Satuan;
use App\Lokasi;
use App\Status;
use App\Stock;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class RekapitulasiController extends Controller
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

        return view('backEnd.rekapitulasi.stocks', compact('filters', 'id', 'datenow'));
    }

    public function tabungan()
    {
        $stocks = Stock::all();
        $wilayah = Status::where('parent_id', 20)->get();
        $id = "";
        $datenow = date('Y-m-d');

        return view('backEnd.rekapitulasi.tabungan', compact('tables', 'stocks', 'wilayah', 'id', 'datenow'));
    }
   
     public function rektabunganapi()
    {
        $filterdata= ""; $filterdata2= ""; $filterdata3= ""; $filterRange= "";
        $unit = Input::get('unit');
        $status = Input::get('status');
        $kosong = Input::get('kosong');
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');
        
        if (!empty($unit)) {
            $filterdata = "AND n.group_code = '$unit'";
        }
        if (!empty($status)) {
            $filterdata3 = "AND n.status = '$status'";
        }
        if (!empty($kosong)) {
            $filterdata2 = " HAVING (sum(kredit)-sum(debit)) = 0";
        }
        if (!empty($fromDate) && empty($toDate)){
            $filterRange = "AND DATE(t.created_at) = '$fromDate' ";
        }
        if (!empty($toDate) && empty($fromDate)){
            $filterRange = "AND DATE(t.created_at) = '$toDate' ";
        }
        if (!empty($toDate) && !empty($fromDate)){
            $filterRange = "AND DATE(t.created_at) BETWEEN '$fromDate' AND '$toDate'";
        } 

        $tables = DB::select(
                DB::raw("SELECT max(n.id) as id, MAX(n.norek) as norek , MAX(n.nama_depan) as nasabah 
                        ,sum(t.debit) as debit
                        ,sum(t.kredit) as kredit
                        ,sum(t.kredit) - sum(t.debit) as saldo
                        ,sum(t.saldo_sampah) as saldo_sampah
                        ,max(t.created_at) as created_at
                from nasabahs n 
                LEFT JOIN tabungans t on n.norek = t.norek
                LEFT JOIN statuses s on s.id = n.status
                WHERE 1 = 1 $filterdata   $filterdata3 $filterRange
                GROUP BY n.norek $filterdata2")
      );

        return Datatables::of($tables)->make(true);
    }

    public function rekstocksapi()
    {
        $filterdata= "";
        $gudang = Input::get('gudang');

        if (!empty($gudang)) {
            $filterdata = "WHERE gudang_id = '$gudang'";
        }

        $tables = DB::select(
            DB::raw("SELECT *
            FROM v_recap_stocks
            $filterdata
            ORDER BY `created_at` asc")
        );

        return Datatables::of($tables)->make(true);
    }


   
}
