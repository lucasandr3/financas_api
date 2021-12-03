<?php

namespace App\Http\Interfaces\Repositories;

interface EventRevenueRepositoryInterface
{
    public function getAllRevenues();

    public function getRevenueById(int $revenue);

    public function getInstallmentsByRevenue(int $revenue);

    public function saveRevenue(array $revenue);
}
