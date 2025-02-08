<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'dosen';

    protected $fillable = [
        'nama',
        'no_wa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kelompok()
    {
        return $this->hasMany(Kelompok::class);
    }
}
