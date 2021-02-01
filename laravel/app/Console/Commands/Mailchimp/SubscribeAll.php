<?php

namespace App\Console\Commands\Mailchimp;

use Illuminate\Console\Command;
use App\Services\SubscriptionService;

class SubscribeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:subscribe_all';

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

        $success = $service->subscribeAll();

        if($success) {
            $this->line('success');
        } else {
            dump($service->getErrors());
        }
    }
}
