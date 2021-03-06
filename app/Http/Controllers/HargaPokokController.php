<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\HargaPokok;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class HargaPokokController extends Controller
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
        $hargapokok = HargaPokok::all();

        return view('backEnd.hargapokok.index', compact('hargapokok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $datenow = date('Y-m-d'); 
        return view('backEnd.hargapokok.create',compact('datenow'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        
      $model = HargaPokok::create($request->all());

      Session::flash('alert-success', 'HargaPokok '.$model->tgl_hpp.' is created successfully');

        return redirect('hargapokok');
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
        $hargapokok = HargaPokok::findOrFail($id);

        return view('backEnd.hargapokok.show', compact('hargapokok'));
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
        $hargapokok = HargaPokok::findOrFail($id);

        return view('backEnd.hargapokok.edit', compact('hargapokok'));
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
  
        
        $hargapokok = HargaPokok::findOrFail($id);
        $hargapokok->update($request->all());

       
        Session::flash('alert-success', ' Harga Pokok '.$hargapokok->tgl_hpp.' is updated successfully');

        return redirect('hargapokok');
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
        $hargapokok = HargaPokok::findOrFail($id);

        $hargapokok->delete();

        $attributes = $hargapokok->getOriginal();

        activity()->performedOn($hargapokok)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('HargaPokok '.$hargapokok->name.' is deleted successfully');

        Session::flash('alert-warnig', ' HargaPokok '.$hargapokok->name.' is deleted successfully');

        return redirect('hargapokok');
    }

}
