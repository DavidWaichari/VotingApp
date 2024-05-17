<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class VotersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Assume the first row contains the headers and skip it
        $headers = [
            0 => "NAME",
            1 => "EMAIL",
            2 => "ID NUMBER",
            3 => "PHONE NUMBER",
            4 => "MEMBER NUMBER",
            5 => "CAN VOTE"
        ];

        // Skip the header row by using the slice method
        $dataRows = $rows->slice(1);

        foreach ($dataRows as $row) {
            $userData = array_combine($headers, $row->toArray());

            // Check if $userData is not false (array_combine returns false on failure)
            if ($userData) {
                // Save user data to the users table
                User::create([
                    'name' => $userData['NAME'],
                    'email' => $userData['EMAIL'],
                    'id_number' => $userData['ID NUMBER'],
                    'phone_number' => $userData['PHONE NUMBER'],
                    'member_number' => $userData['MEMBER NUMBER'],
                    'can_vote' => $userData['CAN VOTE'],
                ]);
            }
        }
    }
}
