<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sampah;
use App\Log;
use App\Status;
use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Spatie\Activitylog\Models\Activity as Activity;

class SampahController extends Controller
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
        ,'code' => 'required|unique:sampahs'
      ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function index()
     {
        $filters = Sampah::where('nesting',0)->get();
        $table = Sampah::where('nesting',1)->get();
          if(empty($table)){
              $tables = Sampah::where('nesting',0)->get();
            }else{$tables = Sampah::where('nesting',1)->get();}
       $id= false;
        return view('backEnd.sampah.index', compact('tables','filters','id'));
     }

     public function filter($id)
     {
       $filters = Sampah::where('nesting',0)->get();
       $tables = Sampah::where('nesting',1)->where('parent_id',$id)->get();

          $id = $id;
           return view('backEnd.sampah.index', compact('tables','filters','id'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Sampah::all();
        $activations = Status::where('parent_id','=','1')->orderby('id','desc')->get()->pluck('name','id');
        $satuans = Satuan::where('status','=',3)->get()->pluck('name','id');
        $types = Status::where('parent_id','=','16')->get()->pluck('name','id');
        $level = 0;
        $id = "";
        return view('backEnd.sampah.create',compact('categories','activations','level','id','satuans','types'));
    }
    public function creates($id)
    {
        $id = $id;
        $sampah = Sampah::where('status',3)->where('id','=',$id)->first();
        $categories = Sampah::where('status',3)->get();
        $activations = Status::where('parent_id','=','1')->orderby('id','desc')->get()->pluck('name','id');
        $satuans = Satuan::where('status','=',3)->get()->pluck('name','id');
        $types = Status::where('parent_id','=','16')->get()->pluck('name','id');
        $level = 0;
        if ($id==0) {
          $sampah = Sampah::where('status',3)->where('nesting','=',1)->get();
        }
        return view('backEnd.sampah.create',compact('sampah','activations','categories','level','id','satuans','types'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
    //  return $request->all();
   if ($this->validator($request)->fails()) {
        return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
    }



if ($request->sampah == "uncategories")
{

  return 1;

  $title = "Kategori";
  $subtitle = "Kelola Kategori Barang";
  $depthname = "Sub Kategori";
  $depthicon = "fa-list";

$root = Sampah::create(['code' => $request->code
                          ,'name' => $request->name
                          ,'status' => $request->status
                          ,'note' => $request->note
                          ,'title' => $title
                          ,'subtitle' => $subtitle
                          ,'depthname' => $depthname
                          ,'depthicon' => $depthicon
                          ,'created_by' => $request->created_by
                          ,'updated_by' => $request->updated_by]);

activity()->performedOn($root)->causedBy(Sentinel::getUser()->id)->withProperties(['new'=>$root,'old'=>$root])->log('Sampah '.$root->name.' is created successfully');

}
else if ($request->sampah <> "uncategories"){


  return 2;


//$root = Sampah::where('id', '=', $request->sampah)->first();

  $depthicon = "fa-list";

  $title = "Barang";
  $subtitle = "Kelola Data Barang";
  $depthname = "";


  $root = Sampah::where('id', '=', $request->sampah)->first();


$child1 =  $root->children()->create(['code' => $request->code
                          ,'name' => $request->name
                          ,'status' => $request->status
                          ,'note' => $request->note
                          ,'sell_price' => $request->sell_price
                          ,'buy_price' => $request->buy_price
                          ,'satuan' => $request->satuan
                          ,'title' => $title
                          ,'subtitle' => $subtitle
                          ,'depthname' => $depthname
                          ,'depthicon' => $depthicon
                          ,'created_by' => $request->created_by
                          ,'updated_by' => $request->updated_by]);
                        

}


      Session::flash('alert-success', 'Sampah '.$request->name.' is created successfully');

        return redirect('sampah');
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
         $node = Sampah::findOrFail($id);
         $nodes = Sampah::where('parent_id',$id)->get();

         $logs = Activity::where('subject_type', 'App\Sampah')->where('subject_id',$id)->get();
         //$logs = substr($l, 1,-1);
         //return (toArray($l));
         return view('backEnd.sampah.show', compact('nodes','node','logs'));
     }
     public function kategori()
     {
         
        
      $tables = Sampah::where('nesting',0)->get();
       
      $id= false;
        return view('backEnd.sampah.kategori', compact('tables','id'));
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
        $node = Sampah::findOrFail($id);
        $categories = Sampah::where('status',3)->get()->pluck('name','id');
        $activations = Status::where('parent_id','=','1')->get()->pluck('name','id');
        $satuans = Satuan::where('status','=',3)->orderby('id','desc')->get()->pluck('name','id');
        $types = Status::where('parent_id','=','16')->get()->pluck('name','id');
        return view('backEnd.sampah.edit', compact('node','categories','activations','satuans','types'));
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


        $attributes = Sampah::findOrFail($id);
    
        $sampah = Sampah::findOrFail($id);
        $sampah->update($request->all());

      
        Session::flash('alert-success', 'Sampah '.$sampah->name.' is updated successfully');

        if ($sampah->parent()->first()) {
          return redirect('sampah');
        }

        return redirect('sampah');
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
        $sampah = Sampah::findOrFail($id);

        $sampah->delete();

        $attributes = $sampah->getOriginal();

        activity()->performedOn($sampah)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Sampah '.$sampah->name.' is deleted successfully');

        Session::flash('alert-warning', 'Sampah '.$sampah->name.' is deleted successfully');

        return redirect('sampah');
    }

}
