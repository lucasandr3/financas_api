<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\RevenueRepositoryInterface;
use App\Models\Revenue;
use Illuminate\Support\Facades\DB;

class RevenueRepository implements RevenueRepositoryInterface
{

    public function getAllRevenues()
    {
        return DB::table('revenues as r')
            ->addSelect('r.id','r.title', 'r.description', 'r.value', 'r.installments', 'r.quantity_installments')
            ->addSelect('fc.name as category')
            ->join('financial_categories as fc', 'fc.id', '=', 'r.id_category')
            ->get()
        ->toArray();
    }

    public function getRevenueById(int $revenue)
    {
        return DB::table('revenues')
            ->join('financial_categories', 'financial_categories.id', '=', 'revenues.id_category')
            ->where('revenues.id', $revenue)
            ->get()
            ->toArray();
    }

    public function getInstallmentsByRevenue(int $revenue)
    {
        return DB::table('revenue_installments as ri')
            ->select('ri.id', 'ri.installment', 'ri.value_installment', 'ri.pay')
            ->addSelect('r.value as total_revenue', 'r.quantity_installments', 'r.title', 'r.description')
            ->join('revenues as r', 'r.id', '=', 'ri.revenue')
            ->where('ri.revenue', $revenue)
        ->get()->toArray();
    }

    public function saveRevenue(array $revenue)
    {
        return Revenue::insert($revenue);
    }
}
