<?php

namespace App\Models;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    public function todo() {
        return $this->hasOne(Todo::class, "user", "id");
    }
}
