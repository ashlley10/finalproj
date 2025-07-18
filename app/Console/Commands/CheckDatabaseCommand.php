<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckDatabaseCommand extends Command
{
    protected $signature = 'check:database';
    protected $description = 'Check SQLite database configuration';
    protected $commands = [
    \App\Console\Commands\CheckDatabaseCommand::class,
];

    public function handle()
    {
        $path = database_path('database.sqlite');
        
        $this->info("Checking database configuration...");
        $this->line("Database path: ".$path);
        $this->line("File exists: ".(file_exists($path) ? 'YES' : 'NO'));
        
        if (file_exists($path)) {
            $this->line("File size: ".filesize($path)." bytes");
            $this->line("Writable: ".(is_writable($path) ? 'YES' : 'NO'));
        }
        
        $this->line("\nCurrent DB_CONNECTION: ".config('database.default'));
    }
}
