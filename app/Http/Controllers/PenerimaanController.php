<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengajuan;
use App\DetailPengajuan;
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
        $pengajuan = Pengajuan::whereMonth('created_at', '=', date('m'))->get();
        return view('backEnd.penerimaan.index', ['pengajuan' => $pengajuan]);
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
        $number = Pengajuan::max('number');
        if($number==null){
            $number = 'PG-000001';
        }
        else{
            $number = 'PG-'.sprintf('%06d', substr($number, 3) + 1);
        }
        $pengajuan = new Pengajuan;
        $pengajuan->number = $number;
        $pengajuan->date = $request->date;
        $pengajuan->desc = $request->desc;
        $pengajuan->save();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPengajuan;
            $detail->pengajuan_id = $pengajuan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->save();
        }
        Session::flash('alert-success', 'Pengajuan berhasil dibuat.');
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
        $pengajuan = Pengajuan::findOrFail($id);
        $detail = DetailPengajuan::where('pengajuan_id', $id)->get();
        $item = Item::where('nesting', 1)->get();
        return view('backEnd.pengajuan.edit', ['pengajuan' => $pengajuan, 'detail' => $detail, 'item' => $item]);
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
