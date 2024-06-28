<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;

class CustomerController
{
    public function index()
    {
        $customers = User::paginate(5); // paginate 10 customers per page
        return view('admin.customer.customer', compact('customers'));
    }
}
