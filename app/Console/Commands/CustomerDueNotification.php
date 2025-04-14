<?php

namespace App\Console\Commands;

use App\Services\CustomerServices;
use Illuminate\Console\Command;

class CustomerDueNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:customer-due-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CustomerServices $customerServices)
    {
        //

        $dueCustomers = $customerServices->customerDueNotificationAlert();
    }
}
