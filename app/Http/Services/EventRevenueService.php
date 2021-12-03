<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\EventRevenueRepositoryInterface;
use App\Http\Interfaces\Services\EventRevenueServiceInterface;
use Illuminate\Support\Facades\Validator;

class EventRevenueService implements EventRevenueServiceInterface
{
    private $repository;

    public function __construct(EventRevenueRepositoryInterface $repository)
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

    public function newRevenue(array $resquest)
    {
        $validator = Validator::make($resquest, [
            'company' => 'required',
            'id_category' => 'required|int',
            'title' => 'required|string',
            'value' => 'required',
        ]);

        if(!$validator->fails()) {

            $newRevenue = [
                'company' => $resquest['company'],
                'id_category' => $resquest['id_category'],
                'title' => $resquest['title'],
                'description' => $resquest['description'],
                'value' => $resquest['value'],
                'installments' => $resquest['installments'],
                'quantity_installments' => $resquest['quantity_installments']
            ];

            $response = $this->repository->saveRevenue($newRevenue);

            if($response) {
                return ['code' => 200, 'message' => 'Receita salva com sucesso!'];
            } else {
                return ['code' => 500, 'message' => 'Erro ao salvar receita!!!'];
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }
}
