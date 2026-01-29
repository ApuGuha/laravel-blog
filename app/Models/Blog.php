<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    // Get the users that owns a blog

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAuthorNameAttribute()
    {
        return $this->user->name;
    }
}
