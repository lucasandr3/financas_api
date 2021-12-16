<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\SpendingTargetServiceInterface;
use Illuminate\Http\Request;

class SpendingTargetController extends Controller
{
    private $service;

    public function __construct
    (
        SpendingTargetServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function spendingsTargets()
    {
       return $this->service->allSpendingsTargets();
    }

    public function spendingTargetById(Request $request, int $spending)
    {
        return $this->service->getSpendingTarget($spending);
    }

    public function newSpendingTarget(Request $request)
    {
        return $this->service->newSpendingTarget($request);
    }
}
