<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the blogs for the user.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is editor
     */
    public function isEditor()
    {
        return $this->role === 'editor';
    }

    /**
     * Check if user is regular user
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Check if user can edit a blog
     */
    public function canEdit(Blog $blog)
    {
        return $this->isAdmin() || ($this->isEditor() && $this->id === $blog->user_id);
    }

    /**
     * Check if user can delete a blog
     */
    public function canDelete(Blog $blog)
    {
        return $this->isAdmin() || ($this->isEditor() && $this->id === $blog->user_id);
    }

    /**
     * Check if user can create blogs
     */
    public function canCreateBlog()
    {
        return $this->isAdmin() || $this->isEditor();
    }

}
