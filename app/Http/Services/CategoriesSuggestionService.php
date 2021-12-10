<?php

namespace App\Http\Services;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\CategoriesSuggestionRepositoryInterface;
use App\Http\Interfaces\Services\CategoriesSuggestionServiceInterface;
use App\Models\CategorySuggestion;
use Illuminate\Support\Facades\Validator;

class CategoriesSuggestionService implements CategoriesSuggestionServiceInterface
{
    private $repository;

    public function __construct
    (
        CategoriesSuggestionRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function allCategories()
    {
        $categories = CategorySuggestion::all();
        return response()->json($categories, 201);
    }

    public function getCard(int $card)
    {
        $cardObject = $this->repository->getCardById($card);

        if (!sizeof($cardObject) > 0) {
            return ['code' => 204, 'message' => 'Cartão não existe.'];
        }

        $cardObject = array_map(function ($cardObj) {
            $cardObj->limit_card = Helpers::formatMoney($cardObj->limit_card);
            $cardObj->percent_alert = $cardObj->percent_alert . "%";
            $cardObj->annuity = ($cardObj->annuity) ? Helpers::formatMoney($cardObj->annuity) : 'Não Informado';

            $expenses = $this->getExpensesByCard($cardObj->id);

            if ($expenses) {
                $cardObj->expenses = $expenses;
            }

            $totalExpenses = $this->repository->getTotalExpensesByCard($cardObj->id);
            $limitCard = $this->repository->getLimitByCard($cardObj->id);

            $totals = [
                'total_expenses' => Helpers::formatMoney($totalExpenses),
                'limit_card' => Helpers::formatMoney($limitCard->limit_card),
                'current_limit' => Helpers::formatMoney($limitCard->limit_card - $totalExpenses)
            ];

            $cardObj->totals = $totals;

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

        if (!$validator->fails()) {

            $response = $this->repository->saveCard($resquest);

            if ($response) {
                return response()->json(['message' => 'Cartão salvo com sucesso!'], 201);
            } else {
                return response()->json(['message' => 'Erro ao cadastrar Cartão!'], 500);
            }

        } else {
            return response()->json(['error' => $validator->errors()], 500);
        }
    }

    private function getExpensesByCard(int $card)
    {
        $expenses = $this->repository->getExpensesByCard($card);

        $expenses = array_map(function ($expense) {
            $expense->value = Helpers::formatMoney($expense->value);
            $expense->installments = ($expense->installments === 0) ? 'Pagamento único' : 'Parcelado';

            $installmentsCardExpense = $this->getInstallmentsByCardExpense($expense->id);

            if ($expense->installments != Constants::SEM_PARCELA_STRING) {
                $expense->installments_object = $installmentsCardExpense;
            }

            $expense->photo = ($expense->photo) ? url('storage/' . $expense->photo) : null;
            return $expense;
        }, $expenses);

        return $expenses;
    }

    private function getInstallmentsByCardExpense(int $expense)
    {
        $installments = $this->repository->getInstallmentsByCardExpense($expense);

        if (!sizeof($installments) > 0) {
            return [];
        }

        $installments = array_map(function ($installment) {
            $installment->installment = $installment->installment . 'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_expense = Helpers::formatMoney($installment->total_expense);
            return $installment;
        }, $installments);

        return $installments;
    }
}
