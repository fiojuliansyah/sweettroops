<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('dashboard', compact('title'));
    }

    public function adminDiscussCourse()
    {
        $courseList = Course::all();
        $course = $courseList->first();
        $title = 'Admin Discuss Courses';
    
        if (!$course) {
            return redirect()->back()->with('error', 'No courses available.');
        }
    
        return view('admin.discuss', compact('title', 'course', 'courseList'));
    }
    
}