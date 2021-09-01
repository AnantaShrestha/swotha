<?php

namespace App\Console;

use App\HoldDates;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
//        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $tripinfo = HoldDates::all();
            $date1 = strtotime(Carbon::now()->format('Y-m-d H:i:s'));
            if(!empty($tripinfo)) {
	            foreach ($tripinfo as $trip) {
		            $date2 = strtotime($trip->date);
		            $date2 = strtotime("+72 hours", $date2);
		            if ($date1 >= $date2) {
			            $seats = $trip->seats;
			            $previous_seats = $trip->trips->remainingseats;
			            $newseats = ((int)($previous_seats + $seats));
			            $trip->trips->update(['remainingseats' => $newseats]);
			            $trip->delete();
		            }

	            }
            }
        });
        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
