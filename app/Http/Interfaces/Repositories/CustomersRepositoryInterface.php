<?php

namespace App\Http\Interfaces\Repositories;

interface CustomersRepositoryInterface
{
    public function getAllCustomers();

    public function getCustomerById(int $customer);

    public function saveCustomer(object $request);

    public function updateCustomer(object $request, int $customer);

    public function getInstallmentsByCard(int $card);

    public function getTotalExpensesByCard(int $card);

    public function getLimitByCard(int $card);

    public function getExpensesByCustomer(int $customer);

    public function getInstallmentsByCustomerExpense(int $expense);

    public function saveExpenseWithInstallment(array $expense);

    public function saveExpense(array $expense);

    public function delCustomer(int $expense);
}
