<?php
/**
 * Created by PhpStorm.
 * User: yao
 * Date: 17/7/6
 * Time: 下午3:40
 */

namespace App\Logic;

use App\Library\Tools;
use function env;
use const false;
use function file_exists;
use function filesize;
use function is_dir;
use function is_file;
use OSS\OssClient;
use OSS\Core\OssException;
use const true;
use function unlink;
use function unserialize;

class AliyunFile
{

    //下载文件
    public static function download($fileinfo)
    {
        //存储目录
        $directory=env('DIR').'/input/';
        $taskData=$fileinfo['data'];
        $input=$taskData['input'];
        $accessKeyId=$input['bucket_access_key_id'];
        $accessKeySecret=$input['bucket_access_key_secret'];
        $endpoint=$input['endpoint'];
        list($dir, $baseName, $extName)=\App\Library\Tools::parsePath($input['file']);
        $localfile=$directory.$baseName.'.'.$extName;
        $options = array(
            OssClient::OSS_FILE_DOWNLOAD => $localfile,
        );
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ossClient->getObject($input['bucket'],$input['file'], $options);
        } catch (OssException $e)
        {
            Tools::LogInfo($e->getMessage());
            return false;
        }
        unset($fileinfo);
        return true;
    }

    public static function getAliyunObject($fileInfo)
    {
        //读取文件
        try{
            $taskData=$fileInfo['data'];
            $input=$taskData['input'];
            $accessKeyId=$input['bucket_access_key_id'];
            $accessKeySecret=$input['bucket_access_key_secret'];
            $endpoint=$input['endpoint'];
            list($dir, $baseName, $extName)=\App\Library\Tools::parsePath($input['file']);
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

        }catch (OssException $e)
        {
            return false;
        }
        return $ossClient;
    }

    /**
     * @param 阿里云存储的文件
     * @param 本地上传的文件
     */
    public static function upload($objectFile,$file,OssClient $ossClient,$bucket)
    {
        if (is_file($file) && file_exists($file))
        {
            $filesize=filesize($file);
            if ($filesize < 10*1024 * 1024)
            {
                try{
                    $ossClient->multiuploadFile($bucket,$objectFile,$file);
                }catch (OssException $e)
                {
                    return false;
                }
            }
        }
    }
}