<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Property extends Model
{
    protected $table = 'Property';
    protected $primaryKey = 'PropertyID';
    public $timestamps = false;

    protected $fillable = [
        'StaffID',
        'PropertyTypeID',
        'OwnerID',
        'StreetName',
        'District',
        'City',
        'PostalCode',
        'Rooms',
        'RentAmount',
        'Status'
    ];

    // ======================
    // Relationship: STAFF (Manager)
    // ======================
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID', 'StaffID');
    }

    // ======================
    // Relationship: PROPERTY TYPE
    // ======================
    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'PropertyTypeID', 'PropertyTypeID');
    }

    // ======================
    // Relationship: OWNER
    // ======================
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'OwnerID', 'OwnerID');
    }

    // ======================
    // Relationship: LEASES
    // ======================
    public function leases()
    {
        return $this->hasMany(Lease::class, 'PropertyID', 'PropertyID');
    }

    // ======================
    // Relationship: INSPECTIONS
    // ======================
    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'PropertyID', 'PropertyID');
    }

    // ======================
    // Accessor: Current status based on active leases
    // Returns 'Rented' if there's an active lease, else 'Available'
    // ======================
    public function getCurrentStatusAttribute()
    {
        // Check if there is any active lease
        $activeLease = $this->leases()->where('Status', 'Active')->first();

        return $activeLease ? 'Rented' : 'Available';
    }

    // ======================
    // Optional: Latest lease
    // ======================
    public function latestLease()
    {
        return $this->hasOne(Lease::class, 'PropertyID', 'PropertyID')->latest('EndDate');
    }
}   