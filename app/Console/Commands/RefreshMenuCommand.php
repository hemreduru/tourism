<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshMenuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh menu cache by clearing the view cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Refreshing menu cache...');

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        $this->info('Menu cache refreshed successfully!');

        return 0;
    }
}
