<?php

namespace App\Http\Controllers\Trooper;

use App\Models\Course;
use App\Models\Comment;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TDiscussController extends Controller
{
    public function discussCourse($slug)
    {
        $course = Course::where('slug', $slug)->first();
        
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }
        
        $comments = Comment::where('course_id', $course->id)->get();
        
        
        $title = 'Discuss Courses';
    
        return view('troopers.courses.discuss', compact('title', 'course', 'comments'));
    }
    

    public function postComment(Request $request, $courseId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        // Simpan komentar
        $comment = new Comment();
        $comment->course_id = $courseId;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Your comment has been posted!');
    }
}
