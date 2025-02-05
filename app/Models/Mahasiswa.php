<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    use HasUuids;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'userId',
        'fakultas',
        'prodi',
        'email',
        'no_wa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
