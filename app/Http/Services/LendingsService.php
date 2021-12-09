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

    public function allSpendings()
    {
        $spendings = $this->repository->getAllSpendings();

        $spendings = array_map(function($spending) {
            $spending->limit_value = Helpers::formatMoney($spending->limit_value);
            $spending->percent_alert = $spending->percent_alert . "%";
            $spending->final_date_spending = Helpers::formatDateSimple($spending->final_date_spending);
            $spending->total_spending_expenses = Helpers::formatMoney($this->getTotalSpendingExpensesByCategory($spending->id));
            $spending->spending_expenses = $this->getExpensesBySpending($spending->id);
            return $spending;
        }, $spendings);

        return $spendings;
    }

    public function getSpending(int $spending)
    {
        $spendingObject = $this->repository->getSpendingById($spending);

        if(!sizeof($spendingObject) > 0) {
            return ['code' => 204, 'message' => 'Limite de gastos não existe.'];
        }

        $spendingObject = array_map(function($spendingObj) {
            $spendingObj->limit_value = Helpers::formatMoney($spendingObj->limit_value);
            $spendingObj->percent_alert = $spendingObj->percent_alert . "%";
            $spendingObj->final_date_spending = Helpers::formatDateSimple($spendingObj->final_date_spending);
            $spendingObj->total_spending_expenses = Helpers::formatMoney($this->getTotalSpendingExpensesByCategory($spendingObj->id));
            $spendingObj->spending_expenses = $this->getExpensesBySpending($spendingObj->id);
            return $spendingObj;
        }, $spendingObject);

        return ['code' => 200, 'spending' => $spendingObject];
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

    public function newSpending(array $resquest)
    {
        $validator = Validator::make($resquest, [
            'limit_value' => 'required',
            'percent_alert' => 'required',
            'final_date' => 'required'
        ]);

        if(!$validator->fails()) {

            $newSpending = [
                'limit_value' => $resquest['limit_value'],
                'percent_alert' => $resquest['percent_alert'],
                'final_date_spending' => $resquest['final_date']
            ];

            $response = $this->repository->saveSpending($newSpending);

            if($response) {
                return ['code' => 200, 'message' => 'Limite de gastos salvo com sucesso!'];
            } else {
                return ['code' => 500, 'message' => 'Erro ao salvar limite de gastos!!!'];
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
