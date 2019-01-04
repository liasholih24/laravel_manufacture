<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Satuan;
use App\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Spatie\Activitylog\Models\Activity as Activity;
class SatuanController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }


    protected function validator(Request $request)
    {
    /*dicustom*/
      return Validator::make($request->all(), [
        'name' => 'required|max:50'
        ,'code' => 'required|max:7|unique:satuans'
        ,'status' => 'required'
      ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $satuan = Satuan::all();

        return view('backEnd.satuan.index', compact('satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $activations = Status::where('parent_id','=','1')->get()->pluck('name','id');
        $basises = Satuan::where('status','=','3')->where('basis','=',null)->get()->pluck('code','id');
        return view('backEnd.satuan.create', compact('activations','basises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Satuan::create($request->all());

       // activity()->performedOn($child1)->causedBy(Sentinel::getUser()->id)->withProperties(['new'=>$child1,'old'=>$child1])->log('Sampah '.$request->name.' is created successfully');

        Session::flash('alert-success', 'Satuan '.$request->name.' is created successfully');

        return redirect('satuan');
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
        $node = Satuan::findOrFail($id);
        $logs = Activity::where('subject_type', 'App\Sampah')->where('subject_id',$id)->get();
        return view('backEnd.satuan.show', compact('node','logs'));
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
        $satuan = Satuan::findOrFail($id);

        $activations = Status::where('parent_id','=','1')->get()->pluck('name','id');
        $basises = Satuan::where('status','=','3')->where('basis','=',null)->get()->pluck('code','id');

        return view('backEnd.satuan.edit', compact('satuan','activations','basises'));
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
        
        $satuan = Satuan::findOrFail($id);
        $satuan->update($request->all());

        Session::flash('alert-success', 'Satuan '.$request->name.' is created successfully');

        return redirect('satuan/'.$id.'');
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
        $satuan = Satuan::findOrFail($id);

        $satuan->delete();

        Session::flash('message', 'Satuan deleted!');
        Session::flash('status', 'success');

        return redirect('satuan');
    }

}
