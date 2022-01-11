<?php

namespace App\Http\Interfaces\Services\Modules\Reports;

interface ReportsServiceInterface
{
    public function allReceitps();

    public function getCard(int $card);

    public function getExpenses(int $card);

    public function newCard(object $resquest);

    public function editCard(object $resquest, int $card);
}
