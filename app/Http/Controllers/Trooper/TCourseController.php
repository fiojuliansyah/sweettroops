<?php

namespace App\Http\Controllers\Trooper;

use Google_Client;
use Google_Service_Drive;
use App\Models\Type;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class TCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allCourse(Request $request)
    {
        $user = Auth::user();
        
        $query = Course::query();
    
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->has('type_id') && $request->type_id != '') {
            $query->where('type_id', $request->type_id);
        }
    
        if ($request->has('price') && $request->price != '') {
            if ($request->price == 'termurah') {
                $query->orderBy('price', 'asc');
            } elseif ($request->price == 'termahal') {
                $query->orderBy('price', 'desc');
            }
        }
    
        $query->where('is_active', 1);
        
        $courses = $query->paginate(8);
    
        $title = 'All Courses';
        $categories = Category::all();
        $types = Type::all();
    
        return view('troopers.courses.all-course', compact('title', 'courses', 'categories', 'types'));
    }
    
    
    public function detailCourse($slug)
    {
        $course = Course::with('videos')->where('slug', $slug)->first();
        $title = 'All Courses';
    
        return view('troopers.courses.detail-course', compact('title', 'course'));
    }   

    public function myCourse(Request $request)
    {
        $user = Auth::user();
        
        $query = Course::query();
        
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('type_id') && $request->type_id != '') {
            $query->where('type_id', $request->type_id);
        }
        
        $query->whereHas('competitions', function($q) use ($user) {
            $q->where('user_id', $user->id);
        });
        
        $courses = $query->paginate(12);
        
        $title = 'All Courses';
        $categories = Category::all();
        $types = Type::all();
        
        return view('troopers.courses.my-course', compact('title', 'courses', 'categories', 'types'));
    }

    public function myDetailCourse($slug)
    {
        
        $course = Course::with('videos')->where('slug', $slug)->first();
        $title = 'My Courses';

        
        $video = $course->videos->first();

        
        $videoFileId = $this->getFileIdByName($video->video_url);

        return view('troopers.courses.my-detail-course', compact('title', 'course', 'videoFileId', 'video'));
    }

    public function changeVideo($slug, $videoId)
    {
        
        $course = Course::with('videos')->where('slug', $slug)->first();
        $title = 'My Courses';

        
        $video = $course->videos->find($videoId);

        
        $videoFileId = $this->getFileIdByName($video->video_url);

        
        return view('troopers.courses.my-detail-course', compact('title', 'course', 'videoFileId', 'video'));
    }


    public function getFileIdByName($filename)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));

        $client->setAccessToken(env('GOOGLE_DRIVE_ACCESS_TOKEN'));

        if ($client->isAccessTokenExpired()) {
            $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
        }

        $service = new Google_Service_Drive($client);

        $files = $service->files->listFiles([
            'q' => "name = '{$filename}'",
            'spaces' => 'drive',
            'fields' => 'files(id, name)'
        ]);

        if (count($files->files) > 0) {
            return $files->files[0]->id;
        }

        return null;
    }
}
