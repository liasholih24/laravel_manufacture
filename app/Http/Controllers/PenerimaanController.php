<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Penerimaan;
use App\Pengajuan;
use App\DetailPenerimaan;
use App\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
use Validator;
use Sentinel;
use Activity;
use DB;

class PenerimaanController extends Controller
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
        $penerimaan = Penerimaan::whereMonth('created_at', '=', date('m'))->get();
        return view('backEnd.penerimaan.index', ['penerimaan' => $penerimaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        $pengajuan = Pengajuan::all();
        $item = Item::where('nesting', 1)->get();
        return view('backEnd.penerimaan.create', ['pengajuan' => $pengajuan, 'item' => $item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $number = Penerimaan::max('number');
        if($number==null){
            $number = 'PR-000001';
        }
        else{
            $number = 'PR-'.sprintf('%06d', substr($number, 3) + 1);
        }
        $penerimaan = new Penerimaan;
        $penerimaan->number = $number;
        $penerimaan->pengajuan_id = $request->pengajuan_id;
        $penerimaan->date = $request->date;
        $penerimaan->desc = $request->desc;
        $penerimaan->created_by = Sentinel::getUser()->id;
        $penerimaan->updated_by = Sentinel::getUser()->id;
        $penerimaan->save();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPenerimaan;
            $detail->penerimaan_id = $penerimaan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->price = $request->price[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Penerimaan berhasil dibuat.');
        return redirect('penerimaan');
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
        $penerimaan = Penerimaan::findOrFail($id);
        $detail = DetailPenerimaan::where('penerimaan_id', $id)->get();
        $pengajuan = Pengajuan::all();
        $item = Item::where('nesting', 1)->get();
        return view('backEnd.penerimaan.edit', ['penerimaan' => $penerimaan, 'detail' => $detail, 'pengajuan' => $pengajuan, 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        $pengajuan = Pengajuan::findOrFail($pengajuan->id);
        $pengajuan->date = $request->date;
        $pengajuan->desc = $request->desc;
        $pengajuan->save();
        $detail = DetailPengajuan::where('pengajuan_id', $pengajuan->id);
        $detail->delete();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPengajuan;
            $detail->pengajuan_id = $pengajuan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->save();
        }
        Session::flash('alert-success', 'Pengajuan berhasil diubah.');
        return redirect('pengajuan');
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
        
    }

}
