<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'kelompok';

    protected $fillable = [
        'dospemId'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
