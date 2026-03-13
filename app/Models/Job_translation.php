<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job_translation extends Model
{
    public $timestamps = false; 
    
    // Allow mass assignment for translated fields
    protected $fillable = [
        'locale', 
        'job_id', 
        'title', 
        'description', 
    ];
    protected $table = 'job_translations';
}
