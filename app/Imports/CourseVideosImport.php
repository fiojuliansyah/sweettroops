<?php

namespace App\Imports;

use App\Models\CourseVideo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseVideosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new CourseVideo([
            'course_id'     => $row['course_id'],
            'title'         => $row['title'],
            'duration'      => $row['duration'],
            'type'          => $row['type'],
            'link_url'      => $row['link_url'],
            'video_url'     => $row['video_url'],
            'description'   => $row['description'],
            'status'        => $row['status'] ?? 'active', // Default value 'active'
            'order'         => $row['order'] ?? 0, // Default value 0
        ]);
    }
}
