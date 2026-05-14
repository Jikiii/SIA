<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'Property';
    protected $primaryKey = 'PropertyID';
    public $timestamps = false;

    protected $fillable = [
        'StaffID',
        'BranchID',
        'PropertyTypeID',
        'StreetName',
        'District',
        'City',
        'PostalCode',
        'Rooms',
        'RentAmount',
        'Status'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'BranchID');
    }
}