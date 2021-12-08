<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\SpendingTargetRepositoryInterface;
use App\Http\Interfaces\Services\SpendingTargetServiceInterface;
use Illuminate\Support\Facades\Validator;

class SpendingTargetService implements SpendingTargetServiceInterface
{
    private $repository;

    public function __construct
    (
        SpendingTargetRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function allSpendingsTargets()
    {
        $spendings = $this->repository->getAllSpendings();

        $spendings = array_map(function ($spending) {
            $spending->value_target = Helpers::formatMoney($spending->value_target);
            $spending->limit_target_alert = $spending->limit_target_alert . "%";
            $spending->total_spending_category = Helpers::formatMoney($this->getTotalSpendingExpensesByCategory($spending->category_id));
            return $spending;
        }, $spendings);

        return $spendings;
    }

    private function getTotalSpendingExpensesByCategory(int $categoryID)
    {
        $expenses = $this->repository->getTotalExpensesByCategory($categoryID);
        $expensesSpending = $this->repository->getTotalExpensesBySpending($categoryID);
        $total = ($expenses + $expensesSpending);
        return $total;
    }

    public function getSpendingTarget(int $spending)
    {
        $spendingObject = $this->repository->getSpendingById($spending);

        if (!sizeof($spendingObject) > 0) {
            return ['code' => 204, 'message' => 'Limite de gastos não existe.'];
        }

        $spendingObject = array_map(function ($spendingObj) {
            $spendingObj->value_target = Helpers::formatMoney($spendingObj->value_target);
            $spendingObj->limit_target_alert = $spendingObj->limit_target_alert . "%";
            $spendingObj->total_spending_category = Helpers::formatMoney($this->getTotalSpendingExpensesByCategory($spendingObj->id_category));
            return $spendingObj;
        }, $spendingObject);

        return ['code' => 200, 'spending_target' => $spendingObject];
    }

    public function newSpendingTarget(array $resquest)
    {
        $validator = Validator::make($resquest, [
            'limit_value' => 'required',
            'percent_alert' => 'required',
            'final_date' => 'required'
        ]);

        if (!$validator->fails()) {

            $newSpending = [
                'limit_value' => $resquest['limit_value'],
                'percent_alert' => $resquest['percent_alert'],
                'final_date_spending' => $resquest['final_date']
            ];

            $response = $this->repository->saveSpending($newSpending);

            if ($response) {
                return ['code' => 200, 'message' => 'Limite de gastos salvo com sucesso!'];
            } else {
                return ['code' => 500, 'message' => 'Erro ao salvar limite de gastos!!!'];
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }
}
