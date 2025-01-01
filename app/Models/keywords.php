<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class keywords extends Model
{

    use HasFactory;
    protected $fillable = ['keyword_name'];
    // function projects()
    // {
    //     return $this->belongsToMany(Project::class,table: 'keywords_projects');
    // }
}
