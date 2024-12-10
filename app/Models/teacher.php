<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class teacher extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'users_id',
        'max_project',

    ];
    protected $guard = 'teacher';
    function users()
    {
        return $this->belongsTo(User::class);
    }
    function project()
    {
        return $this->hasMany(related: project::class);
    }
    function application()
    {
        return $this->belongsTo(related: applications::class);
    }
}
