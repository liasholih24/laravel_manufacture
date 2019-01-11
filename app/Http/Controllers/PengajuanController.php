<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengajuan;
use App\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;
use DB;

class PengajuanController extends Controller
{

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), []);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pengajuan = Pengajuan::whereMonth('created_at', '=', date('m'))->get();
        return view('backEnd.pengajuan.index', ['pengajuan' => $pengajuan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        $item = Item::where('nesting', 1)->get();
        return view('backEnd.pengajuan.create', ['item' => $item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        dd($request);
        $flight = new Flight;
        $flight->name = $request->name;
        $flight->save();

        Session::flash('alert-success', 'Transfer '.$model->name.' is created successfully');
        return redirect('pengajuan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transfer = Transfer::findOrFail($id);

        return view('backEnd.transfer.show', compact('transfer'));
    }

    public function print($id)
    {
        $transfer = Transfer::findOrFail($id);
        $details = DB::select(
                   DB::raw("SELECT d.*, s.name as sampah FROM detailtransfers d 
                            JOIN sampahs s ON s.id = d.sampah
                            WHERE d.noref = '$transfer->id'"));
  

        return view('backEnd.transfer.print', compact('transfer','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transfer = Transfer::findOrFail($id);

        return view('backEnd.transfer.edit', compact('transfer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
    if ($this->validator($request)->fails()) {
        return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
    }
        
        $transfer = Transfer::findOrFail($id);
        $transfer->update($request->all());

        $attributes = $transfer->getOriginal();

        activity()->performedOn($transfer)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Transfer '.$transfer->name.' is updated successfully');

        Session::flash('alert-success', ' Transfer '.$transfer->name.' is updated successfully');

        return redirect('transfer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);

        $transfer->delete();

        $attributes = $transfer->getOriginal();

        activity()->performedOn($transfer)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Transfer '.$transfer->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Transfer '.$transfer->name.' is deleted successfully');

        return redirect('transfer');
    }

}
