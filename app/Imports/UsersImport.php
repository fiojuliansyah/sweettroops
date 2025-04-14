<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip jika nama kosong (baris dianggap kosong/tidak valid)
        if (empty($row['name'])) {
            return null;
        }

        return new User([
            'id'              => $row['id'] ?? null,
            'name'            => $row['name'] ?? null,
            'email'           => $row['email'] ?? null,
            'phone'           => $row['phone'] ?? null,
            'phone_verified'  => $row['phone_verified'] ?? 'unverified',
            'password'        => '',
            'role'            => $row['role'] ?? 'user',
        ]);
    }
}

