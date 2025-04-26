<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'kategori';
    protected $fillable = [
        'nama_kategori'
    ];

    public function tingkat() {
        return $this->hasMany(Tingkat::class, 'id_kategori','id');
    }
}
