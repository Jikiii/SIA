<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use Carbon\Carbon;

class UpdatePropertyStatus extends Command
{
    protected $signature = 'property:update-status';
    protected $description = 'Update property status based on active leases';

    public function handle()
    {
        $properties = Property::with(['leases'])->get();

        foreach ($properties as $property) {
            $hasActiveLease = $property->leases
                ->where('Status', 'Active')
                ->where('EndDate', '>=', Carbon::today())
                ->count() > 0;

            $newStatus = $hasActiveLease ? 'Rented' : 'Available';

            if ($property->Status !== $newStatus) {
                $property->Status = $newStatus;
                $property->save();
                $this->info("Updated PropertyID {$property->PropertyID} to {$newStatus}");
            }
        }

        $this->info('All property statuses updated successfully!');
    }
}