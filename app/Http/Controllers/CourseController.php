<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Type;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\CoursesDataTable;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CoursesDataTable $dataTable)
    {
        $title = 'Manage Course';
        return $dataTable->render('admin.courses.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Course';
        $types = Type::all();
        $categories = Category::all();
        return view('admin.courses.create', compact('title','types','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|array', // Use array for multiple files
            'thumbnail.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for each image
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'description' => 'nullable|string',
            'instructor' => 'required|string|max:255',
            'normal_price' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'point' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_recommend' => 'boolean',
            'is_active' => 'boolean',
        ]);
    
        // Handle thumbnail upload
        $thumbnailPaths = [];
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $file) {
                $thumbnailPaths[] = $file->store('thumbnails', 'public');
            }
        }
    
        // Handle trailer upload
        $trailerPath = null;
        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $course->trailer = $trailerPath;
        }
        
    
        // Create course
        $course = Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => json_encode($thumbnailPaths),
            'trailer' => $trailerPath, // Store trailer path
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'instructor' => $request->instructor,
            'normal_price' => $request->normal_price,
            'price' => $request->price,
            'point' => $request->point,
            'is_featured' => $request->is_featured ?? 0,
            'is_recommend' => $request->is_recommend ?? 0,
            'is_active' => $request->is_active ?? 1,
        ]);
    
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }


    public function edit(Course $course)
    {
        $title = 'Edit Course';
        $types = Type::all();
        $categories = Category::all();
        return view('admin.courses.edit', compact('title', 'course', 'types', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|array',
            'thumbnail.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'description' => 'nullable|string',
            'instructor' => 'required|string|max:255',
            'normal_price' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'point' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_recommend' => 'boolean',
            'is_active' => 'boolean',
        ]);
    
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPaths = [];
            foreach ($request->file('thumbnail') as $file) {
                $thumbnailPaths[] = $file->store('thumbnails', 'public');
            }
            $course->thumbnail = json_encode($thumbnailPaths);
        }
    
        // Handle trailer upload
        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $course->trailer = $trailerPath;
        }
    
        // Update the rest of the course
        $course->update($request->except('thumbnail', 'trailer'));
    
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }
    
    
    public function destroy(Course $course)
    {
        
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }
        
        $course->delete();
        
        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
