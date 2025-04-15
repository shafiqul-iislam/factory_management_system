<?php

namespace App\Services;

use Carbon\Carbon;
use App\Jobs\SendEmail;
use App\Models\Customer\Customer;

class CustomerServices
{

    public function customerDueNotificationAlert()
    {
        // if due status is on, and due date within 15 days,  
        $customerData = Customer::where('due_status', 1)
            ->where('due_date', '>=', Carbon::now()->addDays(-15))->get();

        foreach ($customerData as $customer) {

            // if ($customer->due_amount > 0) {

                $details = [
                    'toEmail' => $customer->email,
                    'name' => $customer->name,
                    'message' => 'Dear Customer You Need to Pay Your Due Amount Very Soon'
                ];

                dispatch(new SendEmail($details))->delay(now()->addMinutes(1));
            // }
        }
    }
}
