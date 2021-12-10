<?php

namespace App\Http\Services;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\LendingsRepositoryInterface;
use App\Http\Interfaces\Services\LendingsServiceInterface;
use Illuminate\Support\Facades\Validator;

class LendingsService implements LendingsServiceInterface
{
    private $repository;

    public function __construct
    (
        LendingsRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function allLendings()
    {
        $lendings = $this->repository->getAllLendings();

        $lendings = array_map(function ($lending) {
            $lending->value_lending = Helpers::formatMoney($lending->value_lending);
            $lending->interest = Helpers::formatInterest($lending->interest);
            $lending->pay_date = Helpers::formatDateSimple($lending->pay_date);
            $lending->installments = ($lending->installments === 0) ? 'Pagamento único' : 'Parcelado';

            $installmentsLending = $this->getInstallments($lending->id);

            if ($lending->installments != Constants::SEM_PARCELA_STRING) {
                $lending->installments_object = $installmentsLending;
            }

            $totalContracted = $this->repository->totalContracted($lending->id);
            $totalContractedInterest = $this->repository->totalContractedInterest($lending->id);

            $totals = [
                'totalContracted' => Helpers::formatMoney($totalContracted),
                'totalContractedInterest' => ($totalContractedInterest > Constants::ZERO)
                    ? Helpers::formatMoney($totalContractedInterest)
                    : Helpers::formatMoney($totalContracted)
            ];

            $lending->totals = $totals;

            return $lending;
        }, $lendings);

        return response()->json($lendings, 201);
    }

    public function getLending(int $lending)
    {
        $lendingObject = $this->repository->getLendingById($lending);

        if (!sizeof($lendingObject) > 0) {
            return ['code' => 204, 'message' => 'Empréstimo não existe.'];
        }

        $installmentsLending = $this->getInstallments($lending);
        $totalContracted = $this->repository->totalContracted($lending);
        $totalContractedInterest = $this->repository->totalContractedInterest($lending);

        $totals = [
            'totalContracted' => Helpers::formatMoney($totalContracted),
            'totalContractedInterest' => ($totalContractedInterest > Constants::ZERO)
                ? Helpers::formatMoney($totalContractedInterest)
                : Helpers::formatMoney($totalContracted)
        ];

        $lendingObject = array_map(function ($lendingObj) use ($installmentsLending, $totals) {
            $lendingObj->value_lending = Helpers::formatMoney($lendingObj->value_lending);
            $lendingObj->interest = Helpers::formatInterest($lendingObj->interest);
            $lendingObj->pay_date = Helpers::formatDateSimple($lendingObj->pay_date);
            $lendingObj->installments = ($lendingObj->installments === Constants::SEM_PARCELA) ? 'Pagamento único' : 'Parcelado';

            if ($lendingObj->installments != Constants::SEM_PARCELA_STRING) {
                $lendingObj->installments_object = $installmentsLending;
            }

            $lendingObj->totals = $totals;
            return $lendingObj;
        }, $lendingObject);

        return response()->json($lendingObject, 201);
    }

    public function getInstallments(int $lending)
    {
        $installments = $this->repository->getInstallmentsByLending($lending);

        if (!sizeof($installments) > 0) {
            return ['message' => 'Empréstimo não possui parcelamentos'];
        }

        $installments = array_map(function ($installment) {
            $installment->installment = $installment->installment . 'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            return $installment;
        }, $installments);

        return $installments;
    }

    public function newLending(object $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'company' => 'required|string',
            'title' => 'required|string',
            'reason' => 'string',
            'value_lending' => 'required'
        ]);

        if (!$validator->fails()) {

            $response = $this->repository->saveLeading($request);

            if ($response) {
                return response()->json(['message' => 'Empréstimo salvo com sucesso!'], 201);
            } else {
                return response()->json(['message' => 'Erro ao cadastrar Empréstimo!'], 500);
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }
}
