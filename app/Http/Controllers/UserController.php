<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {   
        return response()->json('Ini User API');
    }

    public function login(Request $request){

        $nickname = $request->nickname;
        $password = $request->password;

        $user = User::where('nickname', $nickname)
                ->where('password', $password)
                ->get();

        $data = array();

        if ($user->count() > 0) {
            $data = array("status" => 1, "message" => 'Login Success', "data" => $user);
        } else{
            $data = array("status" => 0, "message" => 'Username atau password salah');
        }

        return response()->json($data);
    }
}
