<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\FileController;

class AssignRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get info routes and assign to Drivers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assigned = new FileController();
        $assigned->assignDrivers();
    }
}
