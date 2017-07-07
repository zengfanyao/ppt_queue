<?php
namespace App\Logic;
use App\Library\Tools;
use function env;
use const false;
use function file_exists;
use Imagick;
use function is_dir;
use Orbitale\Component\ImageMagick\Command;
use function var_dump;

/**
 * Created by PhpStorm.
 * User: yao
 * Date: 17/7/6
 * Time: 下午3:10
 */
class PdfJobLogic
{
    //获取任务
    public static function getJob()
    {
        try
        {
            $url=env('JOB_URL','http://yun.linyue.hznwce.com/api/file/task');
            $result= \App\Library\Tools::httpPost($url,array(),false,5);
            $result=json_decode($result,true);
            return $result;
        }catch (Exception $e)
        {
            return [];
        }
    }
    //创建目录
    public static function createDirectory($fileinfo)
    {
        $directory=env('DIR').'/output/';
        $job_id=$fileinfo['data']['job_id'];
        $path=$directory.$job_id;
        $f = true;
        if (file_exists($path) == false) {//创建目录
            if (mkdir($path, 0777, true) == false)
                $f = false;
            else if (chmod($path, 0777) == false)
                $f = false;
        }

        return $f;
    }

    public static function dispatchJob($fileInfo)
    {
        dispatch(new \App\Jobs\PDFjob($fileInfo));
    }
    public static function  readsFiles($jobId,$fileInfo)
    {
        $directory=env('DIR').'/'.$jobId;
        $files=[];
        if (file_exists($directory) && is_dir($directory))
        {
            try
            {
                $handler = opendir($directory);
                while (($filename = readdir($handler)) !== false)
                {
                    // 务必使用!==，防止目录下出现类似文件名“0”等情况
                    if ($filename !== "." && $filename !== "..")
                    {
                        $files[] = $filename ;
                    }
                }
            }catch(\Exception $e)
            {
                closedir($handler);
                return false;
            }
            closedir($handler);
            return $files;
        }
        return false;
    }
    public  static function uploadAliyunFile($jobId,$fileInfo)
    {
        $files=self::readsFiles($jobId,$fileInfo);
        if ($files)
        {
           $ossClient=\App\Logic\AliyunFile::getAliyunObject($fileInfo);
           if ($ossClient)
           {
               $taskData=$fileInfo['data'];
               $input=$taskData['input'];
               list($dir, $baseName, $extName)=\App\Library\Tools::parsePath($input['file']);
               $targetKey=$dir.'/'.$baseName.'/';
               $directory=env('DIR').'/'.$jobId;
               foreach ($files as $k=>$v)
               {
                   \App\Logic\AliyunFile::upload($targetKey.$v,$directory.'/'.$directory,$ossClient,$input['bucket']);
               }
           }

        }else
        {

        }
    }
}