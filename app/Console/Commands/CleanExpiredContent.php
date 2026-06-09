<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scholarship;
use App\Models\Bootcamp;

class CleanExpiredContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete scholarships and bootcamps that have passed their end_date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $todayStr = today()->toDateString();

        $scholarshipsDeleted = Scholarship::where('end_date', '<', $todayStr)->delete();
        $bootcampsDeleted = Bootcamp::where('end_date', '<', $todayStr)->delete();

        $this->info("Expired content cleaned successfully.");
        $this->info("Deleted Scholarships: {$scholarshipsDeleted}");
        $this->info("Deleted Bootcamps: {$bootcampsDeleted}");
    }
}
