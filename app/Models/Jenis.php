<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'jenis';
    protected $fillable = [
        'id_tingkat',
        'nama_jenis',
        'poin'
    ];

    public function tingkat(){
        return $this->belongsTo(Tingkat::class,'id_tingkat','id');
    }
    public function kegiatan() {
        return $this->hasMany(Kegiatan::class,'id_jenis','id');
    }
}
