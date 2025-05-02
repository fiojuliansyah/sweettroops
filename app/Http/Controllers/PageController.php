<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Homepage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $homepage = Homepage::orderBy('created_at', 'ASC')->first();
        $courses = Course::orderBy('created_at', 'ASC')->paginate(5);
        $categories = Category::orderBy('created_at', 'ASC')->paginate(5);
        $sliders = Slider::orderBy('created_at', 'ASC')->get();
        return view('welcome', compact('title','homepage','courses','categories','sliders'));
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


}
