<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Penjualan;
use App\Penadah;
use App\Item;
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

class PenjualanController extends Controller
{

protected function validator(Request $request)
{
/*dicustom*/
  return Validator::make($request->all(), [
     'total_rp' => 'required'
  ]);
}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $date = \Carbon\Carbon::today()->subDays(60);
        $penjualan = Penjualan::where('created_at', '>=', date($date))->get();


        return view('backEnd.penjualan.index', compact('penjualan'));
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

        return view('backEnd.penjualan.create',compact('perusahaans','sampahs','satuans','gudangs','datenow'));
    }

    public function pos()
    {
        $perusahaans = Penadah::where('status','=','3')->orderby('id','asc')->get();
        $items = Item::where('status','=','3')->where('nesting','=','1')->orderby('id','asc')->get();
        $satuans = Satuan::where('status','=','3')->orderby('id','asc')->get();
        $gudangs = Lokasi::orderby('id','asc')->get();
        $datenow = date('Y-m-d'); 

        $trx = DB::select(
            DB::raw("SELECT CONCAT('PJ','-',date(now()),'-',MAX(id)+1)
                      as inc  
                      from penjualans"));

        if(!empty($trx)){
           $code =  $trx[0]->inc;
        }else{
            $code = 'PJ-'.$datenow.'-1';
        }

        return view('backEnd.penjualan.pos',compact('perusahaans','items','satuans','gudangs','datenow','code'));
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
  
        
      $model = Penjualan::create($request->all());
      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->log('Penjualan '.$request->code.' is created successfully');


      //input detail

        if(!empty($request->item)){

        for($i=0;$i<count($request->item);$i++){

             if($request->input('item')[$i]){

            DB::table('detailpenjualans')->insert(['item'=> $request->item[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'harga_jual'=> $request->harga_jual[$i]
                                        ,'nilai_rp'=> $request->nilai_rp[$i]
                                        ,'parent_id'=> $model->id
                                        ,'created_at'=> $request->created_at
                                       ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);


             $stock = DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock , SUM(saldo_in) - SUM(saldo_out) as saldo FROM stocks 
                          WHERE item = ".$request->item[$i]." and gudang  = '$request->gudang'
                          GROUP BY item"));

            if(!empty($stock)){
                $qty = $stock[0]->stock - $request->jumlah[$i] ;
                 $saldo = $stock[0]->saldo - $request->harga_jual[$i] ;
            }else{ $qty = 0 + $request->jumlah[$i] ; $saldo = 0 + $request->harga_jual[$i] ; }

            DB::table('stocks')->insert(['item'=> $request->item[$i]
                                        ,'qty_out'=> $request->jumlah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty'=> $qty
                                        ,'saldo_out'=> $request->harga_jual[$i]
                                        ,'saldo'=> $saldo
                                        ,'gudang'=> $request->gudang
                                        ,'noref'=> $request->code
                                        ,'created_at'=> $request->created_at
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
        
            }
        }
        }

      Session::flash('alert-success', 'Penjualan is created successfully');

        return redirect('pos');
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
        $penjualan = Penjualan::findOrFail($id);

        return view('backEnd.penjualan.show', compact('penjualan'));
    }

    /*public function print($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $details = DB::select(
                   DB::raw("SELECT d.*, s.name as sampah FROM detailpenjualans d 
                            JOIN sampahs s ON s.id = d.sampah
                            WHERE d.parent_id = '$penjualan->id'"));
  

        return view('backEnd.penjualan.print', compact('penjualan','details'));
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
        $details = DB::select(
                 DB::raw("SELECT * FROM detailpenjualans where parent_id = $id"));  
        $perusahaans = Penadah::where('status','=','3')->orderby('id','asc')->get();
        $sampahs = Sampah::where('status','=','3')->where('parent_id','<>',null)->orderby('id','asc')->get();
        $satuans = Satuan::where('status','=','3')->orderby('id','asc')->get();
        $gudangs = Lokasi::orderby('id','asc')->get();
        $datenow = date('Y-m-d'); 

        return view('backEnd.penjualan.edit', compact('penjualan','perusahaans','sampahs','satuans','gudangs','datenow','details'));
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
        
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->all());

        DB::table('detailpenjualans')->where('parent_id',$id)->delete();
        DB::table('stocks')->where('noref',$request->code)->delete();


        if(!empty($request->sampah)){

        for($i=0;$i<count($request->sampah);$i++){

             if($request->input('sampah')[$i]){

            DB::table('detailpenjualans')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'harga_jual'=> $request->harga_jual[$i]
                                        ,'nilai_kg'=> $request->nilai_kg[$i]
                                        ,'nilai_rp'=> $request->nilai_rp[$i]
                                        ,'parent_id'=> $id
                                        ,'created_at'=> $request->created_at
                                       ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            $stock = DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock , SUM(saldo_in) - SUM(saldo_out) as saldo FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gudang'
                          GROUP BY sampah"));

            if(!empty($stock)){
                $qty = $stock[0]->stock - $request->jumlah[$i] ;
                 $saldo = $stock[0]->saldo - $request->harga_jual[$i] ;
            }else{ $qty = 0 + $request->jumlah[$i] ; $saldo = 0 + $request->harga_jual[$i] ; }

            DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_out'=> $request->jumlah[$i]
                                        ,'qty'=> $qty
                                        ,'saldo_out'=> $request->harga_jual[$i]
                                        ,'saldo'=> $saldo
                                        ,'gudang'=> $request->gudang
                                        ,'noref'=> $request->code
                                        ,'created_at'=> $request->created_at
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
        
            }
        }
        }

        activity()->performedOn($penjualan)->causedBy(Sentinel::getUser()->id)->log('Penjualan '.$request->code.' is updated successfully');

        Session::flash('alert-success', ' Penjualan '.$request->code.' is updated successfully');

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
        $penjualan = Penjualan::findOrFail($id);

        $penjualan->delete();

        DB::table('detailpenjualans')->where('parent_id', $penjualan->id)->delete();

        DB::table('stocks')->where('noref', $penjualan->code)->delete();


        activity()->performedOn($penjualan)->causedBy(Sentinel::getUser()->id)
                  ->log('Penjualan '.$penjualan->name.' is deleted successfully');

        Session::flash('alert-warning', ' Penjualan '.$penjualan->name.' is deleted successfully');

        return redirect('penjualan');
    }

    public function refpj(){

        $day = date('mdy');

        $trx = DB::select(
               DB::raw("SELECT CONCAT('PB','-','$day','-',MAX(id)+1)
                         as inc  
                         from penjualans"));


    
      if(!empty($trx[0]->inc)){
      
      $available = $trx[0]->inc;
                    }

      else{
          $available = 'PJ-'.$day.'-1';
        }

      return $available;
           }

 public function cekstock(){

      $gudang = Input::get('gudang');
      $sampah = Input::get('sampah');

        $cekstocks = DB::select(
               DB::raw("SELECT SUM(qty_in - qty_out) as jml 
                         from stocks where 1=1 AND sampah = '$sampah' AND gudang = '$gudang' GROUP BY sampah"));
      $availables = '';
      if(!empty($cekstocks)){
      foreach($cekstocks as $cekstock){
                $av = ''.(empty($cekstock->jml)?   :$cekstock->jml).'';
                              $availables .= $av;
                              }
      $available = $availables;
                    }

      else{
          $available = 0;
        }

      return $available;
           }

  

}
