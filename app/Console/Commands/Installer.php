<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class Installer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'limestay:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install application or clear the database.';

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

        if (strlen(env('APP_KEY')) < 1) {
            Artisan::call('key:generate');
            $this->info(Artisan::output());
        }

        if (env('DB_CONNECTION') == 'sqlite') {
            if (!file_exists(database_path('database.sqlite'))) {
                $this->info('Creating default sqlite database: database.sqlite');
                fopen(database_path('database.sqlite'), 'w');
            }
        }

        Artisan::call('migrate:fresh');
        $this->info(Artisan::output());



    }
}
