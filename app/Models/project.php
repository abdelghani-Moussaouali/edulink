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
        return $this->belongsTo(group::class,);
    }

    function specializations()
    {
        return $this->belongsTo(specializations::class,);
    }
    function teachers()
    {
        return $this->belongsTo(teacher::class, 'teachers_id'); // belongs to 
    }
    // function keywords()
    // {
    //     return $this->belongsToMany(keywords::class, table: 'keywords_projects');
    // }
}
