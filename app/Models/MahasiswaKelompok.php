<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaKelompok extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'mahasiswa_kelompok';

    protected $fillable = [
        'kelompokId',
        'mahasiswaId',
        'status_mahasiswa',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'mahasiswaId','id');
    }
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class,'kelompokId','id');
    }

    public function nim(){
        return $this->belongsToMany(User::class, 'mahasiswa', 'userId');
    }
}
