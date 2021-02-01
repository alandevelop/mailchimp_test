<?php

namespace App\Console\Commands\Mailchimp;

use App\Services\SubscriptionService;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Spatie\Newsletter\NewsletterFacade;

class UpdateStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:update_statuses';

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
    public function handle()
    {
        $service = new SubscriptionService();

        $service->updateStatuses();
    }
}
