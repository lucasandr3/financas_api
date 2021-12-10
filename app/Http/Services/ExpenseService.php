<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\ExpenseRepositoryInterface;
use App\Http\Interfaces\Services\ExpenseServiceInterface;
use Illuminate\Support\Facades\Validator;

class ExpenseService implements ExpenseServiceInterface
{
    private $repository;

    public function __construct(ExpenseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allExpenses()
    {
        $expenses = $this->repository->getAllExpenses();

        $expenses = array_map(function($expense) {
            $expense->value = Helpers::formatMoney($expense->value);
            $expense->installments = ($expense->installments === 0) ? 'Pagamento único' : 'Parcelado';
            $expense->installments_object = ($expense->installments !== 0) ? $this->getInstallmentsAll($expense->id) : null;
            $expense->photo = ($expense->photo) ? url('storage/' . $expense->photo) : null;
            return $expense;
        }, $expenses);

        return $expenses;
    }

    public function getExpense(int $expense)
    {
        $expenseObject = $this->repository->getExpenseById($expense);

        if(!sizeof($expenseObject) > 0) {
            return ['code' => 204, 'message' => 'Despesa não existe, verifique se o valor que está passando está correto'];
        }


        if($expenseObject[0]->installments === 0) {

            $expenseObject = array_map(function($expenseObj) {
                $expenseObj->value = Helpers::formatMoney($expenseObj->value);
                $expenseObj->installments = ($expenseObj->installments === 0) ? 'Pagamento único' : 'Parcelado';
                return $expenseObj;
            }, $expenseObject);

        } else {

            $installments = $this->getInstallments($expense);

            $expenseObject = array_map(function($expenseObj) use ($installments) {
                $expenseObj->value = Helpers::formatMoney($expenseObj->value);
                $expenseObj->installments = ($expenseObj->installments === 0) ? 'Pagamento único' : 'Parcelado';
                $expenseObj->installments_object = $installments['installments'];
                return $expenseObj;
            }, $expenseObject);

        }

        return ['code' => 200, 'expense' => $expenseObject];
    }

    public function getInstallments(int $expense)
    {
        $installments = $this->repository->getInstallmentsByExpense($expense);

        if(!sizeof($installments) > 0) {
            return ['code' => 200, 'message' => 'Despesa não possui parcelamentos'];
        }

        $installments = array_map(function($installment) {
            $installment->installment = $installment->installment.'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_expense = Helpers::formatMoney($installment->total_expense);
            return $installment;
        }, $installments);

        return ['code' => 200, 'installments' => $installments];
    }

    private function getInstallmentsAll(int $expense)
    {
        $installments = $this->repository->getInstallmentsByExpense($expense);

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

    public function newExpense(object $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required',
            'id_category' => 'required|int',
            'title' => 'required|string',
            'value' => 'required',
            'photo' => 'required|file|mimes:jpg,png'
        ]);

        if(!$validator->fails()) {

            if($request->file('photo')) {
                $file = $request->file('photo')->store('public');
                $nameFile = explode('public/', $file);
            }

            $newExpense = [
                'company' => $resquest['company'],
                'id_category_expense' => $resquest['id_category'],
                'title' => $resquest['title'],
                'description' => $resquest['description'],
                'value' => $resquest['value'],
                'installments' => $resquest['installments'],
                'quantity_installments' => $resquest['quantity_installments'],
                'photo' => isset($nameFile[1]) ?? ''
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

    public function getExpenseByCategory(int $category)
    {
        $expenses = $this->repository->getExpenseByCategory($category);

        $expenses = array_map(function($expense) {
            $expense->value = Helpers::formatMoney($expense->value);
            $expense->installments = ($expense->installments === 0) ? 'Pagamento único' : 'Parcelado';
            $expense->installments_object = ($expense->installments !== 0) ? $this->getInstallmentsAll($expense->id) : null;
            return $expense;
        }, $expenses);

        return $expenses;
    }

    public function getTotalExpensesByCategory(int $category)
    {
        return $this->repository->getTotalExpensesByCategory($category);
    }
}
