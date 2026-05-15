<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'Inspection';
    protected $primaryKey = 'InspectionID';
    public $timestamps = false;

    protected $fillable = [
        'PropertyID',
        'StaffID',
        'InspectDate',
        'Notes'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'PropertyID');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }
}