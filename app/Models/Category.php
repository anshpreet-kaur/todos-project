<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];
    // A category has many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // A category belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
