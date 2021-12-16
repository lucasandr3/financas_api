<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\RevenueRepositoryInterface;
use App\Http\Interfaces\Services\RevenueServiceInterface;
use Illuminate\Support\Facades\Validator;

class RevenueService implements RevenueServiceInterface
{
    private $repository;

    public function __construct(RevenueRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allRevenues()
    {
        $revenues = $this->repository->getAllRevenues();

        $revenues = array_map(function($revenue) {
            $revenue->value = Helpers::formatMoney($revenue->value);
            $revenue->installments = ($revenue->installments === 0) ? 'Recebimento único' : 'Parcelado';
            $revenue->installments_object = ($revenue->installments !== 0) ? $this->getInstallmentsAll($revenue->id) : null;
            $revenue->photo = ($revenue->photo) ? url('storage/' . $revenue->photo) : null;
            return $revenue;
        }, $revenues);

        return $revenues;
    }

    public function getRevenue(int $revenue)
    {
        $revenueObject = $this->repository->getRevenueById($revenue);

        if(!sizeof($revenueObject) > 0) {
            return ['code' => 204, 'message' => 'Receita não existe, verifique se o valor que está passando está correto'];
        }


        if($revenueObject[0]->installments === 0) {

            $revenueObject = array_map(function($revenueObj) {
                $revenueObj->value = Helpers::formatMoney($revenueObj->value);
                $revenueObj->installments = ($revenueObj->installments === 0) ? 'Recebimento único' : 'Parcelado';
                return $revenueObj;
            }, $revenueObject);

        } else {

            $installments = $this->getInstallments($revenue);

            $revenueObject = array_map(function($revenueObj) use ($installments) {
                $revenueObj->value = Helpers::formatMoney($revenueObj->value);
                $revenueObj->installments = ($revenueObj->installments === 0) ? 'Recebimento único' : 'Parcelado';
                $revenueObj->installments_object = $installments['installments'];
                return $revenueObj;
            }, $revenueObject);

        }

        return ['code' => 200, 'revenue' => $revenueObject];
    }

    public function getInstallments(int $revenue)
    {
        $installments = $this->repository->getInstallmentsByRevenue($revenue);

        if(!sizeof($installments) > 0) {
            return ['code' => 200, 'message' => 'Receita não possui parcelamentos'];
        }

        $installments = array_map(function($installment) {
            $installment->installment = $installment->installment.'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_revenue = Helpers::formatMoney($installment->total_revenue);
            return $installment;
        }, $installments);

        return ['code' => 200, 'installments' => $installments];
    }

    private function getInstallmentsAll(int $revenue)
    {
        $installments = $this->repository->getInstallmentsByRevenue($revenue);

        if(!sizeof($installments) > 0) {
            return [];
        }

        $installments = array_map(function($installment) {
            $installment->installment = $installment->installment.'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_revenue = Helpers::formatMoney($installment->total_revenue);
            return $installment;
        }, $installments);

        return $installments;
    }

    public function newRevenue(object $request)
    {
        $validator = Validator::make($request->all(), [
            'id_category' => 'required|int',
            'title' => 'required|string',
            'value' => 'required',
            'photo' => 'file|mimes:jpg,png'
        ]);

        if(!$validator->fails()) {

            if($request->file('photo')) {
                $file = $request->file('photo')->store('public');
                $fileName = explode('public/', $file);
                return $this->repository->saveRevenue($request, $fileName);
            } else {
                return $this->repository->saveRevenue($request, '');
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }

    public function deleteRevenue(int $revenue)
    {
        $revenueObject = $this->repository->getRevenueById($revenue);

        if(!sizeof($revenueObject) > 0) {
            return response()->json(['message' => 'Oopss, Receita não existe!!'], 200);
        }

        return $this->repository->delRevenue($revenue);
    }

    public function editRevenue(object $request, int $revenue)
    {
        $revenueObject = $this->repository->getRevenueById($revenue);

        if(!sizeof($revenueObject) > 0) {
            return response()->json(['message' => 'Oopss, Receita não existe!!'], 200);
        }

        $validator = Validator::make($request->all(), [
            'id_category' => 'required|int',
            'title' => 'required|string',
            'value' => 'required',
            'photo' => 'file|mimes:jpg,png'
        ]);

        if(!$validator->fails()) {

            if($request->file('photo')) {
                $file = $request->file('photo')->store('public');
                $fileName = explode('public/', $file);
                return $this->repository->editRevenue($revenue, $request, $fileName);
            } else {
                return $this->repository->editRevenue($revenue, $request, 'null');
            }

        } else {
            return response()->json(['message' => $validator->errors()], 200);
        }
    }
}
