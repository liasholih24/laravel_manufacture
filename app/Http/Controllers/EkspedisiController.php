<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ekspedisi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Activity;
use DB;

class EkspedisiController extends Controller
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
        $ekspedisi = Ekspedisi::all();
        return view('backEnd.ekspedisi.index', ['ekspedisi' => $ekspedisi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        return view('backEnd.ekspedisi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $ekspedisi = new Ekspedisi;
        $ekspedisi->name = $request->name;
        $ekspedisi->desc = $request->desc;
        $ekspedisi->save();
        Session::flash('alert-success', 'Ekspedisi berhasil dibuat.');
        return redirect('ekspedisi');
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
        
    }

    public function print($id)
    {
        
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
        $ekspedisi = Ekspedisi::findOrFail($id);
        return view('backEnd.ekspedisi.edit', ['ekspedisi' => $ekspedisi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Ekspedisi $ekspedisi)
    {
        $ekspedisi = Ekspedisi::findOrFail($ekspedisi->id);
        $ekspedisi->name = $request->name;
        $ekspedisi->desc = $request->desc;
        $ekspedisi->save();
        Session::flash('alert-success', 'Ekspedisi berhasil diubah.');
        return redirect('ekspedisi');
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
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->delete();
        return redirect('ekspedisi');
    }

}
