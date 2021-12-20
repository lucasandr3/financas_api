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

    public function getTotalsSpendingsCategories()
    {
        return DB::table('spending_expenses as se')
            ->addSelect('s.title')
            ->addSelect('se.title as object')
            ->addSelect('c.name as category')
            ->addSelect((DB::raw('sum(se.value) total')))
            ->join('spending as s', 's.id', '=', 'se.spending')
            ->join('financial_categories as c', 'c.id', '=', 'se.category')
            ->groupBy('se.id')
            ->get()->toArray();
    }

    public function getTotalsCardsCategories()
    {
        return DB::table('card_expenses as cc')
            ->addSelect('c.name as card')
            ->addSelect((DB::raw('sum(cc.value) total')))
            ->addSelect('cards.institution')
            ->join('financial_categories as c', 'c.id', '=', 'cc.category')
            ->join('cards', 'cards.id', '=', 'cc.card')
            ->groupBy('cards.id')
            ->groupBy('c.id')
            ->get()->toArray();
    }
}
