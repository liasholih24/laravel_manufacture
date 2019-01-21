<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengeluaran;
use App\DetailPengeluaran;
use App\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
use Validator;
use Sentinel;
use Activity;
use DB;

class PengeluaranController extends Controller
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
        $pengeluaran = Pengeluaran::whereMonth('created_at', '=', date('m'))->get();
        return view('backEnd.pengeluaran.index', ['pengeluaran' => $pengeluaran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        $item = Item::where('nesting', 1)->get();
        return view('backEnd.pengeluaran.create', ['item' => $item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $number = Pengeluaran::max('number');
        if($number==null){
            $number = 'PN-000001';
        }
        else{
            $number = 'PN-'.sprintf('%06d', substr($number, 3) + 1);
        }
        $pengeluaran = new Pengeluaran;
        $pengeluaran->number = $number;
        $pengeluaran->date = $request->date;
        $pengeluaran->desc = $request->desc;
        $pengeluaran->save();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPengeluaran;
            $detail->pengeluaran_id = $pengeluaran->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->save();
        }
        Session::flash('alert-success', 'Pengeluaran berhasil dibuat.');
        return redirect('pengeluaran');
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
        $pengeluaran = Pengeluaran::findOrFail($id);
        $detail = DetailPengeluaran::where('pengeluaran_id', $id)->get();
        $item = Item::where('nesting', 1)->get();
        return view('backEnd.pengeluaran.edit', ['pengeluaran' => $pengeluaran, 'detail' => $detail, 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran = Pengeluaran::findOrFail($pengeluaran->id);
        $pengeluaran->date = $request->date;
        $pengeluaran->desc = $request->desc;
        $pengeluaran->save();
        $detail = DetailPengeluaran::where('pengeluaran_id', $pengeluaran->id);
        $detail->delete();
        for($i=0;$i<count($request->item_id);$i++){
            $detail = new DetailPengeluaran;
            $detail->pengeluaran_id = $pengeluaran->id;
            $detail->item_id = $request->item_id[$i];
            $detail->qty = $request->qty[$i];
            $detail->save();
        }
        Session::flash('alert-success', 'Pengeluaran berhasil diubah.');
        return redirect('pengeluaran');
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
