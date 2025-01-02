<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;
protected $fillable = ['projects_id','group_leader'];

    function student()
    {
        return $this->belongsToMany(student::class,'group_students');
    }
    
    function leader()
    {
        return $this->hasMany(student::class,'group_leader');
    }
    function project()
    {
        return $this->hasMany(project::class,);
    }
}
