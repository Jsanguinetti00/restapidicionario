<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request){
        // $rules =[
        //     'firstname'=> 'required | string',
        //     'lastname'=> 'required | string',
        //     'username'=> 'required | unique:users',
        //     'email'=> 'required | string | email | unique:users',
        //     'password'=> 'required',
        //     'cpassword' => 'required | same:password'
        // ];
        // $this->validate($request, $rules);
        $password = Hash::make($request->password);
        $user = User::create([
            'firstname'=> $request->firstname,
            'lastname'=> $request->lastname,
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> $password,
        ]);

        return $user;
    }
    public function login(Request $request){
        $rules = [
            'email'=>'required',
            'password'=> 'required'
        ];
        $this->validate($request, $rules);
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        // $tokenResult = $user->createToken('Personal Access Token');
        // $token = $tokenResult->token;
        // if ($request->remember_me)
        //     $token->expires_at = Carbon::now()->addWeeks(1);
        // $token->save();
        // $user['access_token'] = $tokenResult->accessToken;
        // $user['token_type'] = 'Bearer';
        // $user['token_expired'] = Carbon::parse(
        //     $tokenResult->token->expires_at
        // )->toDateTimeString();

        return response()->json($user);
    }
    
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message'=> 'Successfully logged out'
        ]);
    }
    public function user (Request $request){
        return response()->json($request->user());
    }
}
