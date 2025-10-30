<?php

namespace App\Models;

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
        'username',
        'email',
        'password',
        'role',
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
     * Get all contacts submitted by this user
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Check if user is admin
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is member
     * 
     * @return bool
     */
    public function isMember()
    {
        return $this->role === 'member';
    }

    /**
     * Get user's full name or username
     * 
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        return $this->username;
    }

    /**
     * Scope to get only admin users
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope to get only member users
     */
    public function scopeMembers($query)
    {
        return $query->where('role', 'member');
    }

    /**
     * Scope to search users
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Get the user's initials for avatar
     * 
     * @return string
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->username);
        $initials = '';
        
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        
        return substr($initials, 0, 2);
    }

    /**
     * Get role badge color
     * 
     * @return string
     */
    public function getRoleBadgeColorAttribute()
    {
        return match($this->role) {
            'admin' => 'bg-blue-500',
            'member' => 'bg-green-500',
            default => 'bg-gray-500'
        };
    }

    /**
     * Get role display name
     * 
     * @return string
     */
    public function getRoleDisplayAttribute()
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'member' => 'Member',
            default => 'Unknown'
        };
    }
}