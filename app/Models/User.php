<?php

namespace App\Models;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_name",
        "username",
        "password",
        "email",
        "type",
    ];

    public function todo() {
        return $this->hasMany(Todo::class, "user", "id");
    }
}
