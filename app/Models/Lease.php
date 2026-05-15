<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lease extends Model
{
    protected $table = 'Lease';
    protected $primaryKey = 'LeaseID';
    public $timestamps = false;

    protected $fillable = [
        'PropertyID',
        'RenterID',
        'StaffID',
        'Rent',
        'DepositAmount',
        'IsDepositPaid',
        'StartDate',
        'EndDate',
        'LeaseDuration',
        'Status'
    ];

    /**
     * Relationship: Lease belongs to a Property
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'PropertyID');
    }

    /**
     * Relationship: Lease belongs to a Renter
     */
    public function renter()
    {
        return $this->belongsTo(Renter::class, 'RenterID');
    }

    /**
     * Relationship: Lease belongs to a Staff member
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }

    /**
     * Accessor: Lease status based on end date
     * Returns 'Active' or 'Expired' dynamically
     */
 public function getCurrentStatusAttribute()
    {
        if ($this->EndDate && Carbon::parse($this->EndDate)->isPast()) {
            return 'Expired';
        }
        return $this->Status ?? 'Active';
    }
}