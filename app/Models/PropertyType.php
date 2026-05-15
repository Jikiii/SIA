<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $table = 'PropertyType';
    protected $primaryKey = 'PropertyTypeID';
    public $timestamps = false;

    protected $fillable = [
        'TypeName'
    ];
}