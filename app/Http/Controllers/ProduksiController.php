<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use App\Produksi;
use App\Pemakaian; 
use App\DetailPemakaian;
use App\Item;
use App\Lokasi;
use App\Satuan;
use App\pakan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class ProduksiController extends Controller
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
        $produksi = Produksi::all();

        return view('backEnd.produksi.index', compact('produksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $kandangs = Lokasi::where('depth',1)->pluck('name','id');
        $pakans = pakan::pluck('name','id');
        $satuans = Satuan::where('status','=',3)->get()->pluck('name','id');
        $datenow = date('Y-m-d'); 
        return view('backEnd.produksi.create', compact('datenow','kandangs','pakans','satuans'));
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

        
      $model = Produksi::create($request->all());


      //input ke pemakaian


      $number = Pemakaian::max('number');
        if($number==null){
            $number = 'RC-000001';
        }
        else{
            $number = 'RC-'.sprintf('%06d', substr($number, 3) + 1);
        }


        $pemakaians = Pemakaian::create(['number' => $number
                                        , 'storage_id' => $model->kandang
                                        , 'date' => $model->prod_tgl
                                        , 'desc' => 'Pemakaian pakan dari proses recording '.$number
                                        , 'created_at' => $model->created_at
                                        , 'created_by' => $model->created_by]);

        $pakanitems = DB::select(
            DB::raw("SELECT * FROM pakan_items a
                WHERE pakan = ".$model->pakan_jenis.""));
      
        
        if(!empty($pakanitems)){
            foreach($pakanitems as $pakanitem){
                    $dpemakaians = DetailPemakaian::create(['pemakaian_id' => $pemakaians->id
                    , 'item_id' => $pakanitem->item
                    , 'qty' => $pakanitem->qty
                    , 'date' => $model->prod_tgl
                    , 'desc' => 'ID Produksi-'.$model->id
                    , 'created_at' => $model->created_at
                    , 'created_by' => $model->created_by]);
            }
            }
            
        
      //end ke pemakaian
   



      Session::flash('alert-success', 'Produksi '.$model->name.' is created successfully');

      return redirect('produksi');
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
        $produksi = Produksi::findOrFail($id);

        return view('backEnd.produksi.show', compact('produksi'));
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
        $produksi = Produksi::findOrFail($id);
        $kandangs = Lokasi::where('depth',1)->pluck('name','id');
        $pakans = pakan::pluck('name','id');
        $satuans = Satuan::where('status','=',3)->get()->pluck('name','id');
        $datenow = date('Y-m-d'); 

        return view('backEnd.produksi.edit', compact('produksi','kandangs','pakans','satuans','datenow'));
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
        
        $produksi = Produksi::findOrFail($id);
        $produksi->update($request->all());



        //input ke pemakaian
            // delete dulu detail pemakaian
          $pemakaians =   DB::select(
              DB::raw("SELECT id, `number` from pemakaians WHERE `desc` =  'ID Produksi-$id' "));

            $detailpemakaian =   DetailPemakaian::where('pemakaian_id', $pemakaians[0]->id)->delete();

           $pakanitems = DB::select(
                DB::raw("SELECT * FROM pakan_items a
                    WHERE pakan = ".$produksi->pakan_jenis.""));
    
      
      if(!empty($pakanitems)){
          foreach($pakanitems as $pakanitem){
                  $dpemakaians = DetailPemakaian::create(['pemakaian_id' => $pemakaians[0]->id
                  , 'item_id' => $pakanitem->item
                  , 'qty' => $pakanitem->qty
                  , 'date' => $produksi->prod_tgl
                  , 'desc' => 'Pemakaian pakan dari proses recording '.$pemakaians[0]->number
                  , 'created_at' => $produksi->created_at
                  , 'created_by' => $produksi->created_by]);
          }
          }
          
      
    //end ke pemakaian

        Session::flash('alert-success', ' Produksi '.$produksi->name.' is updated successfully');

        return redirect('produksi');
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
        $produksi = Produksi::findOrFail($id);

        $produksi->delete();

        $attributes = $produksi->getOriginal();

        activity()->performedOn($produksi)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Produksi '.$produksi->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Produksi '.$produksi->name.' is deleted successfully');

        return redirect('produksi');
    }

    public function jmlakhir()
        {
            $id = Input::get('id');

            $q = DB::select(
                      DB::raw("SELECT jml_akhir as jml_akhir 
                                FROM produksis WHERE kandang = $id ORDER BY created_at DESC
                                LIMIT 1
                             "));

            if(!empty($q)){
                 $jml_akhir = $q[0]->jml_akhir;
                        }

                else{
                    $jml_akhir = 0;
                }
            
            return json_encode( $jml_akhir );


        }

}
