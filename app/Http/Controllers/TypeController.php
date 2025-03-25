<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\TypesDataTable;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TypesDataTable $dataTable)
    {
        $title = 'Manage Type';
        return $dataTable->render('admin.types.index', compact('title'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Type';
        return view('admin.types.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:types',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        
        $slug = Str::slug($validated['name']);
        
        
        $imagePath = $request->file('image')->store('types', 'public');
        
        
        Type::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'image' => $imagePath,
        ]);
        
        return redirect()->route('admin.types.index')
            ->with('success', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('types')->ignore($type->id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        
        if ($validated['name'] !== $type->name) {
            $type->slug = Str::slug($validated['name']);
        }
        
        $type->name = $validated['name'];
        
        
        if ($request->hasFile('image')) {
            
            if ($type->image && Storage::disk('public')->exists($type->image)) {
                Storage::disk('public')->delete($type->image);
            }
            
            
            $type->image = $request->file('image')->store('types', 'public');
        }
        
        $type->save();
        
        return redirect()->route('admin.types.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Type $type)
    {
        
        if ($type->image && Storage::disk('public')->exists($type->image)) {
            Storage::disk('public')->delete($type->image);
        }
        
        $type->delete();
        
        return redirect()->route('admin.types.index')
            ->with('success', 'Category deleted successfully');
    }
}
