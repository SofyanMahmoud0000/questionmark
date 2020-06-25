<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mine:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset case and view';

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
        Artisan::call("cache:clear");
        Artisan::call("config:cache");

    }
}
