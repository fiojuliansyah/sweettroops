<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('dashboard', compact('title'));
    }

    public function adminDiscussCourse(Request $request)
    {
        
        $courses = Course::paginate(12);
        
        $title = 'All Courses';
        $categories = Category::all();
        $types = Type::all();
        
        return view('admin.discuss', compact('title', 'courses', 'categories', 'types'));
    }
    
}