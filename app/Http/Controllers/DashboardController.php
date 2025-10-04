<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $userCount = User::where('role', 'user')->count();
        $courseCount = Course::count();
        $transactionCount = Transaction::count();
        return view('dashboard', compact('title', 'userCount', 'courseCount', 'transactionCount'));
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