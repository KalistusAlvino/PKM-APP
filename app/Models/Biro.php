<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biro extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'biro';

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }
}
