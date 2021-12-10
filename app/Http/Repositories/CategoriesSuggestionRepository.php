<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\CategoriesSuggestionRepositoryInterface;
use App\Models\Card;
use Illuminate\Support\Facades\DB;

class CategoriesSuggestionRepository implements CategoriesSuggestionRepositoryInterface
{

    public function getAllCards()
    {
        return DB::table('cards')->get()->toArray();
    }

    public function getCardById(int $card)
    {
        return DB::table('cards as c')
            ->where('c.id', $card)
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

    public function getTotalExpensesByCard(int $card)
    {
        return DB::table('card_expenses')
            ->where('card', $card)
            ->sum('value');
    }

    public function getLimitByCard(int $card)
    {
        return DB::table('cards')
            ->select('limit_card')
            ->where('id', $card)->get()->toArray()[0];
    }

    public function getExpensesByCard(int $card)
    {
        return DB::table('card_expenses as ce')
            ->addSelect('ce.id', 'ce.company', 'ce.title', 'ce.description', 'ce.value', 'ce.installments', 'ce.quantity_installments', 'ce.photo', 'ce.date_pay as date_sale')
            ->addSelect('c.institution')
            ->join('cards as c', 'c.id', '=', 'ce.card')
            ->where('ce.card', $card)
            ->get()
            ->toArray();
    }

    public function getInstallmentsByCardExpense(int $expense)
    {
        return DB::table('card_installments as ci')
            ->select('ci.id', 'ci.installment', 'ci.value_installment', 'ci.pay')
            ->addSelect('ce.value as total_expense', 'ce.quantity_installments', 'ce.title', 'ce.description')
            ->join('card_expenses as ce', 'ce.id', '=', 'ci.card')
            ->where('ci.card_expense', $expense)
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

    public function getInstallmentsByCard(int $card)
    {
        return DB::table('card_installments as ci')
            ->select('ci.id', 'ci.installment', 'ci.value_installment', 'ci.pay')
            ->where('ci.card_expense', $card)
            ->get()->toArray();
    }
}
