<?php

namespace App\Http\Interfaces\Services;

interface LendingsServiceInterface
{
    public function allLendings();

    public function getLending(int $lending);

    public function getExpenses(int $spending);

    public function newLending(object $request);

    public function newExpenseSpending(object $resquest);

    public function getTotalSpendingExpensesByCategory(int $spending);
}
