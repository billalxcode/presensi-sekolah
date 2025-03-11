<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaDetails extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaDetailsFactory> */
    use HasFactory;

    protected $fillable = [
        'nis',
        'tanggal_lahir',
        'tempat_lahir',
        'user_id',
        'kelas_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Room::class);
    }
}
