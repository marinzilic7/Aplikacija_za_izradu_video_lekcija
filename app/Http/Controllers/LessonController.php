<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function dodajVideo(Request $request)
    {

        $data = $request->validate([
            'naslov' => 'required',
            'opis' => 'required',
            'video' => 'required',
            'course_id' => 'required'

        ],[
            'naslov.required' => 'Obavezno',
            'opis.required' => 'Obavezno',
            'video.required' => 'Obavezno',
            'course_id.required' => 'Obavezno',
        ]);

        $video = new Lesson();

        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $extension = $videoFile->getClientOriginalExtension(); // Dobivanje originalne ekstenzije slike
            $video_name = time() . '1.' . $extension; // Generiranje imena slike s ispravnom ekstenzijom
            $videoFile->move(public_path('videos'), $video_name);
            $data['video'] = $video_name;
        }

        $data['user_id'] = auth()->id();
        $video->create($data);
        $video->save();

        return response()->json(['message' => 'Video lekcija uspjesno dodana!']);
    }

    public function getLekcije()
    {
        $lekcije = Lesson::get();
        return response()->json($lekcije);
    }
}
