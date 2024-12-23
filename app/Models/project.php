<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    function teacher()
    {
        return $this->belongsTo(related: teacher::class);
    }
    function group()
    {
        return $this->belongsTo(related: group::class);
    }

    function specializations()
    {
        return $this->hasMany(related: specializations::class);
    }
    function keywords()
    {
        return $this->hasMany(related: keywords::class);
    }
}
