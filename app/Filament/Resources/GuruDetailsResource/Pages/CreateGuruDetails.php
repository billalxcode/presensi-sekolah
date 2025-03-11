<?php

namespace App\Filament\Resources\GuruDetailsResource\Pages;

use App\Filament\Resources\GuruDetailsResource;
use App\Models\GuruDetails;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateGuruDetails extends CreateRecord
{
    protected static string $resource = GuruDetailsResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $user->markEmailAsVerified();
        $user->assignRole('guru');

        $guru = GuruDetails::create([
            'nip' => $data['nip'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'tempat_lahir' => $data['tempat_lahir'],
            'user_id' => $user->id,
        ]);

        return $guru;
    }
}
