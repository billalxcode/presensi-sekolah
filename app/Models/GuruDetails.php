<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruDetails extends Model
{
    /** @use HasFactory<\Database\Factories\GuruDetailsFactory> */
    use HasFactory;

    protected $fillable = [
        'nip',
        'tanggal_lahir',
        'tempat_lahir',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
