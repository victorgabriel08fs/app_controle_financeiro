<?php

namespace App\Console;

use App\Models\Taxa;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = User::all();
            $taxa = Taxa::all();
            $taxa = $taxa->last();
            foreach ($users as $user) {
                foreach ($user->contas as $conta) {
                    if ($conta->tipo == 0) {
                        $conta->saldo = $conta->saldo + ($taxa->taxa * $conta->saldo);
                        $conta->save();
                    }
                }
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
