<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\SpendingRepositoryInterface;
use App\Models\Spending;
use App\Models\SpendingExpenses;
use App\Models\SpendingInstallments;
use Illuminate\Support\Facades\DB;

class SpendingRepository implements SpendingRepositoryInterface
{

    public function getAllSpendings()
    {
        return DB::table('spending as s')
            ->addSelect('s.id', 's.title', 's.limit_value', 's.percent_alert', 's.final_date_spending')
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
            ->addSelect('se.id', 'se.title', 'se.description', 'se.value', 'se.installments', 'se.quantity_installments', 'se.photo', 'se.date_spending_expense')
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

    public function saveExpenseWithInstallment(array $expense)
    {
        try {
            DB::beginTransaction();
            SpendingExpenses::insert($expense);
            $expenseID = DB::getPdo()->lastInsertId();
            $this->saveInstallmentsExpense($expenseID, $expense);
            DB::commit();
            return response()->json(['message' => 'despesa salva com sucesso.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 200);
        }
    }

    public function saveInstallmentsExpense(int $expenseId, array $expense)
    {
        $installments = [];
        $parcela = 0;
        $dataAtual = date('Y-m-d');

        for ($i = 0; $i < $expense['quantity_installments']; $i++) {
            $parcela++;
            $installments[]['spending_limit'] = 2;
            $installments[]['spending_expense'] = $expenseId;
            $installments[]['installment'] = $parcela;
            $installments[]['value_installment'] = ($expense['value'] / $expense['quantity_installments']);
            $installments[]['pay'] = date('Y-m-d', strtotime('+ 1 month', strtotime($dataAtual)));
            SpendingInstallments::insert($installments);
        }
    }

    public function saveExpense(array $expense)
    {
        return SpendingExpenses::insert($expense);
    }
}
