<?php

namespace App\Console\Commands;

use function event;
use Illuminate\Console\Command;
use function print_r;
use function var_dump;

class FileJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filejob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {




        $data=\App\Logic\PdfJobLogic::getJob();
        if (!empty($data))
        {
            event(new \App\Events\DownlaodfileEvent($data));
        }
    }
}
