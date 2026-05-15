<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lease;
use App\Models\Property;
use Carbon\Carbon;

class UpdateLeaseStatus extends Command
{
    protected $signature = 'lease:update-status';
    protected $description = 'Update expired leases and property availability automatically';

    public function handle()
    {
        $this->info('Updating lease statuses...');

        // 1️⃣ Expire all leases that ended before today
        $expiredLeases = Lease::where('EndDate', '<', Carbon::today())
                              ->where('Status', 'Active')
                              ->get();

        foreach ($expiredLeases as $lease) {
            $lease->Status = 'Expired';
            $lease->save();

            $this->info("Lease ID {$lease->LeaseID} marked as Expired");

            // 2️⃣ Update corresponding property status
            $property = $lease->property;
            if ($property) {
                $latestLease = $property->leases()
                                        ->where('Status', 'Active')
                                        ->latest('EndDate')
                                        ->first();

                $property->Status = $latestLease ? 'Rented' : 'Available';
                $property->save();

                $this->info("Property ID {$property->PropertyID} status updated to {$property->Status}");
            }
        }

        $this->info('Lease and property statuses updated successfully.');
        return 0;
    }
}