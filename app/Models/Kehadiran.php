<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    /** @use HasFactory<\Database\Factories\KehadiranFactory> */
    use HasFactory;

    protected $fillable = [
        'status',
        'keterangan',
        'siswa_id',
        'verified_by',
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaDetails::class, 'siswa_id');
    }

    public function is_verified()
    {
        return $this->verified_by !== null;
    }

    public function verified()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
