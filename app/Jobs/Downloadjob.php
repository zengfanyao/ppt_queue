<?php

namespace App\Jobs;

use App\Library\Tools;
use function event;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Downloadjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $fileInfo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileInfo)
    {
        //
        $this->fileInfo=$fileInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
       // $state=\App\Logic\AliyunFile::download($this->fileInfo);
        \Log::info('success');
    }
}
