<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\CustomersServiceInterface;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    private $service;

    public function __construct
    (
        CustomersServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function myCustomers()
    {
        return $this->service->allCustomers();
    }

    public function customerById(int $customer)
    {
        return $this->service->getCustomer($customer);
    }

    public function customerExpenses(int $customer)
    {
        return $this->service->getExpenses($customer);
    }

    public function customerRevenues(int $customer)
    {
        return $this->service->getRevenues($customer);
    }

    public function newCustomer(Request $request)
    {
        return $this->service->newCustomer($request);
    }

    public function editCustomer(Request $request, int $customer)
    {
        return $this->service->editCustomer($request, $customer);
    }

    public function deleteCustomer(int $customer)
    {
        return $this->service->deleteCustomer($customer);
    }
}
