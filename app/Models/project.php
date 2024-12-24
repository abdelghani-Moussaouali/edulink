<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{


    protected $fillable = [
        'title',
        'description',
        'status',
        'teachers_id',
        'specializations_id',
    ];
    
    function group()
    {
        return $this->belongsTo(related: group::class);
    }

    function specializations()
    {
        return $this->hasOne(related: specializations::class);
    }
    // function keywords()
    // {
    //     return $this->hasMany(related: keywords::class);
    // }
}
