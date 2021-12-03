<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\SpendingRepositoryInterface;
use App\Models\Spending;
use Illuminate\Support\Facades\DB;

class SpendingRepository implements SpendingRepositoryInterface
{

    public function getAllSpendings()
    {
        return DB::table('spending as s')
            ->addSelect('s.id', 's.category_spending_limit', 's.limit_value', 's.percent_alert', 's.final_date_spending')
            ->addSelect('fc.name as category')
            ->join('financial_categories as fc', 'fc.id', '=', 's.category_spending_limit')
            ->get()
        ->toArray();
    }

    public function getSpendingById(int $spending)
    {
        return DB::table('spending as s')
            ->join('financial_categories', 'financial_categories.id', '=', 's.category_spending_limit')
            ->where('s.id', $spending)
            ->get()
            ->toArray();
    }

    public function saveSpending(array $spending)
    {
        return Spending::insert($spending);
    }
}
