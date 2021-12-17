<?php

namespace App\Http\Interfaces\Repositories;

interface CustomersRepositoryInterface
{
    public function getAllCustomers();

    public function getCustomerById(int $customer);

    public function saveCustomer(object $request);

    public function updateCustomer(object $request, int $customer);

    public function getTotalExpensesByCustomer(int $customer);

    public function getExpensesByCustomer(int $customer);

    public function getRevenuesByCustomer(int $customer);

    public function getInstallmentsByCustomerExpense(int $expense);

    public function getInstallmentsByCustomerRevenue(int $revenue);

    public function delCustomer(int $expense);
}
