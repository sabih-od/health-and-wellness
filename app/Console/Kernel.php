<?php

namespace App\Console;

use App\Models\BookSession;
use App\Models\Sessions;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            try {
                $pendingSessions = Sessions::whereHas('bookSession', function ($q) {
                    $q->where('status', '=', 'pending');
                })->get();

                if (count($pendingSessions) == 0) {
                    return;
                } else {
                    foreach ($pendingSessions as $session) {

                        $sessionEndTime = substr($session->session_time, 8, 10);

                        $sessionDateTime = Carbon::parse($session->date . $sessionEndTime);

                        $currentDateTime = Carbon::now();

                        if ($currentDateTime > $sessionDateTime) {

                            $bookSession = BookSession::where('session_id', $session->id)->first();
                            $bookSession->status = "completed";
                            $bookSession->save();

                        }
                    }
                }

            } catch (\Exception $exception){
                Log::error('Scheduler error:' . $exception->getMessage());
            }
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
