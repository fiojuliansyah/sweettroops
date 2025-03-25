<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $courses = Course::orderBy('created_at', 'ASC')->paginate(5);
        $categories = Category::orderBy('created_at', 'ASC')->paginate(5);
        $sliders = Slider::orderBy('created_at', 'ASC')->get();
        return view('welcome', compact('title','courses','categories','sliders'));
    }
}
