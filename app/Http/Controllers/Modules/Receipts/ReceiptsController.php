<?php

namespace App\Http\Controllers\Modules\Receipts;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Modules\Receipts\ReceiptsServiceInterface;
use Illuminate\Http\Request;

class ReceiptsController extends Controller
{
    private $service;

    public function __construct
    (
        ReceiptsServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function receipts()
    {
        return $this->service->allReceitps();
    }

    public function cardById(Request $request, int $card)
    {
        return $this->service->getCard($card);
    }

    public function cardExpenses(Request $request, int $card)
    {
        return $this->service->getExpenses($card);
    }

    public function newCard(Request $request)
    {
        return $this->service->newCard($request);
    }

    public function editCard(Request $request, int $card)
    {
        return $this->service->editCard($request, $card);
    }
}
