<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\SpendingRepositoryInterface;
use App\Http\Interfaces\Services\ExpenseServiceInterface;
use App\Http\Interfaces\Services\SpendingServiceInterface;
use Illuminate\Support\Facades\Validator;

class SpendingService implements SpendingServiceInterface
{
    private $repository;
    private $expenseService;

    public function __construct
    (
        SpendingRepositoryInterface $repository,
        ExpenseServiceInterface $expenseService
    )
    {
        $this->repository = $repository;
        $this->expenseService = $expenseService;
    }

    public function allSpendings()
    {
        $spendings = $this->repository->getAllSpendings();

        $spendings = array_map(function($spending) {
            $spending->limit_value = Helpers::formatMoney($spending->limit_value);
            $spending->percent_alert = $spending->percent_alert . "%";
            $spending->final_date_spending = Helpers::formatDateSimple($spending->final_date_spending);
            $spending->total_expenses = Helpers::formatMoney($this->expenseService->getTotalExpensesByCategory($spending->category_spending_limit));
            $spending->expenses = $this->expenseService->getExpenseByCategory($spending->category_spending_limit);
            return $spending;
        }, $spendings);

        return $spendings;
    }

    public function getSpending(int $spending)
    {
        $spendingObject = $this->repository->getSpendingById($spending);

        if(!sizeof($spendingObject) > 0) {
            return ['code' => 204, 'message' => 'Limite de gastos não existe.'];
        }

        $spendingObject = array_map(function($spendingObj) {
            $spendingObj->limit_value = Helpers::formatMoney($spendingObj->limit_value);
            $spendingObj->percent_alert = $spendingObj->percent_alert . "%";
            $spendingObj->final_date_spending = Helpers::formatDateSimple($spendingObj->final_date_spending);
            $spendingObj->total_expenses = Helpers::formatMoney($this->expenseService->getTotalExpensesByCategory($spendingObj->category_spending_limit));
            $spendingObj->expenses = $this->expenseService->getExpenseByCategory($spendingObj->category_spending_limit);
            return $spendingObj;
        }, $spendingObject);

        return ['code' => 200, 'spending' => $spendingObject];
    }

    public function getExpenses(int $spending)
    {
        $spendingObject = $this->repository->getSpendingById($spending);

        if (sizeof($spendingObject) === 0) {
            return ['code' => 204, 'message' => 'Limite de gastos não existe.'];
        }

        $expenses = $this->expenseService->getExpenseByCategory($spendingObject[0]->category_spending_limit);
        return ['code' => 200, 'expenses' => $expenses];
    }

    public function newSpending(array $resquest)
    {
        $validator = Validator::make($resquest, [
            'category' => 'required|int',
            'limit_value' => 'required',
            'percent_alert' => 'required',
            'final_date' => 'required'
        ]);

        if(!$validator->fails()) {

            $newSpending = [
                'category_spending_limit' => $resquest['category'],
                'limit_value' => $resquest['limit_value'],
                'percent_alert' => $resquest['percent_alert'],
                'final_date_spending' => $resquest['final_date']
            ];

            $response = $this->repository->saveSpending($newSpending);

            if($response) {
                return ['code' => 200, 'message' => 'Limite de gastos salvo com sucesso!'];
            } else {
                return ['code' => 500, 'message' => 'Erro ao salvar limite de gastos!!!'];
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }
}
