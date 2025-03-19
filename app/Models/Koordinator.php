<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'koordinator';

    protected $fillable = [
        'userId',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }
}
