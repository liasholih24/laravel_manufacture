<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sedekah;
use App\Sampah;
use App\Satuan;
use App\Lokasi;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class SedekahController extends Controller
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
        $sedekah = Sedekah::whereMonth('created_at', '=', date('m'))->get();

        return view('backEnd.sedekah.index', compact('sedekah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sampahs = Sampah::where('status','=','3')->where('parent_id','<>',null)->orderby('id','asc')->get();
        $satuans = Satuan::where('status','=','3')->orderby('id','asc')->get(); 
        $gudangs = Lokasi::where('type','=','13')->orderby('id','asc')->get();
        $datenow = date('Y-m-d'); 
        return view('backEnd.sedekah.create',compact('sampahs','satuans','gudangs','datenow'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {


    if ($this->validator($request)->fails()) {
        return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
    }       
      $model = Sedekah::create($request->all());
      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->log('Sedekah '.$request->perusahaan.' is created successfully');

      $day = date('mdy');
      $code = DB::select(
               DB::raw("SELECT CONCAT('S-','$day','-',MAX(id)+1)
                         as inc  
                         from sedekahs GROUP BY id "));

      if(!empty($code)){
        $c = $code[0]->inc;
      }else{
        $c = 'S-'.$day.'-1';
      }
       DB::table('sedekahs')->where('id',$model->id)->update(['code' => $c]);
      //input detail

        if(!empty($request->sampah)){

        for($i=0;$i<count($request->sampah);$i++){

             if($request->input('sampah')[$i]){

            DB::table('detailsedekahs')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'harga_beli'=> $request->harga_beli[$i]
                                        ,'nilai_kg'=> $request->nilai_kg[$i]
                                        ,'nilai_rp'=> $request->nilai_rp[$i]
                                        ,'parent_id'=> $model->id
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                       ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            $stock = DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock ,SUM(saldo_in) - SUM(saldo_out) as saldo  FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gudang'
                          GROUP BY sampah"));

            if(!empty($stock)){
                $qty = $stock[0]->stock + $request->jumlah[$i] ;
                $saldo = $stock[0]->saldo + $request->harga_beli[$i] ;
            }else{ $qty = 0  + $request->jumlah[$i] ; $saldo = 0  + $request->harga_beli[$i] ;}

            DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_in'=> $request->jumlah[$i]
                                        ,'qty'=> $qty
                                        ,'saldo_in'=> $request->harga_beli[$i]
                                        ,'saldo'=> $saldo
                                        ,'gudang'=> $request->gudang
                                        ,'noref'=> $c
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
        
            }
        }
        }

      Session::flash('alert-success', 'Sedekah '.$request->perusahaan.' is created successfully');

        return redirect('sedekah');
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
        $sedekah = Sedekah::findOrFail($id);

        return view('backEnd.sedekah.show', compact('sedekah'));
    }
    public function print($id)
    {
        $sedekah = Sedekah::findOrFail($id);
        $details = DB::select(
                   DB::raw("SELECT d.*, s.name as sampah FROM detailsedekahs d 
                            JOIN sampahs s ON s.id = d.sampah
                            WHERE d.parent_id = '$sedekah->id'"));
  

        return view('backEnd.sedekah.print', compact('sedekah','details'));
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
        $sedekah = Sedekah::findOrFail($id);
        $details = DB::select(
                 DB::raw("SELECT * FROM detailsedekahs where parent_id = $id"));
        $sampahs = Sampah::where('status','=','3')->where('parent_id','<>',null)->orderby('id','asc')->get();
        $satuans = Satuan::where('status','=','3')->orderby('id','asc')->get(); 
        $gudangs = Lokasi::where('type','=','13')->orderby('id','asc')->get();
        $datenow = date('Y-m-d');

        return view('backEnd.sedekah.edit', compact('sedekah','sampahs','satuans','gudangs','datenow','details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
    if ($this->validator($request)->fails()) {
        return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
    }
      
        $sedekah = Sedekah::findOrFail($id);
        $sedekah->update($request->all());

        DB::table('detailsedekahs')->where('parent_id',$id)->delete();
        DB::table('stocks')->where('noref',$request->code)->delete();


        if(!empty($request->sampah)){

        for($i=0;$i<count($request->sampah);$i++){

             if($request->input('sampah')[$i]){



            DB::table('detailsedekahs')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'harga_beli'=> $request->harga_beli[$i]
                                        ,'nilai_kg'=> $request->nilai_kg[$i]
                                        ,'nilai_rp'=> $request->nilai_rp[$i]
                                        ,'parent_id'=> 9
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                       ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            $stock = DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock ,SUM(saldo_in) - SUM(saldo_out) as saldo  FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gudang'
                          GROUP BY sampah"));

            if(!empty($stock)){
                $qty = $stock[0]->stock + $request->jumlah[$i] ;
                $saldo = $stock[0]->saldo + $request->harga_beli[$i] ;
            }else{ $qty = 0  + $request->jumlah[$i] ; $saldo = 0  + $request->harga_beli[$i] ;}

            DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_in'=> $request->jumlah[$i]
                                        ,'qty'=> $qty
                                        ,'saldo_in'=> $request->harga_beli[$i]
                                        ,'saldo'=> $saldo
                                        ,'gudang'=> $request->gudang
                                        ,'noref'=> $request->code
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
        
            }
        }
        }

        activity()->performedOn($sedekah)->causedBy(Sentinel::getUser()->id)->log('Sedekah '.$sedekah->trx_code.' is updated successfully');

        Session::flash('alert-success', ' Sedekah '.$sedekah->trx_code.' is updated successfully');

        return redirect('sedekah');
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
        $sedekah = Sedekah::findOrFail($id);

        $sedekah->delete();

        $attributes = $sedekah->getOriginal();

        activity()->performedOn($sedekah)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Sedekah '.$sedekah->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Sedekah '.$sedekah->name.' is deleted successfully');

        return redirect('sedekah');
    }

}
