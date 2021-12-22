<?php

namespace App\Console\Commands;

use App\Actions\NotifyPackageWaiting;
use App\Models\Package;
use Illuminate\Console\Command;

class CheckPackageStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:package-states';

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
     * @return int
     */
    public function handle(): int
    {
        $packages = Package::query()->waitingOverDay()->get();

        $packages->each(fn (Package $package) => app(NotifyPackageWaiting::class)->execute($package));

        return 0;
    }
}
