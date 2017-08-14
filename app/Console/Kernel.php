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
        $schedule->command('inspire')
                 ->dailyAt('12:00')
                 ->sendOutputTo('/home/wwwroot/zyan/storage/framework/renwu')
                 ->emailOutputTo('240728816@qq.com');
        // $schedule->call(function(){
        //     $statusStr = array(
        // "0" => "短信发送成功",
        // "-1" => "参数不全",
        // "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        // "30" => "密码错误",
        // "40" => "账号不存在",
        // "41" => "余额不足",
        // "42" => "帐户已过期",
        // "43" => "IP地址限制",
        // "50" => "内容含有敏感词"
        //  );  
        // $smsapi = "http://www.smsbao.com/"; //短信网关
        // $user = "weiwei2018"; //短信平台帐号
        // $pass = md5("w123456"); //短信平台密码
        // $code=rand(100000,999999);
        // Session_Start();
        // $_SESSION["verify_code"]=$code;
        // $content="【智眼Zyan】验证码：".$code;//要发送的短信内容
        // $phone = '13096369298';
        // $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
        // $result =file_get_contents($sendurl) ;
        // })->everyMinute();
    }
}
