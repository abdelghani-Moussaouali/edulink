<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
    
        'users_id',
        'max_project',
    ];
    protected $guard = 'teacher';
    function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
  
    function application()
    {
        return $this->belongsTo(related: applications::class);
    }

    function projects()
    {
        return $this->hasMany(project::class,'teachers_id');
    }
}
