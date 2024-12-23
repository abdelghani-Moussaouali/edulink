<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class specializations extends Model
{
    function projects()
    {
        return $this->belongsTo(related: project::class);
    }
}
