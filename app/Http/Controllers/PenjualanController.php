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
        $penjualan = Penjualan::whereMonth('created_at', '=', date('m'))->get();
        return view('backEnd.penjualan.index', ['penjualan' => $penjualan]);
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
        return view('backEnd.penjualan.create', ['item' => $item, 'customer' => $customer, 'lokasi' => $lokasi, 'satuan' => $satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $number = Penjualan::max('number');
        if($number==null){
            $number = 'PJ-000001';
        }
        else{
            $number = 'PJ-'.sprintf('%06d', substr($number, 3) + 1);
        }
        $penjualan = new Penjualan;
        $penjualan->number = $number;
        $penjualan->customer_id = $request->customer_id;
        $penjualan->storage_id = $request->storage_id;
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
        $penjualan = Penjualan::findOrFail($id);
        $detail = DetailPenjualan::where('penjualan_id', $id)->get();
        $item = Item::where('nesting', 1)->get();
        $customer = Customer::all();
        $lokasi = Lokasi::where('depth', 0)->get();
        $satuan = Satuan::get();
        return view('backEnd.penjualan.edit', ['penjualan' => $penjualan, 'detail' => $detail, 'item' => $item, 'customer' => $customer, 'lokasi' => $lokasi, 'satuan' => $satuan]);
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
        $penjualan->customer_id = $request->customer_id;
        $penjualan->storage_id = $request->storage_id;
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

}
