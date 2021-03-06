<?php

namespace App\Http\Interfaces\Repositories;

interface ExpenseRepositoryInterface
{
    public function getAllExpenses();

    public function getExpenseById(int $expense);

    public function getExpenseByCategory(int $category);

    public function getTotalExpensesByCategory(int $category);

    public function getInstallmentsByExpense(int $expense);

    public function saveExpense(object $request, string $fileName);

    public function editExpense(int $expense, object $request, string $fileName);

    public function saveInstallmentsExpense($newExpense);

    public function delInstallmentsEdit(int $expense);

    public function delExpense(int $expense);
}
