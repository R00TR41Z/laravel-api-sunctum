<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Alerts\SendMail;
use App\Models\UserWallet;

class SystemController extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            "email"=>"required",
            "password"=>"required"
        ]);

        if(Auth::attempt(['email'=>$req->email,"password"=>$req->password])){
            return response()->json([
                "token"=>Auth::user()->createToken("dpayToken")->plainTextToken
            ]);
        }
        return response()->json([
            "email or password is wrong!!!!"
        ]);
    }

    public function user(Request $req)
    {
        $user = Auth::user()->toArray();
        $salt = Auth::user()->salt->toArray();
        $user = array_merge($user,$salt);

        return response()->json([
            $user
        ]);    
    }

    public function addCredit(Request $req)
    {
        $req->validate([
            'salt'=>"int"
        ]);

        UserWallet::create([
            'user_id'=>$req->user()->id,
            'salt'=>$req->salt
        ]);

        return response()->json([
            'Credit add successfully!'
        ]);
    }

    public function sendMail(Request $req)
    {
        $mail = new SendMail(Auth::user());
        if($mail->now()){
            return response()->json([
                'Email sent !!!'
            ]);
        }
    }
    
    public function register(Request $req)
    {
        $req->validate([
            "email"=>"required|email|unique:users",
            "name"=>"required",
            "password"=>"required"
        ]);
        
        User::create([
            "email"=>$req->email,
            "name"=>$req->name,
            "password"=>bcrypt($req->password)
        ]);
        
        if(Auth::attempt(["email"=>$req->email,"password"=>$req->password])){
            return response()->json([
                "token"=>Auth::user()->createToken("dpayToken")->plainTextToken
            ]);
        }
    }
}
