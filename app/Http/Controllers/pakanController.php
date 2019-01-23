<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use App\pakan;
use App\Item;
use App\Satuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class pakanController extends Controller
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
        $pakan = pakan::all();

        return view('backEnd.pakan.index', compact('pakan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $items = Item::where('nesting',1)->where('parent_id',1)->get();
        $satuans = Satuan::where('status','=',3)->get();
        return view('backEnd.pakan.create',compact('items','satuans'));
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

        
      $model = pakan::create($request->all());

      //input detail

      if(!empty($request->item)){
        for($i=0;$i<count($request->item);$i++){
             if($request->input('item')[$i]){
            DB::table('pakan_items')->insert(['pakan'=> $model->id
                                        ,'item'=> $request->item[$i]
                                        ,'harga'=> $request->harga[$i]
                                        ,'qty'=> $request->qty[$i]
                                        ,'rupiah'=> $request->rupiah[$i]
                                        ,'created_by'=> $model->created_by
                                        ,'created_at'=> date('Y-m-d H:i:s')
                                    ]);  
            }
        }
        }

     
      Session::flash('alert-success', 'pakan '.$model->name.' is created successfully');

        return redirect('pakan');
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
        $pakan = pakan::findOrFail($id);

        return view('backEnd.pakan.show', compact('pakan'));
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
        $pakan = pakan::findOrFail($id);
        $items = Item::where('nesting',1)->where('parent_id',1)->get();
        $satuans = Satuan::where('status','=',3)->get();
        $details = DB::select(
            DB::raw("SELECT * FROM 
                      pakan_items WHERE pakan = $id"));

                 

        return view('backEnd.pakan.edit', compact('pakan','items','satuans','details'));
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
        
        $pakan = pakan::findOrFail($id);
        $pakan->update($request->all());

        $attributes = $pakan->getOriginal();

        activity()->performedOn($pakan)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('pakan '.$pakan->name.' is updated successfully');

        Session::flash('alert-success', ' pakan '.$pakan->name.' is updated successfully');

        return redirect('pakan');
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
        $pakan = pakan::findOrFail($id);

        $pakan->delete();

        $attributes = $pakan->getOriginal();

        activity()->performedOn($pakan)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('pakan '.$pakan->name.' is deleted successfully');

        Session::flash('alert-warnig', ' pakan '.$pakan->name.' is deleted successfully');

        return redirect('pakan');
    }


    public function getharga()
        {
            $id = Input::get('id');

            $q = DB::select(
                      DB::raw("SELECT  AVG(saldo_in) as harga 
                                FROM v_stocks WHERE item_id = $id GROUP BY item_id"));

            if(!empty($q)){
                 $harga = $q[0]->harga;
                        }

                else{
                    $harga = 0;
                }
            
            return json_encode( $harga );


        }

}
