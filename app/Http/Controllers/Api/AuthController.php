<?php

namespace App\Http\Controllers\Api;

use DB;
use Validator;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $validations = User::where('email', $request->email)->first();
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if($validations){
              if($validations->status==2){
                return response()->json(['error' => 'invalid_active_users'], 401);
              }
              else{
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
              }
            }
            else{
              return response()->json(['error' => 'invalid_validations'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
        return response()->json(compact('token'));
    }


    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);

        JWTAuth::invalidate($request->input('token'));
    }
}
