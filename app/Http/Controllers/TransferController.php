<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transfer;
use App\Sampah;
use App\Satuan;
use App\Lokasi;
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
        $transfer = Transfer::whereMonth('created_at', '=', date('m'))->get();

        return view('backEnd.transfer.index', compact('transfer'));
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

        return view('backEnd.transfer.create',compact('sampahs','satuans','gudangs','datenow'));
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

        
      $model = Transfer::create($request->all());
      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->log('Transfer '.$model->name.' is created successfully');

      $day = date('mdy');
      $code = DB::select(
               DB::raw("SELECT CONCAT('T-','$day','-',MAX(id)+1)
                         as inc  
                         from transfers GROUP BY id "));

      if(!empty($code)){
        $c = $code[0]->inc;
      }else{
        $c = 'T-'.$day.'-1';
      }
       DB::table('transfers')->where('id',$model->id)->update(['code' => $c]);


      //input detail

        if(!empty($request->sampah)){

        for($i=0;$i<count($request->sampah);$i++){

             if($request->input('sampah')[$i]){

            DB::table('detailtransfers')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'jumlah'=> $request->jumlah[$i]
                                        ,'noref'=> $model->id
                                        ,'gdg_from'=> $model->gdg_from
                                        ,'gdg_to'=> $model->gdg_to
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            //gdg_from
            $stockf= DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gdg_from'
                          GROUP BY sampah"));

            if(!empty($stockf)){
                $qtyf = $stockf[0]->stock - $request->jumlah[$i] ;
            }else{ $qtyf = 0 + $request->jumlah[$i] ;}

            DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_out'=> $request->jumlah[$i]
                                        ,'qty'=> $qtyf
                                        ,'gudang'=> $request->gdg_from
                                        ,'noref'=> $c
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
            //gdg_to
            $stockt= DB::select(
                 DB::raw("SELECT SUM(qty_in) - SUM(qty_out) as stock FROM stocks 
                          WHERE sampah = ".$request->sampah[$i]." and gudang  = '$request->gdg_to'
                          GROUP BY sampah"));

            if(!empty($stockt)){
                $qtyt = $stockt[0]->stock - $request->jumlah[$i] ;
            }else{ $qtyt = 0 + $request->jumlah[$i] ;   }

            DB::table('stocks')->insert(['sampah'=> $request->sampah[$i]
                                        ,'satuan'=> $request->satuan[$i]
                                        ,'qty_in'=> $request->jumlah[$i]
                                        ,'qty'=> $qtyt
                                        ,'gudang'=> $request->gdg_to
                                        ,'noref'=> $c
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                        ,'updated_at'=> date('Y-m-d H:i:s')
                                    ]);
        
            }
        }
        }


      Session::flash('alert-success', 'Transfer '.$model->name.' is created successfully');

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
        $transfer = Transfer::findOrFail($id);

        return view('backEnd.transfer.show', compact('transfer'));
    }

    public function print($id)
    {
        $transfer = Transfer::findOrFail($id);
        $details = DB::select(
                   DB::raw("SELECT d.*, s.name as sampah FROM detailtransfers d 
                            JOIN sampahs s ON s.id = d.sampah
                            WHERE d.noref = '$transfer->id'"));
  

        return view('backEnd.transfer.print', compact('transfer','details'));
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
        $transfer = Transfer::findOrFail($id);

        return view('backEnd.transfer.edit', compact('transfer'));
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
        
        $transfer = Transfer::findOrFail($id);
        $transfer->update($request->all());

        $attributes = $transfer->getOriginal();

        activity()->performedOn($transfer)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Transfer '.$transfer->name.' is updated successfully');

        Session::flash('alert-success', ' Transfer '.$transfer->name.' is updated successfully');

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
        $transfer = Transfer::findOrFail($id);

        $transfer->delete();

        $attributes = $transfer->getOriginal();

        activity()->performedOn($transfer)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Transfer '.$transfer->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Transfer '.$transfer->name.' is deleted successfully');

        return redirect('transfer');
    }

}
