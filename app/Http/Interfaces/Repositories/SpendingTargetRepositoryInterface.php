<?php

namespace App\Http\Interfaces\Repositories;

interface SpendingTargetRepositoryInterface
{
    public function getAllSpendings();

    public function getSpendingById(int $spending);

    public function saveSpending(array $spending);

    public function getTotalExpensesByCategory(int $categoryID);

    public function getTotalExpensesBySpending(int $categoryID);

    public function getExpensesBySpending(int $spending);

    public function getInstallmentsBySpendingExpense(int $category);

    public function saveExpenseWithInstallment(array $expense);

    public function saveExpense(array $expense);

}
