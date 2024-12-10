<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class student extends Authenticatable
{
    use HasFactory, Notifiable;
protected $fillable = [
    'users_id','skills'
];
    function users()
    {
        return $this->belongsTo(User::class);
    }
    function groups()
    {
        return $this->belongsTo(related: group::class);
    }
  
    function applications()
    {
        return $this->belongsTo(related: applications::class);
    }
  


}
