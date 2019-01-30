<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StandarFc;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class StandarFcController extends Controller
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
        $standarfc = StandarFc::all();

        return view('backEnd.standarfc.index', compact('standarfc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.standarfc.create');
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

        
      $model = StandarFc::create($request->all());

      $attributes = $model->getOriginal();

      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarFc '.$model->name.' is created successfully');

      Session::flash('alert-success', 'StandarFc '.$model->name.' is created successfully');

        return redirect('standarfc');
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
        $standarfc = StandarFc::findOrFail($id);

        return view('backEnd.standarfc.show', compact('standarfc'));
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
        $standarfc = StandarFc::findOrFail($id);

        return view('backEnd.standarfc.edit', compact('standarfc'));
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
        
        $standarfc = StandarFc::findOrFail($id);
        $standarfc->update($request->all());

        $attributes = $standarfc->getOriginal();

        activity()->performedOn($standarfc)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarFc '.$standarfc->name.' is updated successfully');

        Session::flash('alert-success', ' StandarFc '.$standarfc->name.' is updated successfully');

        return redirect('standarfc');
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
        $standarfc = StandarFc::findOrFail($id);

        $standarfc->delete();

        $attributes = $standarfc->getOriginal();

        activity()->performedOn($standarfc)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarFc '.$standarfc->name.' is deleted successfully');

        Session::flash('alert-warnig', ' StandarFc '.$standarfc->name.' is deleted successfully');

        return redirect('standarfc');
    }

}
