<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

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
