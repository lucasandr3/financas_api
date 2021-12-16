<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\RevenueRepositoryInterface;
use App\Models\Revenue;
use App\Models\RevenueInstallments;
use Illuminate\Support\Facades\DB;

class RevenueRepository implements RevenueRepositoryInterface
{

    public function getAllRevenues()
    {
        return DB::table('revenues as r')
            ->addSelect('r.id','r.title', 'r.description', 'r.value', 'r.installments', 'r.quantity_installments', 'r.photo')
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

    public function saveRevenue(object $request, string $fileName)
    {
        try {

            $newRevenue = new Revenue;
            $newRevenue->id_category = $request->input('id_category');
            $newRevenue->title = $request->input('title');
            $newRevenue->description = $request->input('description');
            $newRevenue->value = $request->input('value');
            $newRevenue->installments = $request->input('installments');
            $newRevenue->quantity_installments = $request->input('quantity_installments');
            $newRevenue->photo = isset($fileName) ?? null;

            $newRevenue->save();

            if($request->input('installments') > 0) {
                $this->saveInstallmentsRevenue($newRevenue);
            }

            return response()->json(['user' => $newRevenue, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            Revenue::where('id', $newRevenue->id)->delete();
            return response()->json(['message' => 'Erro ao cadastrar receita!'], 409);
        }
    }

    public function saveInstallmentsRevenue($newRevenue)
    {
        $valueInstallment = ($newRevenue->value / $newRevenue->quantity_installments);

        for ($i = 0; $i < $newRevenue->quantity_installments; $i++) {
            $im = $i + 1;
            $newRevenueInstallments = new RevenueInstallments;
            $newRevenueInstallments->revenue = $newRevenue->id;
            $newRevenueInstallments->installment = $i + 1;
            $newRevenueInstallments->value_installment = $valueInstallment;
            $newRevenueInstallments->pay = date('Y-m-d', strtotime($newRevenue->pay . "+$im month"));
            $newRevenueInstallments->save();
        }
    }
}
