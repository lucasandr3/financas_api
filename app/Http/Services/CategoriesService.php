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
        $spendigsCategories = $this->repository->getTotalsSpendingsCategories();
        $cardsTotals = $this->repository->getTotalsCardsCategories();

        $totals_expenses = Helpers::calcValues([
            'expenses' => $expensesTotals,
            'spendings' => $spendigsCategories,
            'cards' => $cardsTotals,
        ]);

        $totals_revenues = Helpers::calcValues([
            'revenues' => $revenuesTotals
        ]);

        $expensesTotals = array_map(function ($expense) {
            $expense->total = Helpers::formatMoney($expense->total);
            return $expense;
        }, $expensesTotals);

        $revenuesTotals = array_map(function ($revenue) {
            $revenue->total = Helpers::formatMoney($revenue->total);
            return $revenue;
        }, $revenuesTotals);

        $spendigsCategories = array_map(function ($spendig) {
            $spendig->total = Helpers::formatMoney($spendig->total);
            return $spendig;
        }, $spendigsCategories);

        $cardsTotals = array_map(function ($card) {
            $card->total = Helpers::formatMoney($card->total);
            return $card;
        }, $cardsTotals);

        $totals = [
            'expenses' => $expensesTotals,
            'revenues' => $revenuesTotals,
            'spendings' => $spendigsCategories,
            'cards' => $cardsTotals,
        ];

        $totalsCalculed = [
            'total_expenses' => Helpers::formatMoney($totals_expenses),
            'total_revenues' => Helpers::formatMoney($totals_revenues),
            'balance' => Helpers::formatMoney($totals_revenues - $totals_expenses)
        ];

        return response()->json(['totals' => $totals, 'balance' => $totalsCalculed], 200);
    }
}
