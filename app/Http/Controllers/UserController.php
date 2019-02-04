<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use App\RoleUser;
use App\Status;
use App\Log;
use App\Lokasi;
use Validator;
use Session;
use Auth;
use Route;
use Sentinel;
use Activation;
use DB;
use Hash;
use Mail;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;


class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    protected function validator(Request $request,$id='')
    {
        return Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:35|string',
            'email' => 'required|min:3|string',
            'password' => 'min:4|max:50|confirmed',
            'role' => 'required',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
      $level = Sentinel::getUser()->roles()->first()->level;

    
       
        $users= User::all();
        $roles= Role::all();
  
      
    

         $id= 0;

         //return $type;
        return View('backEnd.users.index', compact('users','roles','id'));
    }

    public function role(Request $request, $id){

                $type = $request->type;
                $level = Sentinel::getUser()->roles()->first()->level;
                $role= Role::findOrFail($id);
                $users =  $role->getUsers();

                $id = $id;

                $roles= Role::all();
            
                return View('backEnd.users.index', compact('users','roles','id'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

      
      $level = Sentinel::getUser()->roles()->first()->level;

    //  return $usb;
 
      if($level == "Head Office"){
        $roles = Role::orderBy('name','asc')->pluck('name', 'id');
      }else{
      $roles = Role::where('level',$level)->orderBy('name','asc')->pluck('name', 'id');
      }

        $statuses = Status::where('id',3)->get()->pluck('name', 'id');
        $units = Lokasi::where('type',14)->get()->pluck('name', 'id');
        //$sbus = $users_sbu;
        return View('backEnd.users.create',compact('roles','statuses','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      if ($this->validator($request,Sentinel::getUser()->id)->fails()) {

                return redirect()->back()
                        ->withErrors($this->validator($request))
                        ->withInput();
        }
         //create user

         //return $request->all();
         $user = Sentinel::register($request->all());
         //activate user
         $activation = Activation::create($user);
         $activation = Activation::complete($user, $activation->code);
         //add role
         $user->roles()->sync([$request->role]);

         if ($request->file) {
           $foto_asset = $request->file;
           $filename = $foto_asset->getClientOriginalName();
           $newFilename = $user->id.'.'.pathinfo($filename, PATHINFO_EXTENSION);
           $destinationPath = 'images/user/'.$user->id.'/';
           $rules = array('file' => 'required');
           $user->update(['url_image'=>$destinationPath.$newFilename]);
           $upload_success = $foto_asset->move($destinationPath, $newFilename);
        }


        Session::flash('alert-success', ' User '.$user->name.' is created successfully');


        return redirect()->route('user.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,$id)
    {


         $user = User::findOrFail($id);
         $type = $user->roles()->first();

         $logs = Log::where('subject_type', 'App\User')->get();
         $activities = Log::where('causer_id', $id)->get();


         $routes = Route::getRoutes();

         $actions = [];

        foreach ($routes as $route) {
             if ($route->getName() != "" && !substr_count($route->getName(), 'payment')) {
                 $actions[] = $route->getName();
             }
         }

                 //remove store option
                 $input = preg_quote("store", '~');
                 $var = preg_grep('~' . $input . '~', $actions);
                 $actions = array_values(array_diff($actions, $var));

                 //remove update option
                 $input = preg_quote("update", '~');
                 $var = preg_grep('~' . $input . '~', $actions);
                 $actions = array_values(array_diff($actions, $var));

                 $var = [];
                 $i = 0;
                 foreach ($actions as $action) {

                     $input = preg_quote(explode('.', $action )[0].".", '~');
                     $var[$i] = preg_grep('~' . $input . '~', $actions);
                     $actions = array_values(array_diff($actions, $var[$i]));
                     $i += 1;
                 }

                 $actions = array_filter($var);

         if ($request->is('api/*')) {
            $user= User::where('id',$id)->with('activations','roles')->get();
            return response()->json(compact('user'));
        }
        return View('backEnd.users.show', compact('user','type','logs','actions','activities'));
    }

    public function accountFrontEnd(Request $request,$id)
    {
        $user=Sentinel::getUser();
         if ($user->inRole('admin')) {
           $user = User::findOrFail($id);
           return view('frontend.userAcount',compact('user'));
         }

        return view('frontend.userAcount',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      
      $level = Sentinel::getUser()->roles()->first()->level;
    
      

      if($level == "Head Office"){
        $roles = Role::orderBy('name','asc')->pluck('name', 'id');
      }else{
      $roles = Role::where('level',$level)->orderBy('name','asc')->pluck('name', 'id');
      }
        $user = User::find($id);
        
        $statuses = Status::where('parent_id',1)->get()->pluck('name', 'id');
        $units = Lokasi::where('type',14)->get()->pluck('name', 'id');

        return View('backEnd.users.edit', compact('user', 'roles','statuses','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $update_user = Validator::make($request->all(), [
            'first_name' => 'min:2|max:35|string',
            'email' => 'required|min:3|string',
            'password' => 'confirmed',
            'role' => 'required',
              ]);

        if ($update_user->fails()) {
            return redirect()->back()
                        ->withErrors($update_user)
                        ->withInput();
        }

        $user = User::find($id);

        if ($user) {

              if($request->first_name){
              $user->first_name=$request->first_name;
              }
              if($request->last_name){
              $user->last_name=$request->last_name;
              }
              if($request->email){
              $user->email=$request->email;
              }

              $user->unit_id = $request->unit_id;
              
              if($request->mobile_id){

              $user->mobile_id = $request->mobile_id;
              }

              if($request->status){
              $user->status=$request->status;
              }


              if($request->new_password && $request->new_password_confirmation ){
                if ($request->new_password == $request->new_password_confirmation ){
                     $user->password=bcrypt($request->new_password);
                 }else{
                   Session::flash('message', 'Your old password is incorrect.');
                   Session::flash('status', 'error');
                  return redirect()->back()->withErrors(['old_password', 'your old password is incorrect']);
                 }
              }
           
               $user->update();
               if($request->status == 2){
                 //trigger inactive, copot activation code nya
                 $user = Sentinel::findById($id);
                 Activation::remove($user);

               }
               if($request->status == 3){
                 $user = Sentinel::findById($id);
                 $act = Activation::completed($user);

                 if(empty($act)){
                 $activation = Activation::create($user);
                 $activation = Activation::complete($user, $activation->code);
                 }
               }
            if ($request->role) {
              $user->roles()->sync([$request->role]);
            }
            if ($request->file) {
              if (file_exists($user->url_image)) {
                unlink($user->url_image);
              }
              $image = $request->file;
              $filename = $image->getClientOriginalName();
              $newFilename = $user->id.'.'.pathinfo($filename, PATHINFO_EXTENSION);
              $destinationPath = 'images/user/'.$user->id.'/';
              $rules = array('file' => 'required');
              $user->update(['url_image'=>$destinationPath.$newFilename]);
              $upload_success = $image->move($destinationPath, $newFilename);
           }

           $attributes = $user->getOriginal();

           activity()->performedOn($user)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('User '.$user->first_name.' '.$user->last_name.' is updated successfully');

           Session::flash('alert-success', ' User '.$user->name.' is updated successfully');


        }


      return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Session::flash('message', 'Success! User is deleted successfully.');
        Session::flash('status', 'success');

        return redirect()->route('user.index');
    }

    public function permissions($id)
    {
        $user = Sentinel::findById($id);
        $routes = Route::getRoutes();


        //Api Route
        // $api = app('api.router');
        // /** @var $api \Dingo\Api\Routing\Router */
        // $routeCollector = $api->getRoutes(config('api.version'));
        // /** @var $routeCollector \FastRoute\RouteCollector */
        // $api_route = $routeCollector->getRoutes();


        $actions = [];
        foreach ($routes as $route) {
            if ($route->getName() != "" && !substr_count($route->getName(), 'payment')) {
                $actions[] = $route->getName();
            }
        }

        //remove store option
        $input = preg_quote("store", '~');
        $var = preg_grep('~' . $input . '~', $actions);
        $actions = array_values(array_diff($actions, $var));

        //remove update option
        $input = preg_quote("update", '~');
        $var = preg_grep('~' . $input . '~', $actions);
        $actions = array_values(array_diff($actions, $var));

        //Api all names
        // foreach ($api_route as $route) {
        //     if ($route->getName() != "" && !substr_count($route->getName(), 'payment')) {
        //         $actions[] = $route->getName();
        //     }
        // }

        $var = [];
        $i = 0;
        foreach ($actions as $action) {

            $input = preg_quote(explode('.', $action )[0].".", '~');
            $var[$i] = preg_grep('~' . $input . '~', $actions);
            $actions = array_values(array_diff($actions, $var[$i]));
            $i += 1;
        }

        $actions = array_filter($var);
        // dd (array_filter($actions));

        return View('backEnd.users.permissions', compact('user', 'actions'));
    }

    public function save($id, Request $request)
    {
        //return $request->permissions;
        $user = Sentinel::findById($id);
        $user->permissions = [];
        if($request->permissions){
            foreach ($request->permissions as $permission) {
                if(explode('.', $permission)[1] == 'create'){
                    $user->addPermission($permission);
                    $user->addPermission(explode('.', $permission)[0].".store");
                }
                else if(explode('.', $permission)[1] == 'edit'){
                    $user->addPermission($permission);
                    $user->addPermission(explode('.', $permission)[0].".update");
                }
                else{
                    $user->addPermission($permission);
                }
            }
        }

        $user->save();

        activity()->performedOn($user)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('User '.$user->first_name.' '.$user->last_name.' is updated successfully');

        Session::flash('alert-success', ' Permission '.$user->name.' is updated successfully');


        return redirect()->route('user.index');
    }

    public function activate(Request $request,$id)
    {
        $user = Sentinel::findById($id);

        $activation = Activation::completed($user);

        if($activation){
            Session::flash('message', 'Warning! The user is already activated.');
            Session::flash('status', 'warning');

            return redirect('user');
        }
        $activation = Activation::create($user);
        $activation = Activation::complete($user, $activation->code);

        Session::flash('message', 'Success! The user is activated successfully.');
        Session::flash('status', 'success');

        $role = $user->roles()->first()->name;

        return redirect()->route('user.index');
    }

    public function deactivate(Request $request,$id){

        $user = Sentinel::findById($id);
        Activation::remove($user);

        Session::flash('message', 'Success! The user is deactivated successfully.');
        Session::flash('status', 'success');

        return redirect()->route('user.index');
    }
    public function ajax_all(Request $request){
        if ($request->action=='delete') {
           foreach ($request->all_id as $id) {
             $user = User::findOrFail($id);
             if ($user->deleted_at == null){$user->delete();}
            }
            Session::flash('message', 'Success! Users are deleted successfully.');
            Session::flash('status', 'success');
            return response()->json(['success' => true, 'status' => 'Sucesfully Deleted']);
        }
        if ($request->action=='deactivate') {
           foreach ($request->all_id as $id) {
             $user = User::findOrFail($id);
             $activation = Activation::completed($user);
             if ($activation){Activation::remove($user);}
            }
            Session::flash('message', 'Success! Users are deactivate successfully.');
            Session::flash('status', 'success');
            return response()->json(['success' => true, 'status' => 'Sucesfully deactivate']);
        }
        if ($request->action=='activate') {
           foreach ($request->all_id as $id) {
             $user = User::findOrFail($id);
             $activation = Activation::completed($user);
             if ($activation==''){
                $activation = Activation::create($user);
                $activation = Activation::complete($user, $activation->code);
                }
            }
            Session::flash('message', 'Success! Users are Activated successfully.');
            Session::flash('status', 'success');
            return response()->json(['success' => true, 'status' => 'Sucesfully Activated']);
        }
    }





}
