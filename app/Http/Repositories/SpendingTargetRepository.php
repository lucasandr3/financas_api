<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\SpendingTargetRepositoryInterface;
use App\Models\Spending;
use App\Models\SpendingExpenses;
use App\Models\SpendingInstallments;
use App\Models\SpendingTarget;
use Illuminate\Support\Facades\DB;

class SpendingTargetRepository implements SpendingTargetRepositoryInterface
{

    public function getAllSpendings()
    {
        return DB::table('spending_target as s')
            ->addSelect('s.id', 's.user_id', 's.value_target', 's.limit_target_alert', 's.final_date')
            ->addSelect('fc.name', 'fc.id as category_id')
            ->join('financial_categories as fc', 'fc.id', '=', 's.category_target')
            ->get()
        ->toArray();
    }

    public function getSpendingById(int $spending)
    {
        return DB::table('spending_target as s')
            ->addSelect('s.id', 's.user_id', 's.value_target', 's.limit_target_alert', 's.final_date')
            ->addSelect('fc.name as category', 'fc.id as id_category')
            ->join('financial_categories as fc', 'fc.id', '=', 's.category_target')
            ->where('s.id', $spending)
            ->get()
            ->toArray();
    }

    public function saveSpending(object $request)
    {
        try {
            $newSpending = new SpendingTarget;
            $newSpending->category_target = $request->input('category_target');
            $newSpending->value_target = $request->input('value_target');
            $newSpending->limit_target_alert = $request->input('limit_target_alert');
            $newSpending->final_date = $request->input('final_date');

            $newSpending->save();
            return response()->json(['data' => $newSpending, 'message' => 'CREATED'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar limite de gastos!'], 200);
        }
    }

    public function getTotalExpensesByCategory(int $categoryID)
    {
        return DB::table('spending_expenses')
            ->where('category', $categoryID)
            ->sum('value');
    }

    public function getTotalExpensesBySpending(int $categoryID)
    {
        return DB::table('expenses')
            ->where('id_category_expense', $categoryID)
            ->sum('value');
    }

    public function getExpensesBySpending(int $spending)
    {
        return DB::table('spending_expenses as se')
            ->addSelect('se.id','se.title', 'se.description', 'se.value', 'se.installments', 'se.quantity_installments', 'se.photo', 'se.date_spending_expense')
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
        SpendingExpenses::insert($expense);
        $expenseID = DB::getPdo()->lastInsertId();
        return $this->saveInstallmentsExpense($expenseID, $expense);
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
