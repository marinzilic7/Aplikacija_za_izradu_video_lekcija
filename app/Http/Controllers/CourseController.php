<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function dodajKolegij(Request $request){

        $data = $request->validate([
            'naziv' => '',
            'opis' => ''
        ]);

        $kolegij = new Course();
        $kolegij -> create($data);
        return response()->json(['poruka' => 'Kolegij dodan!']);
    }

    public function getKolegij(){

        $kolegij = Course::get();


        return response()->json($kolegij);
    }
}
