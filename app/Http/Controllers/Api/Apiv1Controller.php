<?php
namespace App\Http\Controllers\Api;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Nasabah;
use App\Post;
use App\Tabungan;
use Activity;
use Sentinel;
use Hash;

class Apiv1Controller extends Controller
{
    public function __construct()
    {
        // $this->middleware('jwt.auth', ['except'=>['getPosts']]);
    }
    public function whoami($id)
    {
        $user=User::where('email', $id)->first();
        if (!$user) {
            return response()->json(['error' => 'user_not_found'], 401);
        }
        $nasabah=Nasabah::where('login_id', $user->id)->first();
        $user=['id'=>$user->id,
               'nasabah_id'=>$nasabah?$nasabah->id:"",
               'name'=>$user->first_name.' '.$user->last_name,
               'norek'=>$nasabah?$nasabah->norek:"",
               'jenis_nasabah'=>$nasabah?$nasabah->jenis_nasabah:""];

        return response()->json($user);
    }
    public function getPosts()
    {
        $posts = Post::select('id', 'title', 'header', 'thumbnail', 'date_posted', 'author')
          ->with(['getAuthor'=>function ($query) {
              $query->select('id', 'first_name', 'last_name');
          }])
          ->orderBy('date_posted', 'desc')
          ->take(5)
          ->get();

        return response()->json($posts);
    }
    public function getPost($id)
    {
        $post = Post::select('id', 'title', 'content', 'thumbnail', 'date_posted', 'author')->where('id', $id)->first();
        $post->author= $post->getAuthor->first_name.' '.$post->getAuthor->last_name;

        return response()->json($post);
    }
    public function getSaldo($id)
    {
        $saldos = Tabungan::select('id', 'nasabah_id', 'saldo', 'saldo_sampah')->where('nasabah_id', $id)->orderBy('id', 'desc')->first();
        return response()->json($saldos);
    }
    public function getHistoryTransaksi($id, Request $request)
    {
        $saldos = Tabungan::select('id', 'trx_code', 'nasabah_id', 'code', 'debit', 'kredit', 'created_at')->where('nasabah_id', $id)->orderBy('id', 'desc');
        if ($request->timeFilter) {
            $mY=explode('-', $request->timeFilter);
            $m=$mY[1];
            $Y=$mY[0];
            $saldos->whereMonth('created_at', $m)->whereYear('created_at', $Y);
        }
        if ($request->typeFilter) {
            $saldos->where('code', $request->typeFilter);
        }
        $saldos=$saldos->get();
        return response()->json($saldos);
    }
    public function changePassword(Request $request)
    {
        $request->all();
        $hasher = Sentinel::getHasher();

        $oldPassword = $request->oldPassword;
        $password = $request->newPassword;

        $user = Sentinel::findById($request->user_id);

        if (!$hasher->check($oldPassword, $user->password)) {
            return response()->json(['error' => 'password_doesnt_match'], 400);
        }

        Sentinel::update($user, array('password' => $password));
        return response()->json('success');
    }
}
