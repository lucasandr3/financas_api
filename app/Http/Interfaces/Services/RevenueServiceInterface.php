<?php

namespace App\Http\Interfaces\Services;

interface RevenueServiceInterface
{
    public function allRevenues();

    public function getRevenue(int $revenue);

    public function getInstallments(int $revenue);

    public function newRevenue(object $resquest);
}
