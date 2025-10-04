<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Homepage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $homepage = Homepage::orderBy('created_at', 'ASC')->first();
        $upcomings = Course::orderBy('created_at', 'ASC')
                    ->where('is_upcoming', 1)
                    ->paginate(5);

        $courses = Course::orderBy('created_at', 'ASC')
                    ->where('is_newest', 1)
                    ->paginate(5);
        $categories = Category::orderBy('created_at', 'ASC')->paginate(5);
        $sliders = Slider::orderBy('created_at', 'ASC')->get();
        return view('welcome', compact('title','homepage','courses','categories','sliders','upcomings'));
    }

    public function about()
    {
        $title = 'About Us';
        return view('about', compact('title'));
    }

    public function contact()
    {
        $title = 'Contact';
        return view('contact', compact('title'));
    }

    public function faq()
    {
        $title = 'FAQs';
        return view('faq', compact('title'));
    }

    public function loginFirst()
    {
        $title = 'Login First';
        return view('auth.login-first', compact('title'));
    }

    public function privacyPolicy()
    {
        $title = 'Privacy Policy';
        return view('privacy-policy', compact('title'));
    }

    public function terms()
    {
        $title = 'Terms';
        return view('terms', compact('title'));
    }

    public function courses(Request $request)
    {
        $homepage = Homepage::orderBy('created_at', 'ASC')->first();

        $query = Course::where('is_active', 1);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sort = $request->input('sort', 'newest');

        if ($sort === 'alphabetical') {
            $query->orderBy('title', 'ASC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        $courses = $query->get();

        return view('courses', compact('courses', 'homepage'));
    }

    public function courseDetail($slug)
    {
        $homepage = Homepage::orderBy('created_at', 'ASC')->first();
        
        $course = Course::where('slug', $slug)->firstOrFail(); 
        
        return view('course-detail', compact('course', 'homepage'));
    }

    public function galleries()
    {
        $title = 'Hands-On Classes';
        $galleries = Gallery::latest()->get();
        return view('galleries', compact('title','galleries'));
    }
}
