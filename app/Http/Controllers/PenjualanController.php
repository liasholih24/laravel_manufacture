<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Penjualan;
use App\DetailPenjualan;
use App\Item;
use App\Customer;
use App\Lokasi;
use App\Satuan;
use App\Ekspedisi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
use Validator;
use Sentinel;
use Activity;
use DB;

class PenjualanController extends Controller
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
        $penjualan = Penjualan::get();
        $lokasi = Lokasi::where('depth', 0)->get();
        $kategori = Item::where('nesting', 0)->get();
        return view('backEnd.penjualan.index', ['penjualan' => $penjualan, 'lokasi' => $lokasi, 'kategori' => $kategori]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        $item = Item::where('nesting', 1)->get();
        $customer = Customer::all();
        $lokasi = Lokasi::where('depth', 0)->get();
        $satuan = Satuan::get();
        $ekspedisi = Ekspedisi::get();
        return view('backEnd.penjualan.create', ['item' => $item, 'customer' => $customer, 'lokasi' => $lokasi, 'satuan' => $satuan, 'ekspedisi' => $ekspedisi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        /* $number = Penjualan::max('number');
        if($number==null){
            $number = 'PJ-000001';
        }
        else{
            $number = 'PJ-'.sprintf('%06d', substr($number, 3) + 1);
        }
        */
        $penjualan = new Penjualan;
        $penjualan->number = $request->number;
        $penjualan->customer_id = $request->customer_id;
        $penjualan->storage_id = $request->storage_id;
        $penjualan->ekspedisi_id = $request->ekspedisi_id;
        $penjualan->date = $request->date;
        $penjualan->desc = $request->desc;
        $penjualan->created_by = Sentinel::getUser()->id;
        $penjualan->updated_by = Sentinel::getUser()->id;
        $penjualan->save();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPenjualan;
            $detail->penjualan_id = $penjualan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->price = $request->price[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Penjualan berhasil dibuat.');
        return redirect('penjualan');
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

    /*public function print($id)
    {
        
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $detail = DetailPenjualan::where('penjualan_id', $id)->get();
        $item = Item::where('nesting', 1)->get();
        $customer = Customer::all();
        $lokasi = Lokasi::where('depth', 0)->get();
        $satuan = Satuan::get();
        $ekspedisi = Ekspedisi::get();
        if($penjualan->customer_id > 0){
            $deskripsi = Customer::findOrFail($penjualan->customer_id);
        }
        else{
            $deskripsi = null;
        }
        return view('backEnd.penjualan.edit', ['penjualan' => $penjualan, 'detail' => $detail, 'item' => $item, 'customer' => $customer, 'lokasi' => $lokasi, 'satuan' => $satuan, 'ekspedisi' => $ekspedisi, 'deskripsi' => $deskripsi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $penjualan = Penjualan::findOrFail($penjualan->id);
        $penjualan->number = $request->number;
        $penjualan->customer_id = $request->customer_id;
        $penjualan->storage_id = $request->storage_id;
        $penjualan->ekspedisi_id = $request->ekspedisi_id;
        $penjualan->date = $request->date;
        $penjualan->desc = $request->desc;
        $penjualan->updated_by = Sentinel::getUser()->id;
        $penjualan->save();
        $detail = DetailPenjualan::where('penjualan_id', $penjualan->id);
        $detail->delete();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPenjualan;
            $detail->penjualan_id = $penjualan->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->price = $request->price[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Penjualan berhasil diubah.');
        return redirect('penjualan');
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

    public function customer($id)
    {
        $customer = Customer::findOrFail($id);
        return response($customer);
    }

    public function cetak(Request $request)
    {
        $data = DB::table('penjualans')->join('detailpenjualans', 'penjualans.id', '=', 'detailpenjualans.penjualan_id')->join('customers', 'penjualans.customer_id', '=', 'customers.id')->join('items', 'items.id', '=', 'detailpenjualans.item_id')->selectRaw('penjualans.date, penjualans.number, customers.name, penjualans.desc, sum(detailpenjualans.qty) as qty, sum(detailpenjualans.price) as price')->where('detailpenjualans.deleted_at', null)->where('penjualans.deleted_at', null)->where('penjualans.storage_id', $request->storage_id)->where('items.parent_id', $request->kategori_id)->whereRaw('penjualans.date between "'.$request->from_date.'" and "'.$request->to_date.'"')->groupBy(['penjualans.id', 'penjualans.date', 'penjualans.number', 'penjualans.desc', 'customers.name'])->orderby('penjualans.date','asc')->get(); 
        $storage = DB::table('lokasis')->where('id', $request->storage_id)->first();
        $kategori = DB::table('items')->where('nesting', 0)->where('id', $request->kategori_id)->first();
        return view('backEnd.penjualan.cetak', ['data' => $data, 'storage' => $storage, 'kategori' => $kategori, 'from' => $request->from_date, 'to' => $request->to_date]);
    }

}
