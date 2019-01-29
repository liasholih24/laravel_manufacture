<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Penerimaan;
use App\Pengajuan;
use App\DetailPenerimaan;
use App\DetailPengajuan;
use App\Item;
use App\Supplier;
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
        $pengajuan = Pengajuan::where('status', 1)->get();
        $item = Item::where('nesting', 1)->get();
        $supplier = Supplier::all();
        $lokasi = Lokasi::where('depth', 0)->get();
        $satuan = Satuan::get();
        return view('backEnd.penerimaan.create', ['pengajuan' => $pengajuan, 'item' => $item, 'supplier' => $supplier, 'lokasi' => $lokasi, 'satuan' => $satuan]);
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
        $penerimaan->storage_id = $request->storage_id;
        $penerimaan->pengajuan_id = $request->pengajuan_id;
        $penerimaan->date = $request->date;
        $penerimaan->desc = $request->desc;
        $penerimaan->created_by = Sentinel::getUser()->id;
        $penerimaan->updated_by = Sentinel::getUser()->id;
        $penerimaan->save();
        if(!empty($request->pengajuan_id)){
            $pengajuan = Pengajuan::findOrFail($request->pengajuan_id);
            $pengajuan->status = 0;
            $pengajuan->save();
        }
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPenerimaan;
            $detail->penerimaan_id = $penerimaan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->supplier_id = $request->supplier_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
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
        $pengajuan = Pengajuan::where('status', 1)->get();
        $item = Item::where('nesting', 1)->get();
        $supplier = Supplier::all();
        $lokasi = Lokasi::where('depth', 0)->get();
        $satuan = Satuan::get();
        return view('backEnd.penerimaan.edit', ['penerimaan' => $penerimaan, 'detail' => $detail, 'pengajuan' => $pengajuan, 'item' => $item, 'supplier' => $supplier, 'lokasi' => $lokasi, 'satuan' => $satuan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Penerimaan $penerimaan)
    {
        $penerimaan = Penerimaan::findOrFail($penerimaan->id);
        $penerimaan->pengajuan_id = $request->pengajuan_id;
        $penerimaan->storage_id = $request->storage_id;
        $penerimaan->date = $request->date;
        $penerimaan->desc = $request->desc;
        $penerimaan->save();
        $detail = DetailPenerimaan::where('penerimaan_id', $penerimaan->id);
        $detail->delete();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPenerimaan;
            $detail->penerimaan_id = $penerimaan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->supplier_id = $request->supplier_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->price = $request->price[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Penerimaan berhasil diubah.');
        return redirect('penerimaan');
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

    public function pengajuan($id)
    {
        $item = [];
        $pengajuan = DetailPengajuan::where('pengajuan_id', $id)->get();
        foreach($pengajuan as $r){
            array_push($item, [
                'id' => $r->item->id,
                'name' => $r->item->name,
                'qty' => $r->qty,
                'satuan_id' => $r->satuan->id,
                'satuan' => $r->satuan->name
            ]);
        }
        return response($item);
    }

}
