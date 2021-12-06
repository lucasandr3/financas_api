<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\SpendingRepositoryInterface;
use App\Models\Spending;
use Illuminate\Support\Facades\DB;

class SpendingRepository implements SpendingRepositoryInterface
{

    public function getAllSpendings()
    {
        return DB::table('spending as s')
            ->addSelect('s.id', 's.limit_value', 's.percent_alert', 's.final_date_spending')
            ->get()
        ->toArray();
    }

    public function getSpendingById(int $spending)
    {
        return DB::table('spending as s')
            ->where('s.id', $spending)
            ->get()
            ->toArray();
    }

    public function saveSpending(array $spending)
    {
        return Spending::insert($spending);
    }

    public function getTotalExpensesBySpending(int $spending)
    {
        return DB::table('spending_expenses')
            ->where('spending', $spending)
            ->sum('value');
    }

    public function getExpensesBySpending(int $spending)
    {
        return DB::table('spending_expenses as se')
            ->addSelect('se.id','se.title', 'se.description', 'se.value', 'se.installments', 'se.quantity_installments', 'se.date_spending_expense')
            ->addSelect('fc.name as category', 'fc.id as id_category')
            ->join('financial_categories as fc', 'fc.id', '=', 'se.category')
            ->where('spending', $spending)
            ->get()
            ->toArray();
    }

    public function getInstallmentsBySpendingExpense(int $category)
    {
        return DB::table('spending_installments as si')
            ->select('si.id', 'si.installment', 'si.value_installment', 'si.pay')
            ->addSelect('se.value as total_expense', 'se.quantity_installments', 'se.title', 'se.description')
            ->join('spending_expenses as se', 'se.id', '=', 'si.spending_expense')
            ->where('si.spending_expense', $category)
            ->get()->toArray();
    }
}
