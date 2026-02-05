<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function findOrCreateCustomer($request): Customer
    {
        return Customer::query()->firstOrCreate(
            ['email' => $request['email']],
            [
                'name' => $request['name'],
                'phone_number' => $request['phone_number'],
            ]
        );
    }
}
