<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\CardsRepositoryInterface;
use App\Models\Card;
use App\Models\CardExpenses;
use App\Models\CardInstallments;
use Illuminate\Support\Facades\DB;

class CardsRepository implements CardsRepositoryInterface
{

    public function getAllCards()
    {
        return DB::table('cards')->get()->toArray();
    }

    public function getSpendingById(int $spending)
    {
        return DB::table('spending as s')
            ->where('s.id', $spending)
            ->get()
            ->toArray();
    }

    public function saveCard(object $request)
    {
        try {

            $card = new Card;
            $card->company = $request->input('company');
            $card->institution = $request->input('institution');
            $card->title = $request->input('title');
            $card->limit_card = $request->input('limit_card');
            $card->annuity = $request->input('annuity');
            $card->percent_alert = $request->input('percent_alert');

            $card->save();
            return response()->json(['user' => $card, 'message' => 'CREATED'], 201);

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
