<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
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

class ItemController extends Controller
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
        ,'code' => 'required|unique:items'
      ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function index()
     {
        $filters = Item::where('nesting',0)->get();
        $table = Item::where('nesting',1)->get();
          if(empty($table)){
              $tables = Item::where('nesting',0)->get();
            }else{$tables = Item::where('nesting',1)->get();}
       $id= false;
        return view('backEnd.item.index', compact('tables','filters','id'));
     }

     public function filter($id)
     {
       $filters = Item::where('nesting',0)->get();
       $tables = Item::where('nesting',1)->where('parent_id',$id)->get();

          $id = $id;
           return view('backEnd.item.index', compact('tables','filters','id'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Item::all();
        $activations = Status::where('parent_id','=','1')->orderby('id','desc')->get()->pluck('name','id');
        $satuans = Satuan::where('status','=',3)->get()->pluck('name','id');
        $types = Status::where('parent_id','=','16')->get()->pluck('name','id');
        $level = 0;
        $id = "";
        $datenow = date("Y-m-d");
        return view('backEnd.item.create',compact('categories','activations','level','id','satuans','types','datenow'));
    }
    public function creates($id)
    {
        $id = $id;
        $item = Item::where('status',3)->where('id','=',$id)->first();
        $categories = Item::where('status',3)->get();
        $activations = Status::where('parent_id','=','1')->orderby('id','desc')->get()->pluck('name','id');
        $satuans = Satuan::where('status','=',3)->get()->pluck('name','id');
        $types = Status::where('parent_id','=','16')->get()->pluck('name','id');
        $level = 0;
        if ($id==0) {
          $item = Item::where('status',3)->where('nesting','=',1)->get();
        }
        $datenow = date("Y-m-d");
        return view('backEnd.item.create',compact('item','activations','categories','level','id','satuans','types','datenow'));
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



if ($request->item == "uncategories")
{

  $title = "Kategori";
  $subtitle = "Kelola Kategori Barang";
  $depthname = "Sub Kategori";
  $depthicon = "fa-list";

$root = Item::create(['code' => $request->code
                          ,'name' => $request->name
                          ,'status' => $request->status
                          ,'note' => $request->note
                          ,'title' => $title
                          ,'subtitle' => $subtitle
                          ,'depthname' => $depthname
                          ,'depthicon' => $depthicon
                          ,'created_by' => $request->created_by
                          ,'updated_by' => $request->updated_by]);

activity()->performedOn($root)->causedBy(Sentinel::getUser()->id)->withProperties(['new'=>$root,'old'=>$root])->log('Item '.$root->name.' is created successfully');


Session::flash('alert-success', 'Kategori '.$request->name.' is created successfully');

return redirect('kategori');


}
else if ($request->item <> "uncategories"){



  $depthicon = "fa-list";

  $title = "Barang";
  $subtitle = "Kelola Data Barang";
  $depthname = "";


  $root = Item::where('id', '=', $request->item)->first();


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
                          ,'expire_date' => $request->expire_date
                          ,'created_by' => $request->created_by
                          ,'updated_by' => $request->updated_by]);

                          if ($request->thumbnail) {
                            $image = $request->thumbnail;
                            $filename = $image->getClientOriginalName();
                            $newFilename = $child1->id.'.'.pathinfo($filename, PATHINFO_EXTENSION);
                            $destinationPath = 'images/items/'.$child1->id.'/';
                            $child1->update(['thumbnail'=>$destinationPath.$newFilename]);
                            $upload_success = $image->move($destinationPath, $newFilename);
                        }
  
    Session::flash('alert-success', 'Item '.$request->name.' is created successfully');

    return redirect('item');
                        

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
         $node = Item::findOrFail($id);
         $nodes = Item::where('parent_id',$id)->get();

         $logs = Activity::where('subject_type', 'App\Item')->where('subject_id',$id)->get();
         //$logs = substr($l, 1,-1);
         //return (toArray($l));
         return view('backEnd.item.show', compact('nodes','node','logs'));
     }
     public function kategori()
     {
         
        
      $tables = Item::where('nesting',0)->get();
       
      $id= false;
        return view('backEnd.item.kategori', compact('tables','id'));
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
        $node = Item::findOrFail($id);
        $categories = Item::where('status',3)->get()->pluck('name','id');
        $activations = Status::where('parent_id','=','1')->get()->pluck('name','id');
        $satuans = Satuan::where('status','=',3)->orderby('id','desc')->get()->pluck('name','id');
        $types = Status::where('parent_id','=','16')->get()->pluck('name','id');
        $datenow = date("Y-m-d");
        return view('backEnd.item.edit', compact('node','categories','activations','satuans','types','datenow'));
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


        $attributes = Item::findOrFail($id);
    
        $item = Item::findOrFail($id);
        $item->update($request->all());

        if ($request->thumbnail) {
          $image = $request->thumbnail;
          $filename = $image->getClientOriginalName();
          $newFilename = $item->id.'.'.pathinfo($filename, PATHINFO_EXTENSION);
          $destinationPath = 'images/items/'.$item->id.'/';
          $item->update(['thumbnail'=>$destinationPath.$newFilename]);
          $upload_success = $image->move($destinationPath, $newFilename);
      }

      
        Session::flash('alert-success', 'Item '.$item->name.' is updated successfully');

        if ($item->parent()->first()) {
          return redirect('item');
        }

        return redirect('item');
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
        $item = Item::findOrFail($id);

        $item->delete();

        $attributes = $item->getOriginal();

        activity()->performedOn($item)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Sampah '.$item->name.' is deleted successfully');

        Session::flash('alert-warning', 'Item '.$item->name.' is deleted successfully');

        return redirect('item');
    }

}
