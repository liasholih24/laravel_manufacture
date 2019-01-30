<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StandarLayer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class StandarLayerController extends Controller
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
        $standarlayer = StandarLayer::orderby('standar',' asc')->get();

        return view('backEnd.standarlayer.index', compact('standarlayer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.standarlayer.create');
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

        
      $model = StandarLayer::create($request->all());

      $attributes = $model->getOriginal();

      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarLayer '.$model->name.' is created successfully');

      Session::flash('alert-success', 'StandarLayer '.$model->name.' is created successfully');

        return redirect('standarlayer');
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
        $standarlayer = StandarLayer::findOrFail($id);

        return view('backEnd.standarlayer.show', compact('standarlayer'));
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
        $standarlayer = StandarLayer::findOrFail($id);

        return view('backEnd.standarlayer.edit', compact('standarlayer'));
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
        
        $standarlayer = StandarLayer::findOrFail($id);
        $standarlayer->update($request->all());

        $attributes = $standarlayer->getOriginal();

        activity()->performedOn($standarlayer)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarLayer '.$standarlayer->name.' is updated successfully');

        Session::flash('alert-success', ' StandarLayer '.$standarlayer->name.' is updated successfully');

        return redirect('standarlayer');
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
        $standarlayer = StandarLayer::findOrFail($id);

        $standarlayer->delete();

        $attributes = $standarlayer->getOriginal();

        activity()->performedOn($standarlayer)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarLayer '.$standarlayer->name.' is deleted successfully');

        Session::flash('alert-warnig', ' StandarLayer '.$standarlayer->name.' is deleted successfully');

        return redirect('standarlayer');
    }

}
