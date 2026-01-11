<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
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
        $courses = Course::all();
        return view('admin.users.create', compact('title','courses'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|string|in:admin,user',
            'password' => 'required|string|min:8',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('courses')) {
            $user->competitions()->whereNotIn('course_id', $request->courses)->delete();
    
            foreach ($request->courses as $courseId) {
                if (!$user->competitions->contains('course_id', $courseId)) {
                    $user->competitions()->create([
                        'course_id' => $courseId,
                    ]);
                }
            }
        } else {
            $user->competitions()->delete();
        }

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
        $courses = Course::all();
        return view('admin.users.edit', compact('title', 'user', 'courses'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
        if ($request->has('courses')) {
            $user->competitions()->whereNotIn('course_id', $request->courses)->delete();
    
            foreach ($request->courses as $courseId) {
                if (!$user->competitions->contains('course_id', $courseId)) {
                    $user->competitions()->create([
                        'course_id' => $courseId,
                    ]);
                }
            }
        } else {
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

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data users berhasil diimport!');
    }
}
