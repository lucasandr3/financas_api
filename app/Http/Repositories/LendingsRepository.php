<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\LendingsRepositoryInterface;
use App\Models\Lending;
use App\Models\LendingInstallments;
use Illuminate\Support\Facades\DB;

class LendingsRepository implements LendingsRepositoryInterface
{

    public function getAllLendings()
    {
        return DB::table('lendings as l')
            ->addSelect('l.id', 'l.title', 'l.reason', 'l.value_lending', 'l.interest', 'l.installments', 'l.quantity_installments', 'l.pay_date')
            ->addSelect('fc.name')
            ->join('financial_categories as fc', 'fc.id', '=', 'l.category')
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

    public function saveLeading(object $request)
    {
        try {

            $lending = new Lending;
            $lending->category = $request->input('category');
            $lending->company = $request->input('company');
            $lending->title = $request->input('title');
            $lending->reason = $request->input('reason');
            $lending->value_lending = $request->input('value_lending');
            $lending->interest = $request->input('interest');
            $lending->installments = $request->input('installments');
            $lending->quantity_installments = $request->input('quantity_installments');
            $lending->pay_date = $request->input('pay_date');

            $lending->save();
            return response()->json(['user' => $lending, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar usuário!'], 409);
        }
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
