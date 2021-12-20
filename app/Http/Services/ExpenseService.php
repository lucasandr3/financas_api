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
            $expense->photo = ($expense->photo) ? url('storage/' . $expense->photo) : null;
            $expense->date = Helpers::formatDateSimple($expense->date_expense);
            $expense->hour = Helpers::Hour($expense->date_expense);
            $expense->date_expense = Helpers::formatDateHour($expense->date_expense);
            $expense->installments_object = ($expense->installments !== 0) ? $this->getInstallmentsAll($expense->id) : null;
            return $expense;
        }, $expenses);

        $expensesByMounth = Helpers::groupByMonth($expenses);

        return response()->json(['expenses' => $expensesByMounth], 200);
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
                $expenseObj->date = Helpers::formatDateSimple($expenseObj->date_expense);
                $expenseObj->hour = Helpers::Hour($expenseObj->date_expense);
                $expenseObj->date_expense = Helpers::formatDateHour($expenseObj->date_expense);
                $expenseObj->installments = ($expenseObj->installments === 0) ? 'Pagamento único' : 'Parcelado';
                return $expenseObj;
            }, $expenseObject);

        } else {

            $installments = $this->getInstallments($expense);

            $expenseObject = array_map(function($expenseObj) use ($installments) {
                $expenseObj->value = Helpers::formatMoney($expenseObj->value);
                $expenseObj->installments = ($expenseObj->installments === 0) ? 'Pagamento único' : 'Parcelado';
                $expenseObj->date = Helpers::formatDateSimple($expenseObj->date_expense);
                $expenseObj->hour = Helpers::Hour($expenseObj->date_expense);
                $expenseObj->date_expense = Helpers::formatDateHour($expenseObj->date_expense);
                $expenseObj->installments_object = $installments['installments'];
                return $expenseObj;
            }, $expenseObject);

        }

        return response(['expense' => $expenseObject], 200);
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
            'id_category' => 'required|int',
            'title' => 'required|string',
            'value' => 'required',
            'photo' => 'file|mimes:jpg,png'
        ]);

        if(!$validator->fails()) {

            if($request->file('photo')) {
                $file = $request->file('photo')->store('public');
                $fileName = explode('public/', $file);
                return $this->repository->saveExpense($request, $fileName);
            } else {
                return $this->repository->saveExpense($request, '');
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

    public function deleteExpense(int $expense)
    {
        $expenseObject = $this->repository->getExpenseById($expense);

        if(!sizeof($expenseObject) > 0) {
            return response()->json(['message' => 'Oopss, Despesa não existe!!'], 200);
        }

        return $this->repository->delExpense($expense);
    }

    public function editExpense(object $request, int $expense)
    {
        $expenseObject = $this->repository->getExpenseById($expense);

        if(!sizeof($expenseObject) > 0) {
            return response()->json(['message' => 'Oopss, Despesa não existe!!'], 200);
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
                return $this->repository->editExpense($expense, $request, $fileName);
            } else {
                return $this->repository->editExpense($expense, $request, 'null');
            }

        } else {
            return response()->json(['message' => $validator->errors()], 200);
        }
    }
}
