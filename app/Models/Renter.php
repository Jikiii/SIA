<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    // Table name
    protected $table = 'Renter';

    // Primary key
    protected $primaryKey = 'RenterID';

    // Disable timestamps if not used
    public $timestamps = false;

    // Mass assignable fields
    protected $fillable = [
        'BranchID',
        'StaffID',
        'FirstName',
        'LastName',
        'Address',
        'Phone',
        'DateApproved',
    ];

    /**
     * Relationship: Renter belongs to a Branch
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'BranchID');
    }

    /**
     * Relationship: Renter belongs to a Staff member
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }

    /**
     * Accessor: Full name of the renter
     */
    public function getFullNameAttribute()
    {
        return "{$this->FirstName} {$this->LastName}";
    }

public function leases()
{
    return $this->hasMany(Lease::class, 'RenterID', 'RenterID');
}
}