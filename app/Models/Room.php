<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'guru_id',
    ];

    public function siswas()
    {
        return $this->hasMany(SiswaDetails::class, 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(GuruDetails::class);
    }
}
