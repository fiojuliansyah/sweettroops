@extends('layouts.guest')

@section('content')
    <section class="sec-title">
        <div class="w-layout-blockcontainer w-container">
            <h1 class="heading-title">Create New User</h1>
        </div>
    </section>

    <section class="section-40">
        <div class="w-layout-blockcontainer container-38 w-container">
            <div class="div-block-34">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-block-4 w-form">
                        <label for="name" class="field-label-14">Name</label>
                        <input class="text-field-10 w-input" name="name" type="text" required>

                        <label for="email" class="field-label-15">Email Address</label>
                        <input class="text-field-11 w-input" name="email" type="email" required>

                        <label for="phone" class="field-label-16">Phone Number</label>
                        <input class="text-field-12 w-input" name="phone" type="text">

                        <select id="role" name="role" required class="select-field w-select">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>

                        <label for="password" class="field-label-14">Password</label>
                        <input class="text-field-10 w-input" name="password" type="password">
                        
                    </div>

                    {{-- Courses Checkboxes --}}
                    <div class="w-dyn-list">
                        <div role="list" class="w-dyn-items">
                            <div role="listitem" class="w-dyn-item">
                                <div class="w-form">
                                    <h4>Courses</h4>
                                    @foreach ($courses as $course)
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}">
                                            {{ $course->title }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-button-4 w-button">{{ isset($user) ? 'Update' : 'Create' }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection