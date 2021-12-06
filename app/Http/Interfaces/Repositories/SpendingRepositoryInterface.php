<?php

namespace App\Http\Interfaces\Repositories;

interface SpendingRepositoryInterface
{
    public function getAllSpendings();

    public function getSpendingById(int $spending);

    public function saveSpending(array $spending);

    public function getTotalExpensesBySpending(int $spending);

    public function getExpensesBySpending(int $spending);

    public function getInstallmentsBySpendingExpense(int $category);
}
