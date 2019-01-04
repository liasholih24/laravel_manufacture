<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Log;
use App\RoleUser;
use App\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activation;
use Route;
use Activity;
use DB;
// use
class RoleController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
      protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'slug' => 'required|max:35|min:2|string',
            'name' => 'required|max:35|min:2|string',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();

        if ($request->is('api/*')) {
               return $roles;
         }
         //return $roles;
         return View('backEnd.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $roles = Role::get()->pluck('name', 'id');

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
        return View('backEnd.roles.create',compact('roles','actions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request){

//return $request->name;

/*
       if ($this->validator($request)->fails()) {
            return redirect()->back()
                        ->withErrors($this->validator($request))
                        ->withInput();
        }
*/

       $slug = str_replace(" ","-",$request->name);

      $role = Role::create(['name' => $request->name
                                ,'slug' => $slug
                                ,'desc' => $request->desc
                                ,'status' => $request->status
                                ,'level' => $request->level
                                ,'created_by' => $request->created_by
                                ,'updated_by' => $request->updated_by]);


      //update RoleUser
      $rolep = Sentinel::findRoleById($role->id);
      $role->permissions = [];

      if($request->permissions){
          foreach ($request->permissions as $permission) {
              if(explode('.', $permission)[1] == 'create'){
                  $rolep->addPermission($permission);
                  $rolep->addPermission(explode('.', $permission)[0].".store");
              }
              else if(explode('.', $permission)[1] == 'edit'){
                  $rolep->addPermission($permission);
                  $rolep->addPermission(explode('.', $permission)[0].".update");
              }
              else{
                  $rolep->addPermission($permission);
              }
          }
      }

      $rolep->save();



      $attributes = $role->getOriginal();

      activity()->performedOn($role)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Role '.$role->name.' is created successfully');

      Session::flash('alert-success', 'Role '.$role->name.' is created successfully');

        return redirect('role');

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
        $role = Role::findOrFail($id);
        $roles = Role::where('id',$id)->get();

        $routes = Route::getRoutes();

        $logs = Log::where('subject_type', 'App\Role')->get();

        $users = RoleUser::where('role_id', $id)->get();

        $test = $role->permissions;
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


    return View('backEnd.roles.show', compact('role','roles','actions','logs','users'));
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

        $role = Role::findOrFail($id);
      return View('backEnd.roles.edit', compact('role'));
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

        $role = Role::findOrFail($id);
        $role->update($request->all());

        if($request->status == 0){
          $users = DB::select(
                    DB::raw("SELECT id FROM users u JOIN role_users r ON u.id = r.user_id
                        WHERE role_id = $id "));

          foreach($users as $user){

           DB::table('users')->where('id', $user->id)->update(['status' => 2]);

           //remove activation code
           $usr = Sentinel::findById($user->id);
           Activation::remove($usr);

          }
        }
        $attributes = $role->getOriginal();

        activity()->performedOn($role)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Role '.$role->name.' is updated successfully');

        Session::flash('alert-success', ' Role '.$role->name.' is updated successfully');

        return redirect('role');
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
        $role = Role::findOrFail($id);

        $role->delete();
        $attributes = $role->getOriginal();
        activity()->performedOn($role)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Role '.$role->name.' is deleted successfully');

      Session::flash('alert-warning', ' Role '.$role->name.'  is deleted successfully');

        return redirect('role');
    }

    public function permissions($id, $module){

      $modules = $module;


        $role = Role::findOrFail($id);

        $routes = Route::getRoutes();

        $actions = [];
        foreach ($routes as $route) {
            if ($route->getName() != "" && !substr_count($route->getName(), 'payment')) {
               $actions[] = $route->getName();
               $route->getName();
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
        // dd (array_filter($actions));
      return View('backEnd.roles.permissions', compact('role', 'actions','permissions','modules'));
    }

    public function save($id, Request $request){



        $role = Sentinel::findRoleById($id);
        $role->permissions = [];
        if($request->permissions){
            foreach ($request->permissions as $permission) {



              if(explode('.', $permission)[1] == 'create'){
                  $role->addPermission($permission);
                  $role->addPermission(explode('.', $permission)[0].".store");
              }
              else if(explode('.', $permission)[1] == 'edit'){
                  $role->addPermission($permission);
                  $role->addPermission(explode('.', $permission)[0].".update");
              }
              else{
                  $role->addPermission($permission);
              }
            }
        }

        $role->save();

        $attributes = $role->getOriginal();

        activity()->performedOn($role)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Permissions is updated successfully');

        Session::flash('alert-success', 'Permissions '.$role->name.' is updated successfully');
        return redirect('role/'.$id.'/show');
    }


}
