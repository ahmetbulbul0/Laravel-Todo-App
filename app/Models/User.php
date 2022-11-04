<?php

namespace App\Models;

use App\Models\Todo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "full_name",
        "username",
        "password",
        "email",
        "type",
    ];

    public function todo()
    {
        return $this->hasMany(Todo::class, "user", "id");
    }
}
