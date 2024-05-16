<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class VotersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['NAME'],
            'email' => $row['EMAIL'],
            'id_number' => $row['ID NUMBER'],
            'phone_number' => $row['PHONE NUMBER'],
            'member_number' => $row['MEMBER NO'],
            'can_vote' => $row['CAN VOTE'] ?? 'Yes',
        ]);
    }
}
