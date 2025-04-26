<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'tingkat';
    protected $fillable = [
        'id_kategori',
        'nama_tingkat'
    ];

    public function jenis() {
        return $this->hasMany(Jenis::class, 'id_tingkat','id');
    }
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori','id');
    }
}
