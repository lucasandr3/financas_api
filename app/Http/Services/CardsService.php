<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\CardsRepositoryInterface;
use App\Http\Interfaces\Services\ExpenseServiceInterface;
use App\Http\Interfaces\Services\CardsServiceInterface;
use Illuminate\Support\Facades\Validator;

class CardsService implements CardsServiceInterface
{
    private $repository;
    private $expenseService;

    public function __construct
    (
        CardsRepositoryInterface $repository,
        ExpenseServiceInterface $expenseService
    )
    {
        $this->repository = $repository;
        $this->expenseService = $expenseService;
    }

    public function allCards()
    {
        $cards = $this->repository->getAllCards();

        $cards = array_map(function($card) {
            $card->limit_card = Helpers::formatMoney($card->limit_card);
            $card->percent_alert = $card->percent_alert . "%";
            $card->annuity = ($card->annuity) ? Helpers::formatMoney($card->annuity) : 'Não Informado';
            return $card;
        }, $cards);

        return response()->json($cards, 201);
    }

    public function getCard(int $card)
    {
        $cardObject = $this->repository->getCardById($card);

        if(!sizeof($cardObject) > 0) {
            return ['code' => 204, 'message' => 'Cartão não existe.'];
        }

        $cardObject = array_map(function($cardObj) {
            $cardObj->limit_card = Helpers::formatMoney($cardObj->limit_card);
            $cardObj->percent_alert = $cardObj->percent_alert . "%";
            $cardObj->annuity = ($cardObj->annuity) ? Helpers::formatMoney($cardObj->annuity) : 'Não Informado';
            return $cardObj;
        }, $cardObject);

        return response()->json($cardObject, 201);
    }

    public function getExpenses(int $card)
    {
        $cardObject = $this->repository->getCardById($card);

        if (sizeof($cardObject) === 0) {
            return ['code' => 204, 'message' => 'Cartão não existe.'];
        }

        $expenses = $this->getExpensesByCard($cardObject[0]->id);
//        echo "<pre>";
//        var_dump($expenses);
//        echo "</pre>";
//        die;
        return response()->json($expenses, 201);
    }

    public function newCard(object $resquest)
    {
        $validator = Validator::make($resquest->all(), [
            'company' => 'required',
            'institution' => 'required',
            'limit_card' => 'required',
            'percent_alert' => 'required'
        ]);

        if(!$validator->fails()) {

            $response = $this->repository->saveCard($resquest);

            if($response) {
                return response()->json(['message' => 'Cartão salvo com sucesso!'], 201);
            } else {
                return response()->json(['message' => 'Erro ao cadastrar Cartão!'], 500);
            }

        } else {
            return response()->json(['error' => $validator->errors()], 500);
        }
    }

    public function getTotalSpendingExpensesByCategory(int $spending)
    {
        return $this->repository->getTotalExpensesBySpending($spending);
    }

    public function getExpensesByCard(int $card)
    {
        $expenses = $this->repository->getExpensesByCard($card);
        $totalExpenses = $this->repository->getTotalExpensesByCard($card);
        $limitCard = $this->repository->getLimitByCard($card);

        $totais = [
            'totais' => [
                'total_expenses' => Helpers::formatMoney($totalExpenses),
                'limit_card' => Helpers::formatMoney($limitCard->limit_card),
                'current_limit' => Helpers::formatMoney($limitCard->limit_card - $totalExpenses)
            ]
        ];

        $expenses = array_map(function($expense) {
            $expense->value = Helpers::formatMoney($expense->value);
            $expense->installments = ($expense->installments === 0) ? 'Pagamento único' : 'Parcelado';
            $expense->installments_object = ($expense->installments !== 0) ? $this->getInstallmentsByCardExpense($expense->id) : null;
            $expense->photo = ($expense->photo) ? url('storage/' . $expense->photo) : null;
            return $expense;
        }, $expenses);

        array_push($expenses, $totais);

        return $expenses;
    }

    private function getInstallmentsByCardExpense(int $expense)
    {
        $installments = $this->repository->getInstallmentsByCardExpense($expense);

        if(!sizeof($installments) > 0) {
            return [];
        }

        $installments = array_map(function($installment) {
            $installment->installment = $installment->installment.'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_expense = Helpers::formatMoney($installment->total_expense);
            return $installment;
        }, $installments);

        return $installments;
    }

    public function newExpenseSpending(object $resquest)
    {
        $validator = Validator::make($resquest->all(), [
            'spending' => 'required',
            'id_category' => 'required|int',
            'title' => 'required|string',
            'value' => 'required',
            'photo' => 'required|file|mimes:jpg,png'
        ]);

        if(!$validator->fails()) {

            $file = $resquest->file('photo')->store('public');
            $nameFile = explode('public/', $file);

            $newExpense = [
                'spending' => $resquest['spending'],
                'category' => $resquest['id_category'],
                'title' => $resquest['title'],
                'description' => $resquest['description'],
                'value' => $resquest['value'],
                'installments' => $resquest['installments'],
                'quantity_installments' => $resquest['quantity_installments'],
                'photo' => $nameFile[1],
                'date_spending_expense' => $resquest['date_spending_expense']
            ];

            if($newExpense['installments'] == 1) {
                $response = $this->repository->saveExpenseWithInstallment($newExpense);
            } else {
                $response = $this->repository->saveExpense($newExpense);
            }

            if($response) {
                return ['code' => 200, 'message' => 'Despesa salva com sucesso!'];
            } else {
                return ['code' => 500, 'message' => 'Erro ao salvar despesa!!!'];
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }
}
