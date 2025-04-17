<?php

namespace App\Console\Commands;

use App\Services\CustomerServices;
use Illuminate\Console\Command;

class CustomerDueNotification extends Command
{

    protected $signature = 'command:customer-due-notification';

    protected $description = 'Successfully sent customer due notification';


    public function handle(CustomerServices $customerServices)
    {
        $customerServices->customerDueNotificationAlert();
    }
}
