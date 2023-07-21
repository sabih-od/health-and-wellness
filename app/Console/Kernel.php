<?php

namespace App\Console;

use App\Models\BookSession;
use App\Models\Notification;
use App\Models\Sessions;
use App\Traits\PHPCustomMail;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    use PHPCustomMail;

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
                $pendingSessions = BookSession::where('status', '=', 'pending')->with('sessionTiming', 'session')->get();
                if (count($pendingSessions) == 0) {
                    return;
                } else {
                    foreach ($pendingSessions as $session) {
                        $sessionEndTime = substr($session->sessionTiming->session_time, 8, 10);

                        $sessionDateTime = Carbon::parse($session->session->date . $sessionEndTime);

                        $currentDateTime = Carbon::now();

                        if ($currentDateTime > $sessionDateTime) {

                            $session->status = "completed";
                            $session->save();

                        }
                    }
                }

            } catch (\Exception $exception) {
                Log::error('Scheduler error:' . $exception->getMessage());
            }
        })->everyMinute();


        $schedule->call(function () {
            try {
                $pendingSessions = BookSession::where('status', '=', 'pending')->with('sessionTiming', 'session')->get();

                if (count($pendingSessions) == 0) {
                    return;
                } else {
                    foreach ($pendingSessions as $session) {
                        $sessionstartTime = substr($session->sessionTiming->session_time, 0, 5);
                        $sessionDateTime = Carbon::parse($session->session->date . $sessionstartTime);

                        $currentDateTime = Carbon::now();
                        if ($currentDateTime > $sessionDateTime) {
                            $user = Auth::user();
                            echo "IN NOTIFICATION First";

                            event(new \App\Events\NotificationEvent($user->id, "Your Session Timing Has Been Start!!"));
                            echo "IN NOTIFICATION";
//                            $noti = new Notification([
//                                'notify_id' => $user->id,
//                                'notification' => "Your Session Timing Has Been Start!!",
//                            ]);
//                            $noti->save();
//
//                            $to = $user->email;
//                            $from = "noreplay@health-and-wellness.com";
//                            $subject = "Info";
//                            $message = "Your Session Timing Has Been Start!!";
//
//                            $this->customMail($from, $to, $subject, $message);

                        }
                    }
                }

            } catch (\Exception $exception) {
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
