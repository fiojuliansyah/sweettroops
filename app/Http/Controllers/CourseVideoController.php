<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use App\DataTables\CourseVideosDataTable;
use Illuminate\Support\Facades\Storage;

class CourseVideoController extends Controller
{
    public function index(CourseVideosDataTable $dataTable, $course_id)
    {
        $course = Course::findOrFail($course_id);

        return $dataTable->render('admin.videos.index', compact('course'));
    }

    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);

        return view('admin.videos.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $filePath = $request->input('video'); 
    
        CourseVideo::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $filePath
        ]);
    
        return redirect()->route('admin.videos.index', $request->course_id)
                         ->with('success', 'Video successfully uploaded.');
    }
    
    
    

    public function edit($course_id, $video_id)
    {
        $course = Course::findOrFail($course_id);
        $video = CourseVideo::findOrFail($video_id);

        return view('admin.videos.edit', compact('course', 'video'));
    }

    public function update($video_id, Request $request)
    {
        $video = CourseVideo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'nullable|string|max:100',
            'video_url' => 'nullable|url',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,inactive',
            'order' => 'nullable|integer',
        ]);

        $video->update([
            'title' => $request->title,
            'duration' => $request->duration,
            'video_url' => $request->video_url,
            'description' => $request->description,
            'status' => $request->status ?? 'active',
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('videos.index', $course->id)->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {

        $video = CourseVideo::findOrFail($id);

        $video->delete();

        return redirect()->route('videos.index', $course->id)->with('success', 'Video successfully deleted.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,mov,flv,wmv|max:2048000',
        ]);

        $file = $request->file('video');
        $path = $file->store('videos', 'public'); 

        return response()->json(['path' => $path]);
    }
}