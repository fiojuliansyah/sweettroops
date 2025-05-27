<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Models\Course;
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

        $dataTable->courseId = $course_id;

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

        return match ($request->type) {
            'url' => $this->handleUrlUpload($request),
            'video' => $this->handleVideoUpload($request),
            default => abort(400, 'Invalid type selected'),
        };
    }

    private function handleUrlUpload(Request $request)
    {
        $courseVideo = CourseVideo::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'type' => 'url',
            'description' => $request->description,
            'link_url' => $request->link_url,
        ]);

        return redirect()->route('admin.videos.index', $request->course_id)
            ->with(compact('courseVideo'))
            ->with('course_id', $request->course_id);
    }

    private function handleVideoUpload(Request $request)
    {
        return match ($request->storage) {
            'youtube' => $this->handleYouTubeUpload($request),
            'aws' => $this->handleAwsUpload($request),
            default => abort(400, 'Invalid storage option'),
        };
    }

    private function handleYouTubeUpload(Request $request)
    {
        $file = $request->file('video_file');

        if (!$file || !$file->isValid()) {
            return back()->withErrors(['video_file' => 'Invalid video file']);
        }

        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $localPath = $file->storeAs('public/videos', $fileName);

        $courseVideo = CourseVideo::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'type' => 'video',
            'description' => $request->description,
            'video_url' => $fileName,
        ]);

        $redirectURL = route('admin.videos.callback');

        session([
            'courseVideo' => $courseVideo,
            'course_id' => $request->course_id,
            'redirect_url' => $redirectURL,
            'local_video_path' => storage_path('app/' . $localPath),
        ]);

        return redirect()->to(Youtube::setRedirectUrl($redirectURL)->AuthUrl());
    }

    private function handleAwsUpload(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
        ]);

        $courseVideo = CourseVideo::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'type' => 'video',
            'description' => $request->description,
            'video_url' => $request->filename,
        ]);

        return redirect()->route('admin.videos.index', $request->course_id)
            ->with(compact('courseVideo'))
            ->with('course_id', $request->course_id);
    }

    public function callback(Request $request)
    {
        $courseVideo = session('courseVideo');
        $courseId = session('course_id');
        $redirectURL = session('redirect_url');
        $localPath = session('local_video_path');

        if (!$courseVideo || !$courseId || !$localPath || !file_exists($localPath)) {
            return response()->json(['error' => 'Tidak ada sesi login google'], 404);
        }

        Youtube::setRedirectUrl($redirectURL)->upload($localPath, [
            'title' => $courseVideo->title,
            'description' => $courseVideo->description,
            'tags' => ['cooking', 'cook'],
            'category_id' => 1,
        ]);

        unlink($localPath);

        Storage::delete('public/videos/' . $courseVideo->video_url);

        return redirect()
                    ->route('admin.videos.create', $courseId)
                    ->with('success', 'Video successfully uploaded to YouTube.');
    }

    public function generatePresignedUrl(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
            'content_type' => 'required|string',
            'folder' => 'required|string',
        ]);

        $filename = $request->filename;
        $contentType = $request->content_type;
        $folder = $request->folder;

        $disk = Storage::disk('s3');
        $client = $disk->getClient();
        $bucket = config('filesystems.disks.s3.bucket');
        $key = $folder . '/' . uniqid() . '_' . $filename;

        $cmd = $client->getCommand('PutObject', [
            'Bucket' => $bucket,
            'Key' => $key,
            'ACL' => 'public-read',
            'ContentType' => $contentType,
        ]);

        $signedRequest = $client->createPresignedRequest($cmd, '+30 minutes');

        return response()->json([
            'url' => (string) $signedRequest->getUri(),
            'key' => $key,
        ]);
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

        return redirect()->back()->with('success', 'Video successfully deleted.');
    }

    // AWS TES
    public function tesAWS(Request $request)
    {
        return view('admin.tesaws');
    }
}