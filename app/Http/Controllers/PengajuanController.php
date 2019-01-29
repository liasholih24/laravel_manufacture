<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengajuan;
use App\DetailPengajuan;
use App\Item;
use App\Lokasi;
use App\Satuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
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
        $lokasi = Lokasi::where('depth', 1)->get();
        $satuan = Satuan::get();
        return view('backEnd.pengajuan.create', ['item' => $item, 'lokasi' => $lokasi, 'satuan' => $satuan]);
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
        $pengajuan->storage_id = $request->storage_id;
        $pengajuan->date = $request->date;
        $pengajuan->desc = $request->desc;
        $pengajuan->created_by = Sentinel::getUser()->id;
        $pengajuan->updated_by = Sentinel::getUser()->id;
        $pengajuan->save();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPengajuan;
            $detail->pengajuan_id = $pengajuan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
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
        $lokasi = Lokasi::where('depth', 1)->get();
        $satuan = Satuan::get();
        return view('backEnd.pengajuan.edit', ['pengajuan' => $pengajuan, 'detail' => $detail, 'item' => $item, 'lokasi' => $lokasi, 'satuan' => $satuan]);
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
        $pengajuan->storage_id = $request->storage_id;
        $pengajuan->date = $request->date;
        $pengajuan->desc = $request->desc;
        $pengajuan->updated_by = Sentinel::getUser()->id;
        $pengajuan->save();
        $detail = DetailPengajuan::where('pengajuan_id', $pengajuan->id);
        $detail->delete();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPengajuan;
            $detail->pengajuan_id = $pengajuan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
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

    public function item($id)
    {
        $item = Item::findOrFail($id);
        return response($item);
    }

}
