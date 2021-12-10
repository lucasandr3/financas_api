<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\LendingsRepositoryInterface;
use App\Models\Lending;
use Illuminate\Support\Facades\DB;

class LendingsRepository implements LendingsRepositoryInterface
{

    public function getAllLendings()
    {
        return DB::table('lendings as l')
            ->addSelect('l.id', 'l.title', 'l.reason', 'l.value_lending', 'l.interest', 'l.installments', 'l.quantity_installments', 'l.pay_date')
            ->addSelect('fc.name')
            ->join('financial_categories as fc', 'fc.id', '=', 'l.category')
            ->get()
            ->toArray();
    }

    public function getLendingById(int $lending)
    {
        return DB::table('lendings as l')
            ->addSelect('l.id', 'l.title', 'l.reason', 'l.value_lending', 'l.interest', 'l.installments', 'l.quantity_installments', 'l.pay_date')
            ->addSelect('fc.name')
            ->join('financial_categories as fc', 'fc.id', '=', 'l.category')
            ->where('l.id', $lending)
            ->get()
            ->toArray();
    }

    public function getInstallmentsByLending(int $lending)
    {
        return DB::table('lending_installments as li')
            ->select('li.id', 'li.installment', 'li.value_installment', 'li.pay')
            ->where('li.lending', $lending)
            ->get()->toArray();
    }

    public function totalContracted(int $lending)
    {
        return DB::table('lendings')
            ->where('id', $lending)
            ->sum('value_lending');
    }

    public function totalContractedInterest(int $lending)
    {
        return DB::table('lending_installments')
            ->where('lending', $lending)
            ->sum('value_installment');
    }

    public function saveLeading(object $request)
    {
        try {

            $lending = new Lending;
            $lending->category = $request->input('category');
            $lending->company = $request->input('company');
            $lending->title = $request->input('title');
            $lending->reason = $request->input('reason');
            $lending->value_lending = $request->input('value_lending');
            $lending->interest = $request->input('interest');
            $lending->installments = $request->input('installments');
            $lending->quantity_installments = $request->input('quantity_installments');
            $lending->pay_date = $request->input('pay_date');

            $lending->save();
            return response()->json(['user' => $lending, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar usuário!'], 409);
        }
    }
}
