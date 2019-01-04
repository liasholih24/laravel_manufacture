<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Route;

      
class HomeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function home($value='')
    {
    	return view('welcome');
    }
    
    public function dashboard()
   {

  
    $sum1 =  DB::select(
                  DB::raw("SELECT SUM(kredit) as kredit, SUM(debit) as debit, SUM(saldo_sampah) as sampah from tabungans WHERE date(created_at) = date(now())"));
    $sum2 =  DB::select(
                  DB::raw("SELECT COUNT(DISTINCT norek) as nasabah from tabungans WHERE date(created_at) = date(now()) GROUP BY norek"));
    $sum3 =  DB::select(
             DB::raw("SELECT SUM(total_rp) as total_rp, sum(total_kg) as total_kg from pembelians WHERE date(created_at) = date(now())"));

     if(!empty($sum1)){
        $deposit = $sum1[0]->kredit;
        $debit = $sum1[0]->debit;
        $sampah = $sum1[0]->sampah;
      }
    if(!empty($sum2)){
        $nasabah = $sum2[0]->nasabah;
      }
    if(!empty($sum3)){
        $pembelian_rp = $sum3[0]->total_rp;
        $pembelian_kg = $sum3[0]->total_kg;
      }

      $jPembelian = $debit + $pembelian_rp;
      $jKg = $sampah + $pembelian_kg;

    $pnj1 =  DB::select(
                  DB::raw("SELECT SUM(total_rp) as total_rp, SUM(total_kg) as total_kg from penjualans WHERE date(created_at) = date(now())"));
    
    $pnj2 =  DB::select(
                  DB::raw("SELECT COUNT(DISTINCT perusahaan ) as perusahaan from penjualans WHERE date(created_at) = date(now()) GROUP BY perusahaan"));

    if(!empty($pnj1)){
        $penjualan_rp = $pnj1[0]->total_rp;
        $penjualan_kg = $pnj1[0]->total_kg;
      }

    if(!empty($pnj2)){
        $perusahaan = $pnj2[0]->perusahaan;
      }  

      $sdk1 =  DB::select(
                  DB::raw("SELECT SUM(total_rp) as total_rp, SUM(total_kg) as total_kg from sedekahs WHERE month(created_at) = month(now())"));
    
     $sdk2 =  DB::select(
                  DB::raw("SELECT COUNT(DISTINCT perusahaan) as donatur from sedekahs WHERE month(created_at) = month(now()) and code = 'K' GROUP BY perusahaan")); 

     if(!empty($sdk1)){
        $sedekah_rp = $sdk1[0]->total_rp;
        $sedekah_kg = $sdk1[0]->total_kg;
      }

    if(!empty($sdk2)){
        $donatur = $sdk2[0]->donatur;
      } 

      $n_ttl =  DB::select(
                  DB::raw("SELECT COUNT(norek) as norek, MAX(DATE(created_at)) as created_at from nasabahs WHERE status = 3")); 

      if(!empty($n_ttl)){
        $nasabah_ttl = $n_ttl[0]->norek;
        $created_at = $n_ttl[0]->created_at;
      } 

      $u_ttl =  DB::select(
                  DB::raw("SELECT COUNT(id) as unit from statuses WHERE status = 3 AND parent_id = 20")); 

      if(!empty($u_ttl)){
        $unit_ttl = $u_ttl[0]->unit;
      } 

      //rekapitulasi sampah

      $rekap_sampahs =  DB::select(
                  DB::raw("SELECT MAX(p.name) as sampah, COALESCE(SUM(t.sampah),0) as jml from sampahs s
                            LEFT JOIN sampahs p on s.parent_id = p.id
                            LEFT JOIN detailtabungans t ON t.sampah = s.id 
                            where s.nesting = 1 
                            GROUP BY s.parent_id
                            LIMIT 6"));
      $rekap_sampahs2 =  DB::select(
                  DB::raw("SELECT MAX(p.name) as sampah, COALESCE(SUM(t.sampah),0) as jml from sampahs s
                            LEFT JOIN sampahs p on s.parent_id = p.id
                            LEFT JOIN detailpenjualans t ON t.sampah = s.id 
                            where s.nesting = 1 
                            GROUP BY s.parent_id
                            LIMIT 6"));

      $persediaans =  DB::select(
                  DB::raw("SELECT (SUM(qty_in) -  SUM(qty_out))as qty, SUM(qty_in) as qty_in ,SUM(qty_out) as qty_out FROM stocks"));
      
      if(!empty($persediaans)){
        $qty = $persediaans[0]->qty;
        $qty_in = $persediaans[0]->qty_in;
        $qty_out = $persediaans[0]->qty_out;
      }

      $sampah_ttl =  DB::select(
                  DB::raw("SELECT MAX(st.name) as type, COALESCE(SUM(qty_in) - SUM(qty_out),0) as qty from     statuses st    
                            LEFT JOIN sampahs p on st.id = p.type
                            LEFT JOIN stocks t on t.sampah = p.id
                            where st.parent_id = 16
                            GROUP BY st.name"));

      $sampah_ttl2 =  DB::select(
                  DB::raw("SELECT MAX(p.name) as sampah, COALESCE(SUM(t.sampah),0) as jml ,
                           CASE WHEN SUM(t.sampah) is null
                                   THEN 'badge-warning'
                                   ELSE 'badge-primary'
                                   END as badge
                            from sampahs s
                            LEFT JOIN sampahs p on s.parent_id = p.id
                            LEFT JOIN stocks t ON t.sampah = s.id 
                            where s.nesting = 1 
                            GROUP BY s.parent_id
                            LIMIT 6"));
     

      $deposits =  DB::select(
                  DB::raw("SELECT DAY(MAX(created_at)) as d, MONTH(MAX(created_at)) as m, YEAR(MAX(created_at)) as y, SUM(kredit) as deposit_rp, sum(saldo_sampah) as deposit_kg FROM tabungans GROUP BY MONTH(created_at)"));

      $penjualans =  DB::select(
                  DB::raw("SELECT DAY(MAX(created_at)) as d, MONTH(MAX(created_at)) as m, YEAR(MAX(created_at)) as y, SUM(total_rp) as penjualan_rp, SUM(total_kg) as penjualan_kg FROM penjualans GROUP BY MONTH(created_at)"));

      $deposits_m=  DB::select(
                  DB::raw("SELECT DAY(MAX(created_at)) as d, MONTH(MAX(created_at)) as m, YEAR(MAX(created_at)) as y, SUM(kredit) as deposit_rp, sum(saldo_sampah) as deposit_kg FROM tabungans WHERE MONTH(created_at) = MONTH(NOW()) GROUP BY MONTH(created_at)"));

      if(!empty($deposits_m)){
        $deposit_kgm = $deposits_m[0]->deposit_kg;
        $deposit_rpm = $deposits_m[0]->deposit_rp;
      }else{
        $deposit_kgm = 0;
        $deposit_rpm = 0;
      }

      $penjualans_m =  DB::select(
                  DB::raw("SELECT DAY(MAX(created_at)) as d, MONTH(MAX(created_at)) as m, YEAR(MAX(created_at)) as y, SUM(total_rp) as penjualan_rp, SUM(total_kg) as penjualan_kg FROM penjualans WHERE MONTH(created_at) = MONTH(NOW()) GROUP BY MONTH(created_at)"));

      if(!empty($penjualans_m)){
        $penjualan_kgm = $penjualans_m[0]->penjualan_kg;
        $penjualan_rpm = $penjualans_m[0]->penjualan_rp;
      }else{
         $penjualan_kgm = 0;
        $penjualan_rpm = 0;
      }

      $deposits_lastm=  DB::select(
                  DB::raw("SELECT DAY
                          ( MAX( created_at ) ) AS d,
                          MONTH ( MAX( created_at ) ) AS m,
                          YEAR ( MAX( created_at ) ) AS y,
                          SUM( saldo_sampah ) AS deposit_kg,
                          SUM( kredit ) AS deposit_kg 
                        FROM
                          tabungans 
                        WHERE
                           MONTH(created_at) =MONTH(CURDATE() - INTERVAL 1 MONTH)
                        GROUP BY
                          MONTH (created_at)"));

      if(!empty($deposits_lastm)){
        $deposit_kgm0 = $deposits_lastm[0]->deposit_kg;
        $deposit_rpm0 = $deposits_lastm[0]->deposit_kg;
      }else{
         $deposit_kgm0 = 0;
        $deposit_rpm0 = 0;
      }

      $penjualan_lastm=  DB::select(
                  DB::raw("SELECT DAY
                          ( MAX( created_at ) ) AS d,
                          MONTH ( MAX( created_at ) ) AS m,
                          YEAR ( MAX( created_at ) ) AS y,
                          SUM( total_kg ) AS penjualan_kg,
                          SUM( total_rp ) AS penjualan_kg 
                        FROM
                          penjualans 
                        WHERE
                           MONTH(created_at) =MONTH(CURDATE() - INTERVAL 1 MONTH)
                        GROUP BY
                          MONTH (created_at)"));

      if(!empty($penjualan_lastm)){
        $penjualan_kgm0 = $penjualan_lastm[0]->penjualan_kg;
        $penjualan_rpm0 = $penjualan_lastm[0]->penjualan_kg;
      }else{
        $penjualan_kgm0 = 0;
        $penjualan_rpm0 = 0;
      }

      
      $sedekahs =  DB::select(
                  DB::raw("SELECT MAX(p.name) as sampah, COALESCE(SUM(t.sampah),0) as jml from sampahs s
                            LEFT JOIN sampahs p on s.parent_id = p.id
                            LEFT JOIN detailsedekahs t ON t.sampah = s.id 
                            where s.nesting = 1 
                            GROUP BY s.parent_id
                            LIMIT 6"));

      return view('backEnd.dashboard',compact('deposit','nasabah','sampah','penjualan_rp','penjualan_kg','perusahaan','sedekah_rp','sedekah_kg','donatur','nasabah_ttl','created_at','unit_ttl','rekap_sampahs','rekap_sampahs2','qty','qty_in','qty_out','sampah_ttl','deposits','penjualans','deposit_kgm','deposit_rpm','penjualan_kgm','penjualan_rpm','deposit_kgm0','deposit_rpm0','penjualan_kgm0','penjualan_rpm0','sedekahs','sampah_ttl2','jPembelian','jKg'));
    }
   
    }

