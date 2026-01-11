@extends('layouts.guest')

@section('content')
    <section class="sec-title">
    <div class="w-layout-blockcontainer w-container">
    <h1 class="heading-title">Edit User</h1>
    </div>
    </section>
    <section class="section-40">
        <div class="w-layout-blockcontainer container-38 w-container">
            <div class="div-block-34">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-block-4 w-form">
                        <label for="name" class="field-label-14">Name</label>
                        <input class="text-field-10 w-input" name="name" value="{{ $user->name }}" type="text">

                        <label for="email" class="field-label-15">Email Address</label>
                        <input class="text-field-11 w-input" name="email"  value="{{ $user->email }}" type="email">

                        <label for="phone" class="field-label-16">Phone Number</label>
                        <input class="text-field-12 w-input" name="phone" value="{{ $user->phone }}" type="text">

                        <label for="password" class="field-label-16">Password</label>
                        <input class="text-field-12 w-input" name="password" value="{{ $user->password }}" type="password">


                        <select id="Role" name="role" required="" class="select-field w-select">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="w-dyn-list">
                        <div role="list" class="w-dyn-items">
                            <div role="listitem" class="w-dyn-item">
                                <div class="w-form">
                                    @foreach ($courses as $course)
                                    <label class="form-check-label" for="course_{{ $course->id }}">
                                        <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" 
                                        id="course_{{ $course->id }}" 
                                        {{ $user->competitions->contains('course_id', $course->id) ? 'checked' : '' }}>
                                        {{ $course->title }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-button-4 w-button">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection

