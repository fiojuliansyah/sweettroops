<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Type;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\CoursesImport;
use App\Imports\CompetitionsImport;
use App\Imports\CourseVideosImport;
use App\DataTables\CoursesDataTable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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
    
        $trailerPath = null;
        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
        }
        
    
        $course = Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => json_encode($thumbnailPaths),
            'trailer' => $trailerPath,
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
    
        if ($request->hasFile('thumbnail')) {
            $thumbnailPaths = [];
            foreach ($request->file('thumbnail') as $file) {
                $thumbnailPaths[] = $file->store('thumbnails', 'public');
            }
            $course->thumbnail = json_encode($thumbnailPaths);
        }
    
        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $course->trailer = $trailerPath;
        }
    
        $course->update($request->except('thumbnail', 'trailer'));
    
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }
    
    
    public function destroy(Course $course)
    {
        if ($course->thumbnail) {
            $thumbnails = json_decode($course->thumbnail, true);
            
            foreach ($thumbnails as $thumbnail) {
                if (Storage::disk('public')->exists($thumbnail)) {
                    Storage::disk('public')->delete($thumbnail);
                }
            }
        }
    
        if ($course->trailer && Storage::disk('public')->exists($course->trailer)) {
            Storage::disk('public')->delete($course->trailer);
        }
        
        $course->delete();
    
        return redirect()->route('admin.courses.index')
            ->with('success', 'Course and its files deleted successfully');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new CoursesImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data courses berhasil diimport!');
    }
    
    public function importCompetitionExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new CompetitionsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data kompetisi berhasil diimport!');
    }

    public function importVideos(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods|max:2048',
        ]);

        $file = $request->file('file');

        Excel::import(new CourseVideosImport, $file);

        return back()->with('success', 'Videos imported successfully.');
    }
}
