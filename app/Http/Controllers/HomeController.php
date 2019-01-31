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

    $Qhpp = DB::select(
      DB::raw("SELECT hpp as hpp  FROM hargapokoks WHERE DATE(tgl_hpp) = DATE(NOW())")
    );

    $Qhpp0 = DB::select(
      DB::raw("SELECT AVG(hpp) as hpp  FROM hargapokoks WHERE MONTH(tgl_hpp) = MONTH(NOW() - INTERVAL 1 MONTH )")
    );

    $QPakan = DB::select(
      DB::raw("SELECT SUM(pakan_qty) as qty, COUNT(kandang) as pakan_kandang , SUM(jml_akhir) as jml_akhir , SUM(ttl_kg) as ttl_kg, SUM(ttl_butir) as ttl_butir FROM produksis WHERE DATE(prod_tgl) = DATE(NOW())")
    );

    $Qstocks = DB::select(
      DB::raw("SELECT SUM(qty_out - qty_in) as qty
            FROM v_recap_stocks")
            );

    $stock = "No Data";
    if(!empty($Qstocks))
    {
        
        $stock = $Qstocks[0]->qty;
    }
    
    $hpp = "No Data";
    if(!empty($Qhpp))
    {
        
        $hpp = $Qhpp[0]->hpp;
    }

    $hpp0 = "No Data";
    if(!empty($Qhpp0))
    {
        
        $hpp0 = $Qhpp0[0]->hpp;
    }

    $pakan = "No Data";
    $pakan_kandang = "No Data";
    $jml_akhir = "No Data";
    $ttl_kg = "No Data";
    $ttl_butir = "No Data";
    if(!empty($QPakan))
    {
        
        $pakan = $QPakan[0]->qty;
        $pakan_kandang = $QPakan[0]->pakan_kandang;
        $jml_akhir = $QPakan[0]->jml_akhir;
        $ttl_kg = $QPakan[0]->ttl_kg;
        $ttl_butir = $QPakan[0]->ttl_butir;
    }

      return view('backEnd.dashboard',compact('hpp','hpp0','pakan','pakan_kandang','jml_akhir','ttl_butir','ttl_kg','stock'));
    }
   
    }

