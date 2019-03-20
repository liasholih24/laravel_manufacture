<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pembelian;
use App\Penadah;
use App\Sampah;
use App\Satuan;
use App\Lokasi;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class PembelianController extends Controller
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

        $date = \Carbon\Carbon::today()->subDays(90);

        $pembelian = Pembelian::where('date', '>=', date($date))->get();


        return view('backEnd.pembelian.index', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $perusahaans = Penadah::where('status','=','3')->orderby('id','asc')->get();
        $sampahs = Sampah::where('status','=','3')->where('parent_id',3)->orderby('id','asc')->get();
        $satuans = Satuan::where('status','=','3')->orderby('id','asc')->get();
        $gudangs = Lokasi::orderby('id','asc')->get();
        $datenow = date('Y-m-d'); 

        return view('backEnd.pembelian.create',compact('perusahaans','sampahs','satuans','gudangs','datenow'));
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
        
      $model = Pembelian::create($request->all());
      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->log('Pembelian '.$request->code.' is created successfully');


      //input detail

        if(!empty($request->sampah)){

        for($i=0;$i<count($request->sampah);$i++){

             if($request->input('sampah')[$i]){

            DB::table('detailpembelians')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'harga_beli'=> $request->harga_beli[$i]
                                        ,'nilai_kg'=> $request->nilai_kg[$i]
                                        ,'nilai_rp'=> $request->nilai_rp[$i]
                                        ,'parent_id'=> $model->id
                                        ,'created_at'=> $request->created_at
                                       ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
             $stock = DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock, SUM(saldo_in) - SUM(saldo_out) as saldo FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gudang'
                          GROUP BY sampah"));

            if(!empty($stock)){
                $qty = $stock[0]->stock + $request->jumlah[$i] ;
                $saldo = $stock[0]->saldo + $request->harga_beli[$i] ;
            }else{ $qty = 0 + $request->jumlah[$i] ; $saldo = 0 + $request->harga_beli[$i] ;}


            DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_in'=> $request->jumlah[$i]
                                        ,'qty'=> $qty
                                        ,'saldo_in'=> $request->harga_beli[$i]
                                        ,'saldo'=> $saldo
                                        ,'gudang'=> $request->gudang
                                        ,'noref'=> $request->code
                                        ,'created_at'=> $request->created_at
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
        
            }
        }
        }

      Session::flash('alert-success', 'pembelian is created successfully');

        return redirect('pembelian');
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
        $pembelian = Pembelian::findOrFail($id);

        return view('backEnd.pembelian.show', compact('pembelian'));
    }

    public function print($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $details = DB::select(
                   DB::raw("SELECT d.*, s.name as sampah FROM detailpembelians d 
                            JOIN sampahs s ON s.id = d.sampah
                            WHERE d.parent_id = '$pembelian->id'"));
  

        return view('backEnd.pembelian.print', compact('pembelian','details'));
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
        $pembelian = Pembelian::findOrFail($id);
        $details = DB::select(
                 DB::raw("SELECT * FROM detailpembelians where parent_id = $id"));  
        $perusahaans = Penadah::where('status','=','3')->orderby('id','asc')->get();
        $sampahs = Sampah::where('status','=','3')->where('parent_id','<>',null)->orderby('id','asc')->get();
        $satuans = Satuan::where('status','=','3')->orderby('id','asc')->get();
        $gudangs = Lokasi::orderby('id','asc')->get();
        $datenow = date('Y-m-d'); 

        return view('backEnd.pembelian.edit', compact('pembelian','perusahaans','sampahs','satuans','gudangs','datenow','details'));
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
        
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->update($request->all());

        DB::table('detailpembelians')->where('parent_id',$id)->delete();
        DB::table('stocks')->where('noref',$request->code)->delete();


        if(!empty($request->sampah)){

        for($i=0;$i<count($request->sampah);$i++){

             if($request->input('sampah')[$i]){

            DB::table('detailpembelians')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'harga_beli'=> $request->harga_beli[$i]
                                        ,'nilai_kg'=> $request->nilai_kg[$i]
                                        ,'nilai_rp'=> $request->nilai_rp[$i]
                                        ,'parent_id'=> $id
                                        ,'created_at'=> $request->created_at
                                       ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            $stock = DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock, SUM(saldo_in) - SUM(saldo_out) as saldo FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gudang'
                          GROUP BY sampah"));

            if(!empty($stock)){
                $qty = $stock[0]->stock + $request->jumlah[$i] ;
                $saldo = $stock[0]->saldo + $request->harga_beli[$i] ;
            }else{ $qty = 0 + $request->jumlah[$i] ; $saldo = 0 + $request->harga_beli[$i] ;}

            DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_in'=> $request->jumlah[$i]
                                        ,'qty'=> $qty
                                        ,'saldo_in'=> $request->harga_beli[$i]
                                        ,'saldo'=> $saldo
                                        ,'gudang'=> $request->gudang
                                        ,'noref'=> $request->code
                                        ,'created_at'=> $request->created_at
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
        
            }
        }
        }

        activity()->performedOn($pembelian)->causedBy(Sentinel::getUser()->id)->log('pembelian '.$request->code.' is updated successfully');

        Session::flash('alert-success', ' pembelian '.$request->code.' is updated successfully');

        return redirect('pembelian');
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
        $pembelian = Pembelian::findOrFail($id);

        $pembelian->delete();

        DB::table('detailpembelians')->where('parent_id', $pembelian->id)->delete();

        DB::table('stocks')->where('noref', $pembelian->code)->delete();


        activity()->performedOn($pembelian)->causedBy(Sentinel::getUser()->id)
                  ->log('Pembelian '.$pembelian->name.' is deleted successfully');

        Session::flash('alert-warning', ' Pembelian '.$pembelian->name.' is deleted successfully');

        return redirect('pembelian');
    }

    public function refpb(){
        
        $day = date('mdy');

        $trx = DB::select(
               DB::raw("SELECT CONCAT('PB','-','$day','-',MAX(id)+1)
                         as inc  
                         from pembelians"));


    
      if(!empty($trx[0]->inc)){
      
      $available = $trx[0]->inc;
                    }

      else{
          $available = 'PB-'.$day.'-1';
        }

      return $available;
           }


     public function getharga(){

      $sampah = Input::get('sampah');


      $harga = DB::select(
                  DB::raw("SELECT buy_price FROM sampahs where id  = ".$sampah.""));
      $availables = '';
      if(!empty($harga)){
      foreach($harga as $item){
                $av = ''.(empty($item->buy_price)? "No Data" :$item->buy_price).'';
                              $availables .= $av;
                              }
      $available = $availables;
                    }

      else{
          $available ='No Data';
        }

      return $available;
           }



  

}
