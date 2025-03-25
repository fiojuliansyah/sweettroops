@extends('layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Edit User</span></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                <h5 class="mb-0">Edit User Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row gy-20">
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required placeholder="Enter user name">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Enter email address">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Password (Leave empty to keep current)</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter new password">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                        </div>
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Assign Courses</label>
                            <div class="form-check">
                                @foreach ($courses as $course)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" 
                                            {{ $user->competitions->contains('course_id', $course->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="course_{{ $course->id }}">
                                            {{ $course->title }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>                                          
                        <div class="col-sm-12 flex-align justify-content-end gap-8">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                            <button type="submit" class="btn btn-main rounded-pill py-9">Update User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
