<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Pengobatan;
use App\Item;
use App\Lokasi;
use App\Satuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class PengobatanController extends Controller
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
      
        $pengobatan = DB::select(
            DB::raw("SELECT MAX(p.tgl_checkin) AS tgl_checkin
                            , MAX(p.populasi) AS populasi 
                            , MAX(l.name) AS kandang 
                            , COUNT(obat) AS qtyobat
                     FROM pengobatans p
                     JOIN lokasis l ON l.id = p.kandang
                    GROUP BY p.tgl_checkin"));

        return view('backEnd.pengobatan.index', compact('pengobatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $kandangs = Lokasi::where('depth',1)->pluck('name','id');
        $satuans = Satuan::get();
        $obats = Item::where('parent_id',2)->get();
        $datenow = date('Y-m-d'); 
        $daterange = date("m/d/Y")." - ". date("m/d/Y") ;
        return view('backEnd.pengobatan.create',compact('obats','daterange','datenow','kandangs','satuans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        
     // $model = Pengobatan::create($request->all());

        //input detail

      if(!empty($request->dosis)){
        for($i=0;$i<count($request->dosis);$i++){
             if($request->input('dosis')[$i]){

            DB::table('pengobatans')->insert(
                                    ['tgl_checkin'=> $request->tgl_checkin
                                    ,'kandang'=> $request->kandang
                                    ,'populasi'=> $request->populasi
                                    ,'tgl_pengobatan'=> $request->tgl_pengobatan[$i]
                                    ,'umur'=> $request->umur[$i]
                                    ,'obat'=> $request->obat[$i]
                                    ,'dosis'=> $request->dosis[$i]
                                    ,'satuan'=> $request->satuan[$i]
                                    ,'aplikasi'=> $request->aplikasi[$i]
                                    ,'created_by'=> $request->created_by
                                    ,'created_at'=> date('Y-m-d H:i:s')
                                    ]);  
            }
        }
        }


      Session::flash('alert-success', 'Pengobatan '.$request->tgl_checkin.' is created successfully');

        return redirect('pengobatan');
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
        $pengobatan = Pengobatan::findOrFail($id);

        return view('backEnd.pengobatan.show', compact('pengobatan'));
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
        $pengobatans = Pengobatan::where('tgl_checkin',$id)->get();
        $kandangs = Lokasi::where('depth',1)->pluck('name','id');
        $satuans = Satuan::get();
        $datenow = date('Y-m-d'); 
        $daterange = date("m/d/Y")." - ". date("m/d/Y") ;
        $obats = Item::where('parent_id',2)->get();

        return view('backEnd.pengobatan.edit', compact('pengobatans','obats','datenow','daterange','kandangs','satuans'));
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
     DB::table('pengobatans')->where('tgl_checkin', $request->tgl_checkin)->delete();

     if(!empty($request->dosis)){
        for($i=0;$i<count($request->dosis);$i++){
             if($request->input('dosis')[$i]){

            DB::table('pengobatans')->insert(
                                    ['tgl_checkin'=> $request->tgl_checkin
                                    ,'kandang'=> $request->kandang
                                    ,'populasi'=> $request->populasi
                                    ,'tgl_pengobatan'=> $request->tgl_pengobatan[$i]
                                    ,'umur'=> $request->umur[$i]
                                    ,'obat'=> $request->obat[$i]
                                    ,'dosis'=> $request->dosis[$i]
                                    ,'satuan'=> $request->satuan[$i]
                                    ,'aplikasi'=> $request->aplikasi[$i]
                                    ,'created_by'=> $request->created_by
                                    ,'created_at'=> date('Y-m-d H:i:s')
                                    ]);  
            }
        }
        }
        return redirect('pengobatan');
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
       

        DB::table('pengobatans')->where('tgl_checkin', $id)->delete();

    
        Session::flash('alert-warning', ' Pengobatan '.$id.' is deleted successfully');

        return redirect('pengobatan');
    }

}
