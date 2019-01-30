<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class LaporanProduksiController extends Controller
{
    public function recording()
    {
        $id = "";
        $datenow = date('Y-m-d');

        return view('backEnd.laporan.recording', compact('id', 'datenow'));
    }

    public function recordingapi()
    {
        $filterdata= ""; $filterRange= "AND MONTH(p.prod_tgl) = MONTH(NOW()) ";
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');

        if (!empty($fromDate) && empty($toDate)){
            $filterRange = "AND DATE(p.prod_tgl) = '$fromDate' ";
        }
        if (!empty($toDate) && empty($fromDate)){
            $filterRange = "AND DATE(p.prod_tgl) = '$toDate' ";
        }
        if (!empty($toDate) && !empty($fromDate)){
            $filterRange = "AND DATE(p.prod_tgl) BETWEEN '$fromDate' AND '$toDate'";
        }

        $tables = DB::select(
                DB::raw("SELECT k.name as kandang, p.umur, 
                                p.jml_akhir as ppl_awal, p.jml_so as ppl_so, p.jml_pindah as ppl_pindah, p.jml_afkir as ppl_afkir, p.jml_mati as ppl_mati,p.jml_akhir as ppl_akhir,
                                FORMAT((p.jml_mati/ (p.jml_akhir-p.jml_pindah) * 100),2) as persen_mati,
                                p.p_utuh_butir , p.p_putih_butir , p.p_retak_butir ,
                                p.ttl_kg as ttl_kg, p.ttl_butir as ttl_butir, p.gr_butir as gr_butir, p.kg_1000 as kg_1000 ,
                                FORMAT((p.p_utuh_butir / p.ttl_butir * 100),2) as persen_utuh,
                                FORMAT((p.p_putih_butir / p.ttl_butir * 100),2) as persen_putih,
                                FORMAT((p.p_retak_butir / p.ttl_butir * 100),2) as persen_retak,
                                FORMAT((p.ttl_butir/7/p.ttl_butir * 100),2) as persen_hd,
                                p.pakan_qty,pk.name as pakan_jenis,
                                FORMAT((p.pakan_qty/7/p.jml_akhir*1000),2) as gram_ekor,
                                FORMAT((p.pakan_qty/p.ttl_kg),2) as fcr,
                                p.prod_tgl 
                         FROM produksis p
                            JOIN lokasis k ON k.id = p.kandang
                            JOIN pakans pk ON pk.id = p.pakan_jenis
                        WHERE 1=1 $filterRange 
                        ")
                    );
        return Datatables::of($tables)->make(true);
    }
}
