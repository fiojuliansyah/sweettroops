<?php

namespace App\Http\Controllers\Trooper;

use App\Models\Comment;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TDiscussController extends Controller
{
    public function discussCourse($slug)
    {
        $user = Auth::id();
        $course = Competition::where('user_id', $user)
                             ->first()
                             ->course; // Pastikan Anda mendapatkan data course yang terkait dengan user
        
        if (!$course) {
            return redirect()->back()->with('error', 'You have not joined any courses.');
        }
    
        $comments = Comment::where('course_id', $course->id)->get();
        $lastComment = Comment::where('course_id', $course->id)
                              ->latest()
                              ->first();
    
        $title = 'Discuss Courses';
    
        return view('troopers.courses.discuss', compact('title', 'course', 'comments', 'lastComment'));
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
