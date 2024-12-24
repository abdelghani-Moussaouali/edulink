<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specializations extends Model
{
    use HasFactory;
    protected $fillable = ['specialization_name'];
    function projects()
    {
        return $this->belongsTo(project::class, );
    }
}
