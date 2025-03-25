<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        $title = 'Manage Users';
        return $dataTable->render('admin.users.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create User';
        return view('admin.users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        // Create a new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit User';
        $courses = Course::all(); // Fetch all courses
        return view('admin.users.edit', compact('title', 'user', 'courses'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ]);
    
        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
        // If courses are provided, handle the relationships
        if ($request->has('courses')) {
            // First, remove any competition records for courses not selected (unchecked courses)
            $user->competitions()->whereNotIn('course_id', $request->courses)->delete();
    
            // Then, add new competition records for selected courses that do not exist yet
            foreach ($request->courses as $courseId) {
                // Check if the competition already exists
                if (!$user->competitions->contains('course_id', $courseId)) {
                    // If not, create a new competition
                    $user->competitions()->create([
                        'course_id' => $courseId,
                    ]);
                }
            }
        } else {
            // If no courses are selected, delete all competitions for the user
            $user->competitions()->delete();
        }
    
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Get the DataTable for users.
     */
    public function getDataTable(Request $request)
    {
        $users = User::query();
        return DataTables::eloquent($users)->make(true);
    }
}
