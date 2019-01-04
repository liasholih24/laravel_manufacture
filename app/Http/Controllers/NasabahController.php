<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use App\Tabungan;
use App\Nasabah;
use App\Status;
use App\User;
use App\Role;
use App\RoleUser;
use Activation;
use Hash;
use Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class NasabahController extends Controller
{

protected function validator(Request $request)
{
/*dicustom*/
  return Validator::make($request->all(), [
     'nama_depan' => 'required|min:2|string',
     'jenis_nasabah' => 'required',
     'group_code' => 'required',
  ]);
}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $nasabah = Nasabah::all();

        return view('backEnd.nasabah.index', compact('nasabah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $groups = Status::where('parent_id',20)->where('status',3)->get();
       
        return view('backEnd.nasabah.create',compact('groups'));
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

        
      $nasabah = Nasabah::create($request->all());

  

      activity()->performedOn($nasabah)->causedBy(Sentinel::getUser()->id)->log('Nasabah '.$nasabah->nama_depan.''.$nasabah->nama_belakang.' is created successfully');

      Session::flash('alert-success', 'Nasabah '.$nasabah->nama_depan.''.$nasabah->nama_belakang.' is created successfully');

        return redirect('nasabah');
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
        $nasabah = Nasabah::findOrFail($id);
        $riwayats = Tabungan::where('norek',$nasabah->norek)->get();

        return view('backEnd.nasabah.show', compact('nasabah','riwayats'));
    }

    public function print($id)
    
    {
        $offset = Input::get('offset');

        $nasabah = Nasabah::findOrFail($id);
        $riwayats = Tabungan::where('norek',$nasabah->norek)->orderby('id','asc')->paginate(25);
        $counts = Tabungan::where('norek',$nasabah->norek)->where('print_code',null)->orderby('id','asc')->limit(25)->offset($offset)->get();

        $print_code =  DB::select(
                  DB::raw("select print_code from tabungans where norek = '$nasabah->norek' and print_code is not null order BY created_at desc limit 1"));
        if(!empty($print_code)){
        	$p0 = $print_code[0]->print_code - 25 ;
          $p = $print_code[0]->print_code - $p0;
          $i = $print_code[0]->print_code;

        }else{ $p= 0; $i=0;}


        foreach ($counts as $count) {
          $i++;
         DB::table('tabungans')->where('id',$count->id)->where('print_code', null)
              ->update(['print_code' => $i]);
       
        }


        return view('backEnd.nasabah.print', compact('nasabah','riwayats','p'));
    }

    public function prints(Request $request)
    {
        
      $page =  ceil(($request->baris) / 25);
     

      return redirect('nasabah/'.$request->id.'/print?page='.$page.'');

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
        $nasabah = Nasabah::findOrFail($id);
        $groups = Status::where('parent_id',20)->where('status',3)->get();
        $activations = Status::where('parent_id','=','1')->get()->pluck('name','id');

        return view('backEnd.nasabah.edit', compact('nasabah','groups','activations'));
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


        if(!empty($request->email))
        {

         $nasabah = Sentinel::register($request->all());
         //activate user
         $activation = Activation::create($nasabah);
         $activation = Activation::complete($nasabah, $activation->code);
         //add role
         $nasabah->roles()->sync([$request->role]);

         DB::table('nasabahs')->where('id',$id)->update(['login_id' => $nasabah->id]);

         Session::flash('alert-info', 'Mobile ID  Nasabah '.$nasabah->first_name.' '.$nasabah->last_name.' is updated successfully');

        }else{

        $nasabah = Nasabah::findOrFail($id);
        $nasabah->update($request->all());

        Session::flash('alert-success', ' Nasabah '.$nasabah->nama_depan.' '.$nasabah->nama_belakang.' is updated successfully');
        }


        

        return redirect('nasabah/'.$id.'');
    }

 

    public function getnorek(){

      $group_id = Input::get('group_id');


        $norek = DB::select(
                  DB::raw("SELECT CONCAT(MAX(group_code),'.',LPAD(COUNT(id)+1,3,'0')) as norek , MAX(group_code) from nasabahs where group_code = ".$group_id.""));
      $availables = '';
      if(!empty($norek)){
      foreach($norek as $item){
                $av = ''.(empty($item->norek)? $group_id.".001" :$item->norek).'';
                              $availables .= $av;
                              }
      $available = $availables;
                    }

      else{
          $available ='No data available';
        }

      return $available;
           }

    public function ceksaldo() // Tanpa (Request $request, $id)
        {
            $norek = Input::get('norek');

            $saldo = DB::select(
                      DB::raw("SELECT t.norek
                                     ,t.debit
                                     ,t.kredit
                                     ,t.saldo
                            FROM tabungans t
                            WHERE t.norek = '$norek' ORDER BY t.created_at desc LIMIT 1"));

      

      return json_encode($saldo);
        }

    public function datanasabah() // Tanpa (Request $request, $id)
        {
            $norek = Input::get('norek');

            $nasabah = DB::select(
                      DB::raw("SELECT a.norek as norek
                             ,a.nama_depan as nama_depan
                             ,a.nama_belakang as nama_belakang
                             ,CONCAT(a.group_code,'-',s.name) as kelompok_anggota
                             ,a.jenis_nasabah as jenis_nasabah
                             ,CONCAT(a.tgl_lahir,'-',a.no_identitas) AS identitas
                             ,l.name as unit_kerja
                             ,CASE WHEN a.pekerjaan is null
                                  THEN 'Tidak ada data'
                                  ELSE a.pekerjaan
                              END as pekerjaan
                              ,CASE WHEN a.organisasi is null
                                  THEN 'Tidak ada data'
                                  ELSE a.organisasi
                              END as organisasi
                             ,CASE WHEN a.pic is null
                                  THEN 'Tidak ada data'
                                  ELSE a.pic
                              END as pic
                             ,CASE WHEN a.no_telp is null
                                  THEN 'Tidak ada data'
                                  ELSE a.no_telp
                              END as no_telp
                             ,CASE WHEN a.alamat is null
                                  THEN 'Tidak ada data'
                                  ELSE a.alamat
                              END as alamat
                             ,CASE WHEN a.keterangan is null
                                  THEN 'Tidak ada keterangan'
                                  ELSE a.keterangan
                              END as keterangan
                              ,SUM(t.kredit) - SUM(t.debit) as saldo
                              ,SUM(t.saldo_sampah) as saldo_sampah
                              ,MAX(t.created_at) as created_at
                            FROM nasabahs a
                            LEFT JOIN statuses s ON a.group_code = s.code
                            LEFT JOIN tabungans t ON a.norek = t.norek AND t.norek = '$norek'
                            LEFT JOIN lokasis l ON a.unit_kerja = l.id
                            WHERE a.norek = '$norek' GROUP BY t.norek, a.norek, a.nama_depan,a.nama_belakang,
                                  a.group_code, s.name, a.jenis_nasabah, a.tgl_lahir, a.no_identitas, 
                                  l.name, a.pekerjaan, a.organisasi, a.pic, a.alamat, a.keterangan,a.no_telp"))[0];

      return json_encode( $nasabah );
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
        $nasabah = Nasabah::findOrFail($id);

        $nasabah->delete();

        $attributes = $nasabah->getOriginal();

        activity()->performedOn($nasabah)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Nasabah '.$nasabah->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Nasabah '.$nasabah->name.' is deleted successfully');

        return redirect('nasabah');
    }

  

}
