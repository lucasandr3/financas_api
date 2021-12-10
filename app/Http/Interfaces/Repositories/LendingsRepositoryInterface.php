<?php

namespace App\Http\Interfaces\Repositories;

interface LendingsRepositoryInterface
{
    public function getAllLendings();

    public function getLendingById(int $lending);

    public function getInstallmentsByLending(int $lending);

    public function totalContracted(int $lending);

    public function totalContractedInterest(int $lending);

    public function saveLeading(object $request);

    public function getTotalExpensesBySpending(int $spending);

    public function getExpensesBySpending(int $spending);

    public function getInstallmentsBySpendingExpense(int $category);

    public function saveExpenseWithInstallment(array $expense);

    public function saveExpense(array $expense);
}
