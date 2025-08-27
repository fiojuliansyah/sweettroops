<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\DataTables\GalleriesDataTable;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(GalleriesDataTable $dataTable)
    {
        $title = 'Manage Hands-on Class';
        return $dataTable->render('admin.galleries.index', compact('title'));
    }

    public function create()
    {
        $title = 'Create Hands-on Class';
        return view('admin.galleries.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'date' => 'nullable|date|max:255',
        ]);
    
        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePaths[] = $file->store('hands-on-class', 'public');
            }
        }      
    
        $gallery = Gallery::create([
            'name' => $request->name,
            'image' => json_encode($imagePaths),
            'description' => $request->description,
            'date' => $request->date,
        ]);
    
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery created successfully.');
    }

    public function edit(Gallery $gallery)
    {
        $title = 'Edit Hands-on Class';
        return view('admin.galleries.edit', compact('title', 'gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $imagePaths = json_decode($gallery->image, true) ?? [];

        // jika ada file baru diupload, tambahkan ke list lama
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePaths[] = $file->store('hands-on-class', 'public');
            }
        }

        $gallery->update([
            'name' => $request->name,
            'image' => json_encode($imagePaths),
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            $images = json_decode($gallery->image, true);
            
            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }
    
        if ($gallery->trailer && Storage::disk('public')->exists($gallery->trailer)) {
            Storage::disk('public')->delete($gallery->trailer);
        }
        
        $gallery->delete();
    
        return redirect()->back()
            ->with('success', 'Files deleted successfully');
    }

    
}
