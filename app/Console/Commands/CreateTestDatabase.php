<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreateTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-test-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create test database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connectionName = Config::get('database.default');
        $databaseName = Config::get("database.connections.{$connectionName}.database");

        DB::statement('CREATE DATABASE IF NOT EXISTS ' . $databaseName . '_test');

        $this->info('Test database created successfully.');
    }
}
