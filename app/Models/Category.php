<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Libreria para soft deletes

class Category extends Model
{   
    use SoftDeletes; // Using soft deletes

    // The table associated with the model.
    protected $table = 'categories';

    // The attributes that are required.
    protected $fillable = [
        'slug',
        'name',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
