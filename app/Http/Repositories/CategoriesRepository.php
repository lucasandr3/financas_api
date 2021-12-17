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
            ->addSelect((DB::raw('sum(e.value) total_expense')))
            ->join('financial_categories as c', 'c.id', '=', 'e.id_category_expense')
            ->groupBy('c.id')
            ->get()->toArray();
    }

    public function getTotalsRevenuesCategories()
    {
        return DB::table('revenues as r')
            ->addSelect('c.name as category')
            ->addSelect((DB::raw('sum(r.value) total_revenue')))
            ->join('financial_categories as c', 'c.id', '=', 'r.id_category')
            ->groupBy('c.id')
            ->get()->toArray();
    }
}
