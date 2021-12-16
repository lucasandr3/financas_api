<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\ExpenseRepositoryInterface;
use App\Models\Expense;
use App\Models\ExpenseInstallments;
use Illuminate\Support\Facades\DB;

class ExpenseRepository implements ExpenseRepositoryInterface
{

    public function getAllExpenses()
    {
        return DB::table('expenses as e')
            ->addSelect('e.id','e.title', 'e.description', 'e.value', 'e.installments', 'e.quantity_installments', 'e.photo', 'e.date_expense')
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

    public function saveExpense(object $request, string $fileName)
    {
        try {

            $newExpense = new Expense;
            $newExpense->id_category_expense = $request->input('id_category');
            $newExpense->card = $request->input('card');
            $newExpense->title = $request->input('title');
            $newExpense->description = $request->input('description');
            $newExpense->value = $request->input('value');
            $newExpense->installments = $request->input('installments');
            $newExpense->quantity_installments = $request->input('quantity_installments');
            $newExpense->photo = isset($fileName) ?? null;

            $newExpense->save();

            if($request->input('installments') > 0) {
                $this->saveInstallmentsExpense($newExpense);
            }

            return response()->json(['expense' => $newExpense, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            ExpenseInstallments::where('id', $newExpense->id)->delete();
            return response()->json(['message' => 'Erro ao cadastrar despesa!'], 409);
        }
    }

    public function saveInstallmentsExpense($newExpense)
    {
        $valueInstallment = ($newExpense->value / $newExpense->quantity_installments);

        for ($i = 0; $i < $newExpense->quantity_installments; $i++) {
            $im = $i + 1;
            $newExpenseInstallments = new ExpenseInstallments;
            $newExpenseInstallments->expense = $newExpense->id;
            $newExpenseInstallments->installment = $i + 1;
            $newExpenseInstallments->value_installment = $valueInstallment;
            $newExpenseInstallments->pay = date('Y-m-d', strtotime($newExpense->pay . "+$im month"));
            $newExpenseInstallments->save();
        }
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

    public function delExpense(int $expense)
    {
        Expense::destroy($expense);
        return response()->json(['message' => 'Despesa removida com sucesso!!'], 200);
    }
}
