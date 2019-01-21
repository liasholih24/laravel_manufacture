<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Log;
use App\Status;
use App\Lokasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class LokasiController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

protected function validator(Request $request)
{
/*dicustom*/
  return Validator::make($request->all(), [
     'name' => 'required|max:35|min:2|string'
  ]);
}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $filters = Lokasi::where('depth',0)->get();
      $tables = Lokasi::where('depth',1)->get();

      $id= false;
      return view('backEnd.lokasi.index', compact('tables','filters','id'));
    }

    public function area()
    {
      $tables = Lokasi::where('depth',0)->get();

      $id= false;
      return view('backEnd.lokasi.area', compact('tables','id'));
    }

    public function filter($id)
    {
      $filters = Lokasi::where('depth',0)->get();
      $tables = Lokasi::where('depth',1)->where('parent_id',$id)->get();

      $id = $id;
          return view('backEnd.lokasi.index', compact('tables','filters','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $statuses = Lokasi::all();
        $id = 1;
        return view('backEnd.lokasi.create',compact ('statuses','id'));
    }

    public function creates()
    {
        $statuses = Lokasi::all();
        $id = 0;
        return view('backEnd.lokasi.create',compact ('statuses','id'));
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


    if (empty($request->kategori))
    {
    $root = Lokasi::create(['code' => $request->code
                              ,'name' => $request->name
                              ,'type' => $request->type
                              ,'address' => $request->address
                              ,'notes' => $request->notes
                              ,'status' => $request->status
                              ,'created_by' => $request->created_by
                              ,'updated_by' => $request->updated_by
                            ]);
    $attributes = $root->getOriginal();
    activity()->performedOn($root)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Lokasi '.$request->name.' is created successfully');

    Session::flash('alert-success', 'Area '.$request->name.' is created successfully');

      return redirect('area');
    }
    else {
    $root = Lokasi::where('id', '=', $request->kategori)->first();
    $child1 = $root->children()->create(['code' => $request->code
                              ,'name' => $request->name
                              ,'type' => $request->type
                              ,'address' => $request->address
                              ,'notes' => $request->notes
                              ,'status' => $request->status
                              ,'created_by' => $request->created_by
                              ,'updated_by' => $request->updated_by
                            ]);
    $attributes = $child1->getOriginal();
    activity()->performedOn($child1)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Lokasi '.$request->name.' is created successfully');
 
    Session::flash('alert-success', 'Lokasi '.$request->name.' is created successfully');

    return redirect('lokasi');

    }

      
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
      $node = Lokasi::findOrFail($id);
      $nodes = Lokasi::where('parent_id',$id)->get();
      $logs = Log::where('subject_type', 'App\Lokasi')->where('subject_id',$id)->get();
      return view('backEnd.lokasi.show', compact('nodes','node','logs'));
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
        $lokasi = Lokasi::findOrFail($id);
        $lokasis = Lokasi::where('depth','=',0)->pluck('name', 'id');
        $activations = Status::where('parent_id','=','1')->pluck('name', 'id');
        $types = Status::where('parent_id','=','12')->orderby('id','desc')->pluck('name', 'id');

        return view('backEnd.lokasi.edit', compact('lokasi','lokasis','activations','types'));
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

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());

        Session::flash('alert-success', ' Lokasi '.$lokasi->name.' is updated successfully');

        return redirect('lokasi/'.$id.'');
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
        $lokasi = Lokasi::findOrFail($id);

        $lokasi->delete();

        $attributes = $lokasi->getOriginal();

        activity()->performedOn($lokasi)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Lokasi '.$lokasi->name.' is deleted successfully');

        Session::flash('alert-warning', ' Lokasi '.$lokasi->name.' is deleted successfully');

        return redirect('lokasi');
    }

}
