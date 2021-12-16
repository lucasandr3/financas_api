<?php

namespace App\Http\Interfaces\Services;

interface ExpenseServiceInterface
{
    public function allExpenses();

    public function getExpense(int $expense);

    public function getExpenseByCategory(int $category);

    public function getTotalExpensesByCategory(int $category);

    public function getInstallments(int $expense);

    public function newExpense(object $resquest);

    public function deleteExpense(int $expense);
}
