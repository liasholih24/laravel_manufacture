<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Log;
use App\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class StatusController extends Controller
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
      $filters = Status::where('depth',0)->get();
      $tables = Status::where('depth',1)->get();

      $id= false;
      return view('backEnd.status.index', compact('tables','filters','id'));
    }

    public function filter($id)
    {
      $filters = Status::where('depth',0)->get();
      $table = Status::where('depth',1)->where('parent_id',$id)->get();
         if($table->first == ""){
             $tables = Status::where('depth',0)->where('parent_id',$id)->get();
           }else{$tables = Status::where('depth',1)->where('parent_id',$id)->get();}

         $id = $id;
          return view('backEnd.status.index', compact('tables','filters','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $statuses = Status::where('depth','=',0)->get();
        $activations = Status::where('parent_id','=','1')->pluck('name', 'id');

        return view('backEnd.status.create',compact ('statuses','activations'));
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


    if ($request->kategori == "uncategories")
    {
    $root = Status::create(['code' => $request->code
                              ,'name' => $request->name
                              ,'desc' => $request->desc
                              ,'status' => $request->status
                              ,'created_by' => $request->created_by
                              ,'updated_by' => $request->updated_by
                            ]);
    $attributes = $root->getOriginal();
    activity()->performedOn($root)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Status '.$request->name.' is created successfully');

    }
    else {
    $root = Status::where('id', '=', $request->kategori)->first();
    $child1 = $root->children()->create(['code' => $request->code
                              ,'name' => $request->name
                              ,'desc' => $request->desc
                              ,'status' => $request->status
                              ,'created_by' => $request->created_by
                              ,'updated_by' => $request->updated_by
                            ]);
    $attributes = $child1->getOriginal();
    activity()->performedOn($child1)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Status '.$request->name.' is created successfully');

    }




      Session::flash('alert-success', 'Status '.$request->name.' is created successfully');

      return redirect('status');
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
      $node = Status::findOrFail($id);
      $nodes = Status::where('parent_id',$id)->get();
      $logs = Log::where('subject_type', 'App\Status')->where('subject_id',$id)->get();
      return view('backEnd.status.show', compact('nodes','node','logs'));
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
        $status = Status::findOrFail($id);
        $statuses = Status::all();
        $activations = Status::where('parent_id','=','1')->pluck('name', 'id');

        return view('backEnd.status.edit', compact('status','statuses','activations'));
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

        $status = Status::findOrFail($id);
        $status->update($request->all());

        $attributes = $status->getOriginal();

        activity()->performedOn($status)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Status '.$status->name.' is updated successfully');

        Session::flash('alert-success', ' Status '.$status->name.' is updated successfully');

        return redirect('status');
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
        $status = Status::findOrFail($id);

        $status->delete();

        $attributes = $status->getOriginal();

        activity()->performedOn($status)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Status '.$status->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Status '.$status->name.' is deleted successfully');

        return redirect('status');
    }

}
