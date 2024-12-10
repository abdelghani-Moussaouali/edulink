<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class applications extends Model
{
    function student()
    {
        return $this->hasMany(related: student::class);
    } function teacher()
    {
        return $this->hasMany(related: teacher::class);
    }
}
