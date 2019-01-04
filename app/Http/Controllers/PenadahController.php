<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Penadah;
use App\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Spatie\Activitylog\Models\Activity as Activity;

class PenadahController extends Controller
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
        $penadah = Penadah::all();

        return view('backEnd.penadah.index', compact('penadah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $activations = Status::where('parent_id','=','1')->orderBy('id','desc')->get()->pluck('name','id');
        return view('backEnd.penadah.create',compact('activations'));
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

        
      $model = Penadah::create($request->all());

      $attributes = $model->getOriginal();

      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Penadah '.$model->name.' is created successfully');

      Session::flash('alert-success', 'Penadah '.$model->name.' is created successfully');

        return redirect('penadah');
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
        $penadah = Penadah::findOrFail($id);
        $logs = Activity::where('subject_type', 'App\Penadah')->where('subject_id',$id)->get();

        return view('backEnd.penadah.show', compact('penadah','logs'));
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
        $penadah = Penadah::findOrFail($id);
        $activations = Status::where('parent_id','=','1')->orderBy('id','desc')->get()->pluck('name','id');

        return view('backEnd.penadah.edit', compact('penadah','activations'));
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
        
        $penadah = Penadah::findOrFail($id);
        $penadah->update($request->all());

        $attributes = $penadah->getOriginal();

        Session::flash('alert-success', ' Penadah '.$penadah->name.' is updated successfully');

        return redirect('penadah');
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
        $penadah = Penadah::findOrFail($id);

        $penadah->delete();

        $attributes = $penadah->getOriginal();

        activity()->performedOn($penadah)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Penadah '.$penadah->name.' is deleted successfully');

        Session::flash('alert-warning', ' Penadah '.$penadah->name.' is deleted successfully');

        return redirect('penadah');
    }

}
