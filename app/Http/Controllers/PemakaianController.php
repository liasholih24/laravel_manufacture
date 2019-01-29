<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pemakaian;
use App\DetailPemakaian;
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

class PemakaianController extends Controller
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
        $pemakaian = Pemakaian::whereMonth('created_at', '=', date('m'))->get();
        return view('backEnd.pemakaian.index', ['pemakaian' => $pemakaian]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        $item = Item::where('nesting', 1)->get();
        $storage = Lokasi::where('depth', 1)->get();
        $satuan = Satuan::get();
        return view('backEnd.pemakaian.create', ['item' => $item, 'storage' => $storage, 'satuan' => $satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $number = Pemakaian::max('number');
        if($number==null){
            $number = 'PK-000001';
        }
        else{
            $number = 'PK-'.sprintf('%06d', substr($number, 3) + 1);
        }
        $pemakaian = new Pemakaian;
        $pemakaian->number = $number;
        $pemakaian->storage_id = $request->storage_id;
        $pemakaian->date = $request->date;
        $pemakaian->desc = $request->desc;
        $pemakaian->created_by = Sentinel::getUser()->id;
        $pemakaian->updated_by = Sentinel::getUser()->id;
        $pemakaian->save();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPemakaian;
            $detail->pemakaian_id = $pemakaian->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Pemakaian berhasil dibuat.');
        return redirect('pemakaian');
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
        $pemakaian = Pemakaian::findOrFail($id);
        $detail = DetailPemakaian::where('pemakaian_id', $id)->get();
        $item = Item::where('nesting', 1)->get();
        $storage = Lokasi::where('depth', 1)->get();
        $satuan = Satuan::get();
        return view('backEnd.pemakaian.edit', ['pemakaian' => $pemakaian, 'detail' => $detail, 'item' => $item, 'storage' => $storage, 'satuan' => $satuan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Pemakaian $pemakaian)
    {
        $pemakaian = Pemakaian::findOrFail($pemakaian->id);
        $pemakaian->storage_id = $request->storage_id;
        $pemakaian->date = $request->date;
        $pemakaian->desc = $request->desc;
        $pemakaian->created_by = Sentinel::getUser()->id;
        $pemakaian->updated_by = Sentinel::getUser()->id;
        $pemakaian->save();
        $detail = DetailPemakaian::where('pemakaian_id', $pemakaian->id);
        $detail->delete();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPemakaian;
            $detail->pemakaian_id = $pemakaian->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Pemakaian berhasil diubah.');
        return redirect('pemakaian');
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
