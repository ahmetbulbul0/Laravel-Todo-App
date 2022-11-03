<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        "content",
        "user",
        "added_time",
        "is_completed",
    ];

    public function user() {
        return $this->hasOne(Todo::class, "id", "user");
    }
}
