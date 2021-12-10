<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\LendingsServiceInterface;
use Illuminate\Http\Request;

class LendingsController extends Controller
{
    private $service;

    public function __construct
    (
        LendingsServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function myLendings()
    {
       return $this->service->allLendings();
    }

    public function lendingById(Request $request, int $lending)
    {
        return $this->service->getLending($lending);
    }

    public function lendingInstallments(Request $request, int $lending)
    {
        return $this->service->getInstallments($lending);
    }

    public function newLending(Request $request)
    {
        return $this->service->newLending($request);
    }
}
