<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> ['required','string'],
            'email'=> ['required','email', 'unique:users'],
            'password'=> ['required','min:6'],
        ]);
        if ($validator->fails()) {
            return redirect('/a')
                        ->withErrors($validator)
                        ->withInput();
        }

        // $data= $request->validated([
        //     'name'=> ['required','string'],
        //     'email'=> ['required','email', 'unique:users'],
        //     'password'=> ['required','min:6'],
        // ]);
        $data = $validator->validated();
        $user = User::create($data);        
        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect('/b')
        ->with([
            'user' => $user,
            'token' => $token
        ]);
    
    }
    public function login(Request $request)
    {

        // $data= $request->validation([
        //     'email'=> ['required','email', 'exists:users'],
        //     'password'=> ['required','min:6'],
        // ]);
        $validator = Validator::make($request->all(), [
            'name'=> ['required','string'],
            'email'=> ['required','email', 'unique:users'],
            'password'=> ['required','min:6'],
        ]);
        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $validator->validated();

        $user = User::where('email', $data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password)){
            return response([
                'message'=> 'bad creds'
            ],401);
        }        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return redirect('/b')
        ->with([
            'user' => $user,
            'token' => $token
        ]);
    
        return redirect('/posts')
        ->with([
            'user'=> $user,
            'token'=> $token
        ]);
        
    }
    public function logout(Request $request)
    {
    // Revoke the token that was used for authentication
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logged out successfully'
    ]);
    }
}