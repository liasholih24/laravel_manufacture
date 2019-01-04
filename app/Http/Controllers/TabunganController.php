<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Tabungan;
use App\Nasabah;
use App\Sampah;
use App\Satuan;
use App\Lokasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Sentinel;
use Validator;
use DB;

class TabunganController extends Controller
{


protected function validator(Request $request)
{
/*dicustom*/
  return Validator::make($request->all(), [
     'norek' => 'required',
     'code' => 'required',
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
        $tabungan = Tabungan::where('created_at', '>=', date($date))->get();

        return view('backEnd.tabungan.index', compact('tabungan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
  
        $nasabahs = Nasabah::where('status','=','3')->orderby('id','asc')->get();
        $sampahs = Sampah::where('status','=','3')->where('parent_id','<>',null)->orderby('id','asc')->get();

        $satuans = Satuan::where('status','=','3')->orderby('id','asc')->get(); 

        $gudang = Lokasi::where('parent_id','=',Sentinel::getUser()->unit_id)->where('type','13')->first();
        $gudangs = Lokasi::where('type','=','13')->orderby('id','asc')->get();
        $datenow = date('Y-m-d');         
        return view('backEnd.tabungan.create',compact('nasabahs','sampahs','satuans','gudang','datenow','gudangs'));
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

        $saldo = DB::select(
                 DB::raw("SELECT SUM(kredit) - SUM(debit) as saldo FROM tabungans 
                          WHERE norek = '$request->norek' GROUP BY norek"));

        if(!empty($saldo)){
            if(empty($saldo[0]->saldo)){
                $saldo = 0;
             }else if(!empty($saldo[0]->saldo)){
                $saldo = $saldo[0]->saldo;
            }

            $cek_limit = $saldo - $request->debit;
        }
        else if(empty($saldo)){
            $saldo = 0; $cek_limit = 0;
        }

        

        if($saldo == 0 && !empty($request->debit)){

        Session::flash('alert-warning', 'Nasabah '.$request->norek.' tidak dapat melakukan debit : Saldo tidak mencukupi');

        } 
        /*
        else if ($cek_limit <= 10000 && !empty($request->debit)){

            Session::flash('alert-warning', 'Nasabah '.$request->norek.' tidak dapat melakukan debit : Saldo tidak mencukupi batas pencairan');
        } */
        else {

          if($request->code == "R"){

            $tabungan =  Tabungan::create(['norek'=> $request->norek
                                            ,'code'=> $request->code
                                            ,'trx_code'=> $request->trx_code
                                            ,'debit'=> $request->kredit
                                            ,'kredit'=> 0
                                            ,'created_by'=> $request->created_by
                                            ,'created_at'=> $request->created_at
                                            ,'keterangan'=> $request->keterangan
                                          ]);

          }else{

          $tabungan =  Tabungan::create($request->all());
          }
          
          $saldo = DB::select(
                 DB::raw("SELECT SUM(kredit) - SUM(debit) as saldo FROM tabungans 
                          WHERE norek = '$request->norek' GROUP BY norek"))[0];

          //get nasabah id
          $nasabah = DB::select(
                 DB::raw("SELECT id as nasabah_id FROM nasabahs 
                          WHERE norek = '$request->norek' "));
          
          //update last id
          DB::table('tabungans')->where('id',$tabungan->id)
              ->update(['saldo' => $saldo->saldo,'nasabah_id' => $nasabah[0]->nasabah_id]);
            
          Session::flash('alert-success', 'Transaksi dengan No. Rekening '.$request->norek.' berhasil diproses');

        } 

        //input detail

        if(!empty($request->sampah)){

        for($i=0;$i<count($request->sampah);$i++){

             if($request->input('sampah')[$i]){

            DB::table('detailtabungans')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'harga_beli'=> $request->harga_beli[$i]
                                        ,'nilai_kg'=> $request->nilai_kg[$i]
                                        ,'nilai_rp'=> $request->nilai_rp[$i]
                                        ,'trx_code'=> $request->trx_code
                                        ,'created_at'=> $request->created_at
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            $stock = DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock,SUM(saldo_in) - SUM(saldo_out) as saldo FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gudang'
                          GROUP BY sampah"));

            

            if($request->code == "R"){

              if(!empty($stock)){
                $qty = $stock[0]->stock - $request->jumlah[$i] ;
                $saldo = $stock[0]->saldo - $request->harga_beli[$i] ;
                }else{ $qty = 0 + $request->jumlah[$i] ; $saldo = 0 + $request->harga_beli[$i] ;
                }

               DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_out'=> $request->jumlah[$i]
                                        ,'qty'=> $qty
                                        ,'saldo_out'=> $request->harga_beli[$i]
                                        ,'saldo'=> $saldo
                                        ,'gudang'=> $request->gudang
                                        ,'noref'=> $request->trx_code
                                        ,'created_at'=> $request->created_at
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            }else{
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
                                        ,'noref'=> $request->trx_code
                                        ,'created_at'=> $request->created_at
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            }
        
            }
        }
        }



        return redirect('tabungan');
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
        $tabungan = Tabungan::findOrFail($id);

        return view('backEnd.tabungan.show', compact('tabungan'));
    }

    public function print($id)
    {
        $tabungan = Tabungan::findOrFail($id);
        $details = DB::select(
                   DB::raw("SELECT d.*, s.name as sampah FROM detailtabungans d 
                            JOIN sampahs s ON s.id = d.sampah
                            WHERE trx_code = '$tabungan->trx_code'"));
     

        return view('backEnd.tabungan.print', compact('tabungan','details'));
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
        $tabungan = Tabungan::findOrFail($id);

        return view('backEnd.tabungan.edit', compact('tabungan'));
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
        
        $tabungan = Tabungan::findOrFail($id);
        $tabungan->update($request->all());

        Session::flash('message', 'Tabungan updated!');
        Session::flash('status', 'success');

        return redirect('tabungan');
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
        $tabungan = Tabungan::findOrFail($id);

        $tabungan->delete();

        DB::table('detailtabungans')->where('trx_code', $tabungan->trx_code)->delete();

        DB::table('stocks')->where('noref', $tabungan->trx_code)->delete();


        activity()->performedOn($tabungan)->causedBy(Sentinel::getUser()->id)
                  ->log('Tabungan '.$tabungan->trx_code.' is deleted successfully');

        Session::flash('alert-warning', ' Tabungan '.$tabungan->trx_code.' is deleted successfully');

        return redirect('tabungan');
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

     public function getsatuan(){

      $satuan = Input::get('satuan');


      $sv = DB::select(
                  DB::raw("SELECT standard_value FROM satuans where code  = '$satuan' "));
      $availables = '';
      if(!empty($sv)){
      foreach($sv as $item){
                $av = ''.(empty($item->standard_value)? "No Data" :$item->standard_value).'';
                              $availables .= $av;
                              }
      $available = $availables;
                    }

      else{
          $available ='No Data';
        }

      return $available;
           }

    public function gettrxcode(){

      $norek = Input::get('norek');
      $code = Input::get('code');
      $day = date('mdy');

        $trx = DB::select(
               DB::raw("SELECT CONCAT('$code','-',norek,'-','$day','-',MAX(id)+1)
                         as inc  
                         from tabungans where norek = '$norek' GROUP BY norek"));
      $availables = '';
      if(!empty($trx)){
      foreach($trx as $item){
                $av = ''.(empty($item->inc)?   :$item->inc).'';
                              $availables .= $av;
                              }
      $available = $availables;
                    }

      else{
          $available = ''.$code.'-'.$norek.'-'.$day.'-1';
        }

      return $available;
    }

}
