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
            $spending->final_date = Helpers::formatDateSimple($spending->final_date);
            $spending->total_spending_category = Helpers::formatMoney($this->getTotalSpendingExpensesByCategory($spending->category_id));
            return $spending;
        }, $spendings);

        return response()->json(['data' => $spendings], 200);
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
            return response()->json(['message' => 'Limite de gastos não existe.'], 200);
        }

        $spendingObject = array_map(function ($spendingObj) {
            $spendingObj->value_target = Helpers::formatMoney($spendingObj->value_target);
            $spendingObj->limit_target_alert = $spendingObj->limit_target_alert . "%";
            $spendingObj->final_date = Helpers::formatDateSimple($spendingObj->final_date);
            $spendingObj->total_spending_category = Helpers::formatMoney($this->getTotalSpendingExpensesByCategory($spendingObj->id_category));
            return $spendingObj;
        }, $spendingObject);

        return response()->json(['data' => $spendingObject], 200);
    }

    public function newSpendingTarget(object $resquest)
    {
        $validator = Validator::make($resquest->all(), [
            'category_target' => 'required',
            'value_target' => 'required',
            'limit_target_alert' => 'required',
            'final_date' => 'required'
        ]);

        if (!$validator->fails()) {

            return $this->repository->saveSpending($resquest);

        } else {
            return ['error' => $validator->errors()];
        }
    }
}
