<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = ['id_fakultas','nama_prodi'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
