<?php

namespace App\Http\Interfaces\Services;

interface ExpenseServiceInterface
{
    public function allExpenses();

    public function getExpense(int $expense);

    public function getInstallments(int $expense);

    public function newExpense(array $resquest);
}
