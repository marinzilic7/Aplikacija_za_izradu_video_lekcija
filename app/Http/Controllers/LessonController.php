<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function dodajVideo(Request $request)
    {
        $data = $request->validate([
            'naslov' => 'required',
            'opis' => 'required',
            'video' => 'required',
            'course_id' => 'required',

        ], [
            'naslov.required' => 'Obavezno',
            'opis.required' => 'Obavezno',
            'video.required' => 'Obavezno',
            'course_id.required' => 'Obavezno',
        ]);

        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $extension = $videoFile->getClientOriginalExtension();
            $video_name = time() . '1.' . $extension;
            $videoFile->move(public_path('videos'), $video_name);
            $data['video'] = $video_name;
        }

        $data['user_id'] = auth()->id();
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('lessons')->insert($data);

        return response()->json(['video' => 'Video lekcija uspješno dodana!']);
    }

    public function getLekcije()
    {
        $lekcije = Lesson::with('user','category')->get();

        return response()->json($lekcije);
    }

    public function deleteLesson($id)
    {
        $lesson = Lesson::findorFail($id);
        $lesson->delete();
        return response()->json(['poruka' => 'Uspjeno izbrisan kolegij']);
    }

    public function updateLesson(Request $request, $id){

        $lekcija = Lesson::findOrFail($id);
        $data = $request->validate([
            'naslov' => 'required|string',
            'opis' => 'required|string',

        ]);

        $lekcija->naslov=$data['naslov'];
        $lekcija->opis=$data['opis'];
        $lekcija->save();
        return response()->json([
            'poruka' => 'Anketa uspjesno uređena',
            'lekcija' => $lekcija,
        ]);
    }
}
