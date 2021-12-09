<?php

namespace App\Http\Interfaces\Services;

interface CardsServiceInterface
{
    public function allSpendings();

    public function getSpending(int $spending);

    public function getExpenses(int $spending);

    public function newSpending(array $resquest);

    public function newExpenseSpending(object $resquest);

    public function getTotalSpendingExpensesByCategory(int $spending);
}
