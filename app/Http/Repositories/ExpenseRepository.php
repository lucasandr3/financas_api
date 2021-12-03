<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\ExpenseRepositoryInterface;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseRepository implements ExpenseRepositoryInterface
{

    public function getAllExpenses()
    {
        return DB::table('expenses as e')
            ->addSelect('e.id','e.title', 'e.description', 'e.value', 'e.installments', 'e.quantity_installments')
            ->addSelect('fc.name as category')
            ->join('financial_categories as fc', 'fc.id', '=', 'e.id_category_expense')
            ->get()
        ->toArray();
    }

    public function getExpenseById(int $expense)
    {
        return DB::table('expenses as e')
            ->join('financial_categories as fc', 'fc.id', '=', 'e.id_category_expense')
            ->where('e.id', $expense)
            ->get()
            ->toArray();
    }

    public function getInstallmentsByExpense(int $expense)
    {
        return DB::table('expense_installments as ei')
            ->select('ei.id', 'ei.installment', 'ei.value_installment', 'ei.pay')
            ->addSelect('e.value as total_expense', 'e.quantity_installments', 'e.title', 'e.description')
            ->join('expenses as e', 'e.id', '=', 'ei.expense')
            ->where('ei.expense', $expense)
        ->get()->toArray();
    }

    public function saveExpense(array $expense)
    {
        return Expense::insert($expense);
    }

    public function getExpenseByCategory(int $category)
    {
        return DB::table('expenses as e')
            ->addSelect('e.id','e.title', 'e.description', 'e.value', 'e.installments', 'e.quantity_installments')
            ->addSelect('fc.name as category')
            ->join('financial_categories as fc', 'fc.id', '=', 'e.id_category_expense')
            ->where('id_category_expense', $category)
            ->get()
            ->toArray();
    }

    public function getTotalExpensesByCategory(int $category)
    {
        return DB::table('expenses')
            ->where('id_category_expense', $category)
            ->sum('value');
    }
}
