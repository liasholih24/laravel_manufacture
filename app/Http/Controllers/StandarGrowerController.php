<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StandarGrower;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class StandarGrowerController extends Controller
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
        $standargrower = StandarGrower::all();

        return view('backEnd.standargrower.index', compact('standargrower'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.standargrower.create');
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

        
      $model = StandarGrower::create($request->all());

      $attributes = $model->getOriginal();

      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarGrower '.$model->name.' is created successfully');

      Session::flash('alert-success', 'StandarGrower '.$model->name.' is created successfully');

        return redirect('standargrower');
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
        $standargrower = StandarGrower::findOrFail($id);

        return view('backEnd.standargrower.show', compact('standargrower'));
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
        $standargrower = StandarGrower::findOrFail($id);

        return view('backEnd.standargrower.edit', compact('standargrower'));
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
        
        $standargrower = StandarGrower::findOrFail($id);
        $standargrower->update($request->all());

        $attributes = $standargrower->getOriginal();

        activity()->performedOn($standargrower)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarGrower '.$standargrower->name.' is updated successfully');

        Session::flash('alert-success', ' StandarGrower '.$standargrower->name.' is updated successfully');

        return redirect('standargrower');
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
        $standargrower = StandarGrower::findOrFail($id);

        $standargrower->delete();

        $attributes = $standargrower->getOriginal();

        activity()->performedOn($standargrower)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('StandarGrower '.$standargrower->name.' is deleted successfully');

        Session::flash('alert-warnig', ' StandarGrower '.$standargrower->name.' is deleted successfully');

        return redirect('standargrower');
    }

}
