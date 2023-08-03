<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {

        $data = $request->validate([
            'ime' => '',
            'prezime' => '',
            'email' => '',
            'password' => '',
            'confPassword' => ''
        ]);

        $existMail = User::where('email', $data['email'])->first();

        if ($existMail) {
            return response()->json(['existMail' => 'Postoji korisnik s tim emailom'], 422);
        }

        $data['password'] = Hash::make($data['password']);
        $data['confPassword'] = Hash::make($data['confPassword']);

        $user = new User();
        $user->create($data);

        return response()->json(['poruka' => 'Uspjesna registracija']);
    }

    public function loginUser(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email je obavezan',
                'password.required' => 'Lozinka je obavezna'
            ]
        );

        if (Auth::attempt($data)) {
            // Korisnik se uspješno prijavio
            $user = Auth::user();
            return response()->json(['poruka' => 'Uspješna prijava', 'user' => $user]);
        } else {
            // Prijavljivanje nije uspjelo
            return response()->json(['poruka' => 'Neuspješna prijava']);
        }
    }

    public function isLogged()
    {

        $user = Auth::user();
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(null);
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        return response()->json(['redirect' => '/login']);
    }
}
