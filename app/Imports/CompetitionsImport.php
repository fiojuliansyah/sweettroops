<?php

namespace App\Imports;

use App\Models\Competition;
use App\Models\User;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompetitionsImport implements ToModel, WithHeadingRow
{    
    public function model(array $row)
    {
        if (
            empty($row['user_id']) || empty($row['course_id']) ||
            !User::find($row['user_id']) || !Course::find($row['course_id'])
        ) {
            return null; // skip jika user_id / course_id tidak valid
        }
    
        return new Competition([
            'id'        => $row['id'] ?? null,
            'user_id'   => $row['user_id'],
            'course_id' => $row['course_id'],
        ]);
    }
    
}
