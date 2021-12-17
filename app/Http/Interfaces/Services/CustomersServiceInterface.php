<?php

namespace App\Http\Interfaces\Services;

interface CustomersServiceInterface
{
    public function allCustomers();

    public function getCustomer(int $card);

    public function getExpenses(int $customer);

    public function getRevenues(int $customer);

    public function newCustomer(object $resquest);

    public function editCustomer(object $resquest, int $customer);

    public function deleteCustomer(int $customer);
}
