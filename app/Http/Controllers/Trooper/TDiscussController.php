<?php

namespace App\Http\Controllers\Trooper;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TDiscussController extends Controller
{
    public function discussCourse($slug)
    {
        $user = Auth::id();
        $courseList = Competition::where('user_id', $user)->get();
        $course = $courseList->first();
        $title = 'Discuss Courses';
    
        if (!$course) {
            return redirect()->back()->with('error', 'You have not joined any courses.');
        }
    
        return view('troopers.courses.discuss', compact('title', 'course', 'courseList'));
    } 
}
