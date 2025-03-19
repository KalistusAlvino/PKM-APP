<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterDosen extends Model
{
    use HasFactory;

    public function __construct(public User $user, public Dosen $dosen) {
    }
}
