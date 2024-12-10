<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    function student()
    {
        return $this->belongsTo(student::class);
    }
    function project()
    {
        return $this->hasMany(project::class);
    }
}
