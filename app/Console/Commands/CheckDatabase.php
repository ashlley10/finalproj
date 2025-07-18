<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = database_path('database.sqlite');
    echo "Database path: $path\n";
    echo "File exists: ".(file_exists($path) ? 'Yes' : 'No')."\n";
    }
}
