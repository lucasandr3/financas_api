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
        return DB::table('expenses')
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
        return DB::table('expenses as e')
            ->addSelect('e.id', 'e.company', 'e.title', 'e.description', 'e.value', 'e.installments', 'e.quantity_installments', 'e.photo')
            ->addSelect('c.institution')
            ->join('cards as c', 'c.id', '=', 'e.card')
            ->where('e.card', $card)
            ->get()
            ->toArray();
    }

    public function getInstallmentsByCardExpense(int $expense)
    {
        return DB::table('expense_installments as ei')
            ->select('ei.id', 'ei.installment', 'ei.value_installment', 'ei.pay')
            ->addSelect('e.value as total_expense', 'e.quantity_installments', 'e.title', 'e.description')
            ->join('expenses as e', 'e.id', '=', 'ei.expense')
            ->where('ei.expense', $expense)
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
