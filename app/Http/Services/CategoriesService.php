<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\CategoriesRepositoryInterface;
use App\Http\Interfaces\Services\CategoriesServiceInterface;

class CategoriesService implements CategoriesServiceInterface
{
    private $repository;

    public function __construct
    (
        CategoriesRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function totalsCategories()
    {
        $expensesTotals = $this->repository->getTotalsExpensesCategories();
        $revenuesTotals = $this->repository->getTotalsRevenuesCategories();

        $expensesTotals = array_map(function ($expense) {
            $expense->total_expense = Helpers::formatMoney($expense->total_expense);
            return $expense;
        }, $expensesTotals);

        $revenuesTotals = array_map(function ($revenue) {
            $revenue->total_revenue = Helpers::formatMoney($revenue->total_revenue);
            return $revenue;
        }, $revenuesTotals);

        $totals = [
            'expenses' => $expensesTotals,
            'revenues' => $revenuesTotals
        ];

        return response()->json(['data' => $totals], 200);
    }
}
