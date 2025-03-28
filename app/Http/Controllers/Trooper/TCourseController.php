<?php

namespace App\Http\Controllers\Trooper;

use App\Models\Type;
use App\Models\Course;
use App\Models\Category;
use App\Models\Competition;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allCourse(Request $request)
    {
        $user = Auth::user();
        
        $query = Course::query();
    
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->has('type_id') && $request->type_id != '') {
            $query->where('type_id', $request->type_id);
        }
    
        if ($request->has('price') && $request->price != '') {
            if ($request->price == 'termurah') {
                $query->orderBy('price', 'asc');
            } elseif ($request->price == 'termahal') {
                $query->orderBy('price', 'desc');
            }
        }
    
        $query->where('is_active', 1);
        
        $courses = $query->paginate(8);
    
        $title = 'All Courses';
        $categories = Category::all();
        $types = Type::all();
    
        return view('troopers.courses.all-course', compact('title', 'courses', 'categories', 'types'));
    }
    
    
    public function detailCourse($slug)
    {
        $course = Course::with('videos')->where('slug', $slug)->first();
        $title = 'All Courses';
    
        return view('troopers.courses.detail-course', compact('title', 'course'));
    }   

    public function myCourse(Request $request)
    {
        $user = Auth::user();
        
        $query = Course::query();
        
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('type_id') && $request->type_id != '') {
            $query->where('type_id', $request->type_id);
        }
        
        $query->whereHas('competitions', function($q) use ($user) {
            $q->where('user_id', $user->id);
        });
        
        $courses = $query->paginate(12);
        
        $title = 'All Courses';
        $categories = Category::all();
        $types = Type::all();
        
        return view('troopers.courses.my-course', compact('title', 'courses', 'categories', 'types'));
    }

    public function myDetailCourse($slug)
    {
        $course = Course::with('videos')->where('slug', $slug)->first();
        $title = 'My Courses';
    
        return view('troopers.courses.my-detail-course', compact('title', 'course'));
    }   
}
