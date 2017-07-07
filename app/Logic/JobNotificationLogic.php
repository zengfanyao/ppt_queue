<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 17/7/7
 * Time: 下午6:18
 */

namespace App\Logic;

//各种通知事件
use function json_decode;

class JobNotificationLogic
{
    public static function error($type,$error_info='',$message)
    {

    }
    public static function success($type,$error_info='',$message)
    {

    }
    public static function failed($type,$error_info='',$message)
    {

    }

    public static function notificationPyhton()
    {

    }

    public static function successNotification($data)
    {
        //下载成功通知
        //上传成功通知
       $command=$data['data'];
        //$command=$command['command'];
       \Log::info($command['commandName']);
    }
}