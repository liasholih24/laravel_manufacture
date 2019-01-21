<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Route;

      
class HomeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function home($value='')
    {
    	return view('welcome');
    }
    
    public function dashboard()
   {

      return view('backEnd.dashboard');
    }
   
    }

