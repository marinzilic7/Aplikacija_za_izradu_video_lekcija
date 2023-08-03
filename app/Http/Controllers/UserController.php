<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerUser(Request $request){

        $data = $request -> validate( [
            'ime' => '',
            'prezime' => '',
            'email' => '',
            'password' => '',
            'confPassword' => ''
        ]);



        $data['password'] = Hash::make($data['password']);
        $data['confPassword'] = Hash::make($data['confPassword']);
        $user = new User();
        $user-> create($data);

        return response()->json(['poruka' => 'Uspjesna registracija']);

    }
}
