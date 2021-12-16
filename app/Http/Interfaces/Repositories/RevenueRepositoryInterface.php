<?php

namespace App\Http\Interfaces\Repositories;

interface RevenueRepositoryInterface
{
    public function getAllRevenues();

    public function getRevenueById(int $revenue);

    public function getInstallmentsByRevenue(int $revenue);

    public function saveRevenue(object $revenue, string $fileName);

    public function saveInstallmentsRevenue($newRevenue);

    public function delRevenue(int $revenue);
}
