<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'Staff';
    protected $primaryKey = 'StaffID';
    public $timestamps = false;

    protected $fillable = [
        'BranchID',
        'FirstName',
        'LastName',
        'Address',
        'Phone',
        'Email',
        'Gender',
        'BirthDate',
        'Position',
        'Salary',
        'HireDate',
        'TypingSpeed'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'BranchID');
    }
}