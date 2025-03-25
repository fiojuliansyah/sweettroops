<?php

namespace App\Http\Controllers;

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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course = Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => $thumbnailPath,
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

    /**
     * Show the form for editing the specified resource.
     */
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        if ($request->hasFile('thumbnail')) {
            $course->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($request->except('thumbnail'));

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
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
