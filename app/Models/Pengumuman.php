<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

     use HasUuids;

    protected $table = 'pengumuman';

    protected $fillable = [
        'gambar',
        'title',
        'isi',
        'tanggal',
    ];
}
