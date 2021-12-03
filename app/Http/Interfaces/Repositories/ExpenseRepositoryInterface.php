<?php

namespace App\Http\Interfaces\Repositories;

interface ExpenseRepositoryInterface
{
    public function getAllExpenses();

    public function getExpenseById(int $expense);

    public function getInstallmentsByExpense(int $expense);

    public function saveExpense(array $expense);
}
