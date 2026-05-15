<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'Owner';
    protected $primaryKey = 'OwnerID';
    public $timestamps = false;

    protected $fillable = [
        'FullName',
        'Address',
        'Phone'
    ];
}