<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\LendingsRepositoryInterface;
use App\Http\Interfaces\Services\ExpenseServiceInterface;
use App\Http\Interfaces\Services\LendingsServiceInterface;
use Illuminate\Support\Facades\Validator;

class LendingsService implements LendingsServiceInterface
{
    private $repository;
    private $expenseService;

    public function __construct
    (
        LendingsRepositoryInterface $repository,
        ExpenseServiceInterface $expenseService
    )
    {
        $this->repository = $repository;
        $this->expenseService = $expenseService;
    }

    public function allLendings()
    {
        $lendings = $this->repository->getAllLendings();

        $lendings = array_map(function($lending) {
            $lending->value_lending = Helpers::formatMoney($lending->value_lending);
            $lending->interest = Helpers::formatInterest($lending->interest);
            $lending->pay_date = Helpers::formatDateSimple($lending->pay_date);
            $lending->installments = ($lending->installments === 0) ? 'Pagamento único' : 'Parcelado';
            return $lending;
        }, $lendings);

        return response()->json($lendings, 201);
    }

    public function getLending(int $lending)
    {
        $lendingObject = $this->repository->getLendingById($lending);

        if(!sizeof($lendingObject) > 0) {
            return ['code' => 204, 'message' => 'Empréstimo não existe.'];
        }

        $installmentsLending = $this->getInstallments($lending);
        $totalContracted = $this->repository->totalContracted($lending);
        $totalContractedInterest = $this->repository->totalContractedInterest($lending);

        $totais = [
            'totalContracted' => Helpers::formatMoney($totalContracted),
            'totalContractedInterest' => Helpers::formatMoney($totalContractedInterest)
        ];

        $lendingObject = array_map(function($lendingObj) use ($installmentsLending, $totais) {
            $lendingObj->value_lending = Helpers::formatMoney($lendingObj->value_lending);
            $lendingObj->interest = Helpers::formatInterest($lendingObj->interest);
            $lendingObj->pay_date = Helpers::formatDateSimple($lendingObj->pay_date);
            $lendingObj->installments = ($lendingObj->installments === 0) ? 'Pagamento único' : 'Parcelado';
            $lendingObj->installments_object = $installmentsLending;
            $lendingObj->totais = $totais;
            return $lendingObj;
        }, $lendingObject);

        return response()->json($lendingObject, 201);
    }

    public function getInstallments(int $lending)
    {
        $installments = $this->repository->getInstallmentsByLending($lending);

        if(!sizeof($installments) > 0) {
            return ['code' => 200, 'message' => 'Empréstimo não possui parcelamentos'];
            die;
        }

        $installments = array_map(function($installment) {
            $installment->installment = $installment->installment.'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            return $installment;
        }, $installments);

        return ['code' => 200, 'installments' => $installments];
    }

    public function getExpenses(int $spending)
    {
        $spendingObject = $this->repository->getSpendingById($spending);

        if (sizeof($spendingObject) === 0) {
            return ['code' => 204, 'message' => 'Limite de gastos não existe.'];
        }

        $expenses = $this->getExpensesBySpending($spendingObject[0]->id);
        return ['code' => 200, 'expenses' => $expenses];
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

        if(!$validator->fails()) {

            $response = $this->repository->saveLeading($request);

            if($response) {
                return response()->json(['message' => 'Empréstimo salvo com sucesso!'], 201);
            } else {
                return response()->json(['message' => 'Erro ao cadastrar Empréstimo!'], 500);
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }

    public function getTotalSpendingExpensesByCategory(int $spending)
    {
        return $this->repository->getTotalExpensesBySpending($spending);
    }

    public function getExpensesBySpending(int $spending)
    {
        $expenses = $this->repository->getExpensesBySpending($spending);

        $expenses = array_map(function($expense) {
            $expense->value = Helpers::formatMoney($expense->value);
            $expense->installments = ($expense->installments === 0) ? 'Pagamento único' : 'Parcelado';
            $expense->installments_object = ($expense->installments !== 0) ? $this->getInstallmentsBySpendingExpense($expense->id) : null;
            $expense->photo = ($expense->photo) ? url('storage/' . $expense->photo) : null;
            return $expense;
        }, $expenses);

        return $expenses;
    }

    private function getInstallmentsBySpendingExpense(int $category)
    {
        $installments = $this->repository->getInstallmentsBySpendingExpense($category);

        if(!sizeof($installments) > 0) {
            return [];
        }

        $installments = array_map(function($installment) {
            $installment->installment = $installment->installment.'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_expense = Helpers::formatMoney($installment->total_expense);
            return $installment;
        }, $installments);

        return $installments;
    }

    public function newExpenseSpending(object $resquest)
    {
        $validator = Validator::make($resquest->all(), [
            'spending' => 'required',
            'id_category' => 'required|int',
            'title' => 'required|string',
            'value' => 'required',
            'photo' => 'required|file|mimes:jpg,png'
        ]);

        if(!$validator->fails()) {

            $file = $resquest->file('photo')->store('public');
            $nameFile = explode('public/', $file);

            $newExpense = [
                'spending' => $resquest['spending'],
                'category' => $resquest['id_category'],
                'title' => $resquest['title'],
                'description' => $resquest['description'],
                'value' => $resquest['value'],
                'installments' => $resquest['installments'],
                'quantity_installments' => $resquest['quantity_installments'],
                'photo' => $nameFile[1],
                'date_spending_expense' => $resquest['date_spending_expense']
            ];

            if($newExpense['installments'] == 1) {
                $response = $this->repository->saveExpenseWithInstallment($newExpense);
            } else {
                $response = $this->repository->saveExpense($newExpense);
            }

            if($response) {
                return ['code' => 200, 'message' => 'Despesa salva com sucesso!'];
            } else {
                return ['code' => 500, 'message' => 'Erro ao salvar despesa!!!'];
            }

        } else {
            return ['error' => $validator->errors()];
        }
    }
}
