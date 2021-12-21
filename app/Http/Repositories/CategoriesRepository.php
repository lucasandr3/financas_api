<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\CategoriesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoriesRepository implements CategoriesRepositoryInterface
{
    public function getTotalsExpensesCategories()
    {
        return DB::table('expenses as e')
            ->addSelect('c.name as category')
            ->addSelect((DB::raw('sum(e.value) total')))
            ->join('financial_categories as c', 'c.id', '=', 'e.id_category_expense')
            ->groupBy('c.id')
            ->get()->toArray();
    }

    public function getTotalsRevenuesCategories()
    {
        return DB::table('revenues as r')
            ->addSelect('c.name as category')
            ->addSelect((DB::raw('sum(r.value) total')))
            ->join('financial_categories as c', 'c.id', '=', 'r.id_category')
            ->groupBy('c.id')
            ->get()->toArray();
    }

    public function getSpendings()
    {
        return DB::table('spending as s')
            ->addSelect('s.id','s.title as object', 's.limit_value')
            ->get()->toArray();
    }

    public function getTotalsSpendingsCategories()
    {
        return DB::table('spending_expenses as se')
            ->addSelect('c.name as category')
            ->addSelect((DB::raw('sum(se.value) total')))
            ->join('spending as s', 's.id', '=', 'se.spending')
            ->join('financial_categories as c', 'c.id', '=', 'se.category')
            ->groupBy('c.id')
            ->get()->toArray();
    }

    public function getTotalsCardsCategories()
    {
        return DB::table('card_expenses as cc')
            ->addSelect('c.name as category')
            ->addSelect((DB::raw('sum(cc.value) total')))
            ->join('financial_categories as c', 'c.id', '=', 'cc.category')
            ->groupBy('c.id')
            ->get()->toArray();
    }
}
