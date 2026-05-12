<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'deskripsi', 'foto_before', 'foto_after', 'latitude', 'longitude', 'status'
    ];

    protected $appends = ['foto_before_url', 'foto_after_url'];

    // Full URL for foto_before
    public function getFotoBeforeUrlAttribute()
    {
        if ($this->foto_before) {
            return url('/storage/' . $this->foto_before);
        }
        return null;
    }

    // Full URL for foto_after
    public function getFotoAfterUrlAttribute()
    {
        if ($this->foto_after) {
            return url('/storage/' . $this->foto_after);
        }
        return null;
    }

    // Relasi: Laporan ini milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}