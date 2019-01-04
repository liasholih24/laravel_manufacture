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
        $stocks = Stock::all();
        $filters = Lokasi::where('type', 13)->get();
        $id = "";
        $datenow = date('Y-m-d');

        return view('backEnd.rekapitulasi.stocks', compact('tables', 'stocks', 'filters', 'id', 'datenow'));
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
        $filterdata= ""; $filterRange= "";
        $gudang = Input::get('gudang');
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');
        

        if (!empty($gudang)) {
            $filterdata = "AND a.gudang = '$gudang'";
        }
        if (!empty($fromDate) && empty($toDate)){
            $filterRange = "AND DATE(a.created_at) = '$fromDate' ";
        }
        if (!empty($toDate) && empty($fromDate)){
            $filterRange = "AND DATE(a.created_at) = '$toDate' ";
        }
        if (!empty($toDate) && !empty($fromDate)){
            $filterRange = "AND DATE(a.created_at) BETWEEN '$fromDate' AND '$toDate'";
        }

        $tables = DB::select(
                DB::raw("SELECT MAX(s.id) as id
                      ,MAX(s.name) as sampah
                      ,CASE WHEN SUM(a.qty_in) is null
                                   THEN 0
                                   ELSE FORMAT(SUM(a.qty_in),1)
                                   END as qty_in
                       ,CASE WHEN SUM(a.qty_out) is null
                                   THEN 0
                                   ELSE FORMAT(SUM(a.qty_out),1)
                                   END as qty_out
                      , CASE WHEN SUM(a.qty_in) - SUM(qty_out) is null
                                   THEN 0
                                   ELSE FORMAT(SUM(a.qty_in) - SUM(qty_out),1)
                                   END as qty
                      , CASE WHEN SUM(a.saldo_in) - SUM(saldo_out) is null
                                   THEN 0
                                   ELSE FORMAT(SUM(a.saldo_in) - SUM(saldo_out),1)
                                   END as saldo
                      , CASE WHEN MAX(a.created_at) is null
                                   THEN 'Tidak ada pembaharuan'
                                   ELSE MAX(a.created_at)
                                   END as created_at
        FROM sampahs s
        LEFT JOIN stocks a on s.id = a.sampah
        WHERE 1 = 1 AND nesting = 1 $filterdata $filterRange
        GROUP BY s.id")
      );

        return Datatables::of($tables)->make(true);
    }


   
}
