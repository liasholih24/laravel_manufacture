<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transfer;
use App\DetailTransfer;
use App\Item;
use App\Lokasi;
use App\Satuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;
use DB;

class TransferController extends Controller
{

protected function validator(Request $request)
{
/*dicustom*/
  return Validator::make($request->all(), [
    /*  'name' => 'required|max:35|min:2|string',*/
  ]);
}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mutasi = Transfer::whereMonth('created_at', '=', date('m'))->get();
        return view('backEnd.transfer.index', ['mutasi' => $mutasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        $item = Item::where('nesting', 1)->get();
        $storage = Lokasi::where('depth', 0)->get();
        $satuan = Satuan::get();
        return view('backEnd.transfer.create', ['item' => $item, 'storage' => $storage, 'satuan' => $satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $number = Transfer::max('number');
        if($number==null){
            $number = 'TF-000001';
        }
        else{
            $number = 'TF-'.sprintf('%06d', substr($number, 3) + 1);
        }
        $mutasi = new Transfer;
        $mutasi->number = $number;
        $mutasi->gdg_from = $request->gdg_from;
        $mutasi->gdg_to = $request->gdg_to;
        $mutasi->date = $request->date;
        $mutasi->keterangan = $request->keterangan;
        $mutasi->created_by = Sentinel::getUser()->id;
        $mutasi->updated_by = Sentinel::getUser()->id;
        $mutasi->save();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailTransfer;
            $detail->transfer_id = $mutasi->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Mutasi berhasil dibuat.');
        return redirect('transfer');
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
        $mutasi = Transfer::findOrFail($id);
        $detail = DetailTransfer::where('transfer_id', $id)->get();
        $item = Item::where('nesting', 1)->get();
        $storage = Lokasi::where('depth', 0)->get();
        $satuan = Satuan::get();
        return view('backEnd.transfer.edit', ['mutasi' => $mutasi, 'detail' => $detail, 'item' => $item, 'storage' => $storage, 'satuan' => $satuan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        $mutasi = Transfer::findOrFail($transfer->id);
        $mutasi->gdg_from = $request->gdg_from;
        $mutasi->gdg_to = $request->gdg_to;
        $mutasi->date = $request->date;
        $mutasi->keterangan = $request->keterangan;
        $mutasi->updated_by = Sentinel::getUser()->id;
        $mutasi->save();
        $detail = DetailTransfer::where('transfer_id', $transfer->id);
        $detail->delete();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailTransfer;
            $detail->transfer_id = $transfer->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->satuan_id = $request->satuan_id[$i];
            $detail->created_by = Sentinel::getUser()->id;
            $detail->updated_by = Sentinel::getUser()->id;
            $detail->save();
        }
        Session::flash('alert-success', 'Mutasi berhasil diubah.');
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
        
    }

}
