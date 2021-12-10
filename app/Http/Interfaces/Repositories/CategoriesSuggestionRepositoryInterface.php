<?php

namespace App\Http\Interfaces\Repositories;

interface CategoriesSuggestionRepositoryInterface
{
    public function getAllCards();

    public function getCardById(int $card);

    public function saveCategory(object $request);

    public function getInstallmentsByCard(int $card);

    public function getTotalExpensesByCard(int $card);

    public function getLimitByCard(int $card);

    public function getExpensesByCard(int $card);

    public function getInstallmentsByCardExpense(int $expense);

    public function saveExpenseWithInstallment(array $expense);

    public function saveExpense(array $expense);
}
