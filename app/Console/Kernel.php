<?php

namespace App\Console;

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
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->dailyAt('12:00')
        //          ->sendOutputTo('/home/wwwroot/zyan/storage/framework/renwu')
        //          ->emailOutputTo('240728816@qq.com');
        $schedule->call(function(){
        $view = 'emails.tixing';
        // $data = compact('user');
        $from = '18581688661@163.com';
        $name = '【勤智数码】';
        $to = '240728816@qq.com';
        $subject = "【勤智数码】工时登记提醒";

        Mail::send($view, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
        })->everyMinute();
    }
}
