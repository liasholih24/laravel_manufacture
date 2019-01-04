<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Spatie\Activitylog\Models\Activity as Activity;
use Datatables;

class LogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $logs = Activity::get();
      return view('backEnd.log.index', compact('logs'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */


}
