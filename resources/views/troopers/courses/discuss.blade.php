@extends('layouts.master')

@section('content')
    <div class="dashboard-body">

        <div class="chart-wrapper d-flex flex-wrap gap-24">

            <!-- chat sidebar Start -->
            <div class="card chat-box">
                <div class="card-header py-16 border-bottom border-gray-100">
                    <div class="chat-list__item flex-between gap-8 cursor-pointer">
                        <div class="d-flex align-items-start gap-16">
                            <div class="d-flex flex-column">
                                <h6 class="text-line-1 text-15 text-gray-400 fw-bold mb-0">{{ $course->title ?? 'Course title not available' }}</h6>
                                <span class="text-line-1 text-13 text-gray-200">Online</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="chat-box-item-wrapper overflow-y-auto scroll-sm p-24">
                        @foreach ($comments as $com)
                            <div class="chat-box-item @if ($com->user_id == Auth::id()) right @endif d-flex align-items-end gap-8">
                                <img src="{{ $com->user->profile_picture ?? '/admin/assets/images/thumbs/user-img.png' }}" alt="User Image"
                                    class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                                <div class="chat-box-item__content">
                                    <small>{{ $com->user->name }}</small>
                                    <p class="chat-box-item__text py-16 px-16 px-lg-4">{{ $com->comment }}</p>
                                    <span class="text-gray-200 text-13 mt-2 d-block">
                                        {{ \Carbon\Carbon::parse($com->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer border-top border-gray-100">
                    <form action="{{ route('troopers.discussion.comment', ['courseId' => $course->id]) }}" method="POST"
                        class="flex-align gap-8 chat-box-bottom">
                        @csrf
                        {{-- <label for="fileUp" class="flex-shrink-0 file-btn w-48 h-48 flex-center bg-main-50 text-24 text-main-600 rounded-circle hover-bg-main-100 transition-2">
                        <i class="ph ph-plus"></i>
                    </label>
                    <input type="file" name="fileName" id="fileUp" hidden> --}}
                        <input type="text" name="comment"
                            class="form-control h-48 border-transparent px-20 focus-border-main-600 bg-main-50 rounded-pill placeholder-15"
                            placeholder="Type your message...">
                        <button type="submit"
                            class="flex-shrink-0 submit-btn btn btn-main rounded-pill flex-align gap-4 py-15">
                            Submit <span class="d-flex text-md d-sm-flex d-none"><i
                                    class="ph-fill ph-paper-plane-tilt"></i></span>
                        </button>
                    </form>
                </div>
            </div>
            <!-- chat sidebar End -->
        </div>

    </div>
@endsection
