<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Jobs\UploadFileJob;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DataTables\CourseVideosDataTable;
use AymanElmalah\YoutubeUploader\Facades\Youtube;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class CourseVideoController extends Controller
{
    public function index(CourseVideosDataTable $dataTable, $course_id)
    {
        $course = Course::findOrFail($course_id);

        return $dataTable->render('admin.videos.index', compact('course'));
    }

    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);

        return view('admin.videos.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // VALUE SEBENARNYA UNTUK KOLOM VIDEO URL SAYA GANTI DENGAN VIDEO NAME AGAR LEBIH DINAMIS
        $courseVideo = CourseVideo::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->filename
        ]);
        
        $redirectURL = 'http://localhost:8000/successauth';

        return redirect()
                ->to(Youtube::setRedirectUrl($redirectURL)->AuthUrl())
                ->with([
                    'courseVideo' => $courseVideo,
                    'course_id' => $request->course_id,
                    'redirect_url' => $redirectURL
                ]);
    }

    public function callback(Request $request) 
    {
        $courseVideo = session('courseVideo');
        $courseId = session('course_id');
        $redirectURL = session('redirect_url');

        if ($courseVideo && $courseId) {
            // VIDEO URL FROM KEY 'video_url'
            $videoUrlData = json_decode($courseVideo->video_url, true);
            $videoPath = $videoUrlData['path'];

            Youtube::setRedirectUrl($redirectURL)->upload('storage/' . $videoPath,
                [
                    'title' => $courseVideo->title,
                    'description' => $courseVideo->description,
                    'tags' => ['cooking', 'cook'],
                    'category_id' => 1,
                ]
            );

            Storage::delete('public/videos/' . $videoPath);
            
            return redirect()->route('admin.videos.create', $courseId)
                         ->with('success', 'Video successfully uploaded.');
        } else {
            return response()->json(['error' => 'No session data found'], 404);
        }
    }
    
    public function edit($course_id, $video_id)
    {
        $course = Course::findOrFail($course_id);
        $video = CourseVideo::findOrFail($video_id);

        return view('admin.videos.edit', compact('course', 'video'));
    }

    public function update($video_id, Request $request)
    {
        $video = CourseVideo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'nullable|string|max:100',
            'video_url' => 'nullable|url',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,inactive',
            'order' => 'nullable|integer',
        ]);

        $video->update([
            'title' => $request->title,
            'duration' => $request->duration,
            'video_url' => $request->video_url,
            'description' => $request->description,
            'status' => $request->status ?? 'active',
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('videos.index', $course->id)->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {

        $video = CourseVideo::findOrFail($id);

        $video->delete();

        return redirect()->route('videos.index', $course->id)->with('success', 'Video successfully deleted.');
    }

    public function upload(Request $request)
    {
        // $request->validate([
        //     'video' => 'required|file|mimes:mp4,mov,flv,wmv|max:2048000',
        // ]);

        // $file = $request->file('video');

        // dispatch(new UploadFileJob($file));

        // return response()->json(['path' => 'videos/']);

        /**
         * 
         * New code for large file upload
         * 
         */
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        $fileReceived = $receiver->receive();

        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName());
            $fileName .= '_' . md5(time()) . '.' . $extension;

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('videos', $file, $fileName);

            unlink($file->getPathname());

            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName
            ];
        }

        $handler = $fileReceived->handler();

        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}