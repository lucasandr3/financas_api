<?php

namespace App\Http\Interfaces\Services;

interface CardsServiceInterface
{
    public function allCards();

    public function getSpending(int $spending);

    public function getExpenses(int $spending);

    public function newCard(object $resquest);

    public function newExpenseSpending(object $resquest);

    public function getTotalSpendingExpensesByCategory(int $spending);
}
