<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use App\Lokasi;
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
        $farms = Lokasi::where('depth', 0)->pluck('name','id');

        return view('backEnd.laporan.recording', compact('id', 'datenow','farms'));
    }

    public function recordingapi()
    {
        $filterFarm= ""; $filterRange= "AND MONTH(p.prod_tgl) = MONTH(NOW()) ";
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');
        $farm = Input::get('farm');

        if (!empty($fromDate) && empty($toDate)){
            $filterRange = "AND DATE(p.prod_tgl) = '$fromDate' ";
        }
        if (!empty($toDate) && empty($fromDate)){
            $filterRange = "AND DATE(p.prod_tgl) = '$toDate' ";
        }
        if (!empty($toDate) && !empty($fromDate)){
            $filterRange = "AND DATE(p.prod_tgl) BETWEEN '$fromDate' AND '$toDate'";
        }
        if (!empty($farm)){
            $filterFarm = "AND k.parent_id = '$farm' ";
        }

        $tables = DB::select(
                DB::raw("SELECT CONCAT(k0.name,'/', k.name) as kandang, p.umur, 
                                p.jml_awal as ppl_awal, p.jml_so as ppl_so, p.jml_pindah as ppl_pindah, p.jml_afkir as ppl_afkir, p.jml_mati as ppl_mati,p.jml_akhir as ppl_akhir,
                                FORMAT((p.jml_mati/ (p.jml_awal - p.jml_pindah) * 100),2) as persen_mati,
                                p.p_utuh_butir , p.p_putih_butir , p.p_retak_butir ,
                                p.ttl_kg as ttl_kg, p.ttl_butir as ttl_butir, p.gr_butir as gr_butir, p.kg_1000 as kg_1000 ,
                                FORMAT((p.p_utuh_butir / p.ttl_butir * 100),2) as persen_utuh,
                                FORMAT((p.p_putih_butir / p.ttl_butir * 100),2) as persen_putih,
                                CASE 
                                 WHEN FORMAT((p.p_putih_butir / p.ttl_butir * 100),2) < '1.00'
                                THEN 'normal'
                                WHEN FORMAT((p.p_putih_butir / p.ttl_butir * 100),2) > '1.00'
                                THEN 'abnormal'
                                 ELSE 'not set'
                                END AS status_putih,
                                FORMAT((p.p_retak_butir / p.ttl_butir * 100),2) as persen_retak,
                                CASE 
                                WHEN FORMAT((p.p_retak_butir / p.ttl_butir * 100),2) < '1.5'
                                THEN 'normal'
                                WHEN FORMAT((p.p_retak_butir / p.ttl_butir * 100),2) > '1.5'
                                THEN 'abnormal'
                                ELSE 'not set'
                                END AS status_retak,
                                CASE 
                                WHEN FORMAT((p.ttl_butir/p.jml_akhir * 100),2) >= sl.hd0 AND  FORMAT((p.ttl_butir/p.jml_akhir * 100),2) <= sl.hd1
                                THEN 'normal'
                                WHEN FORMAT((p.ttl_butir/p.jml_akhir * 100),2) is null OR  sl.hd0 is null THEN 'not set'
                                ELSE 'abnormal'
                                END AS status_hd,
                                CASE 
                                WHEN p.gr_butir BETWEEN sl.btg0 AND sl.btg1
                                THEN 'normal'
                                WHEN p.gr_butir is null ORD sl.btg0 is null THEN 'not set'
                                ELSE 'abnormal'
                                END AS status_gr_butir,
                                p.pakan_qty,pk.name as pakan_jenis,
                                FORMAT((p.pakan_qty/p.jml_akhir*1000),2) as gram_ekor,
                               FORMAT((p.pakan_qty/p.ttl_kg),2) as fcr,
                                CASE 
                                WHEN FORMAT((p.pakan_qty/p.ttl_kg),2) >= sf.fc0 AND FORMAT((p.pakan_qty/p.ttl_kg),2) <= sf.fc1
                                THEN 'normal'
                                WHEN FORMAT((p.pakan_qty/p.ttl_kg),2)is null OR sf.fc0 is null THEN 'not set'
                                ELSE 'abnormal'
                                END AS status_fc,
                                p.prod_tgl 
                         FROM produksis p
                            JOIN lokasis k ON k.id = p.kandang
                            JOIN lokasis k0 ON k0.id = k.parent_id
                            JOIN pakans pk ON pk.id = p.pakan_jenis
                            LEFT OUTER JOIN standarlayers sl ON p.umur = sl.umur AND sl.standar = 'HY-LINE'
                            LEFT OUTER JOIN standarfcs sf ON p.umur BETWEEN sf.umur0 AND sf.umur1 
                        WHERE 1=1 $filterRange $filterFarm 
                        ")
                    );
        return Datatables::of($tables)->make(true);
    }
}
