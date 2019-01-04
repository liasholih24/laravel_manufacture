<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SBU;
use App\SBULocation;

class AjaxDemoController extends Controller
{
	/**
     * Show the application myform.
     *
     * @return \Illuminate\Http\Response
     */
    public function sbu()
    {
    	$sbus = SBU::where('depth',0)->pluck("name","id")->all();
    	return view('backEnd.sbu.create',compact('$sbus'));
    }

    /**
     * Show the application selectAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectAjax(Request $request)
    {
    	if($request->ajax()){
    		$province = SBULocation::where('sbu_id',$request->sbu_id)->pluck("location_id","location_id")->all();
    		$data = view('backEnd.sbu.ajax-select',compact('province'))->render();
    		return response()->json(['options'=>$data]);
    	}
    }
}
