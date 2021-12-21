<?php

namespace App\Http\Interfaces\Repositories\Modules\Receipts;

interface ReceiptsRepositoryInterface
{
    public function allReceipts();

    public function getCardById(int $card);

    public function saveCard(object $request);

    public function updateCard(object $request, int $card);

    public function getInstallmentsByCard(int $card);

    public function getTotalExpensesByCard(int $card);

    public function getLimitByCard(int $card);

    public function getExpensesByCard(int $card);

    public function getInstallmentsByCardExpense(int $expense);

    public function saveExpenseWithInstallment(array $expense);

    public function saveExpense(array $expense);
}
