<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\RevenueServiceInterface;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    private $service;

    public function __construct
    (
        RevenueServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function revenues()
    {
       return $this->service->allRevenues();
    }

    public function revenueById(Request $request, int $revenue)
    {
        return $this->service->getRevenue($revenue);
    }

    public function installments(Request $request, int $revenue)
    {
        return $this->service->getInstallments($revenue);
    }

    public function newRevenue(Request $request)
    {
        return $this->service->newRevenue($request->all());
    }
}
