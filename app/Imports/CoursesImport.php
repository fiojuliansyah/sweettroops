<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoursesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip baris jika title dan price kosong
        if (empty($row['title']) && empty($row['price'])) {
            return null;
        }

        return new Course([
            'id'            => $row['id'] ?? null,
            'type_id'       => $row['type_id'] ?? null,
            'category_id'   => $row['category_id'] ?? null,
            'title'         => $row['title'] ?? null,
            'slug'          => Str::slug($row['title']),
            'description'   => $row['description'] ?? null,
            'point'         => $row['point'] ?? null,
            'normal_price'  => $row['normal_price'] ?? null,
            'price'         => $row['price'] ?? null,
            'trailer'       => $row['trailer'] ?? null,
            'is_active'     => $row['is_active'] ?? null,
            'is_featured'   => $row['is_featured'] ?? null,
            'is_recommend'  => $row['is_recommend'] ?? null,
        ]);
    }
}
