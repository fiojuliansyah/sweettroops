<?php

// app/Http/Controllers/DiscussionController.php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Course;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $discussions = $course->discussions()->with('user', 'comments.user')->get();
        return view('discussions.index', compact('course', 'discussions'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $discussion = Discussion::create([
            'course_id' => $courseId,
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('discussions.index', $courseId)->with('success', 'Discussion created!');
    }

    public function commentStore(Request $request, $discussionId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $discussion = Discussion::findOrFail($discussionId);

        Comment::create([
            'discussion_id' => $discussion->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('discussions.index', $discussion->course_id)->with('success', 'Comment added!');
    }
}

