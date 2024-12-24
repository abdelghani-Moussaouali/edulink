<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keywords extends Model
{

    use HasFactory;
    protected $fillable = ['keyword_name'];
    // function projects()
    // {
    //     return $this->belongsTo(related: project::class);
    // }
}
