<?php

namespace App\Http\Controllers\Modules\Hotmart;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Modules\Hotmart\WebhookServiceInterface;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    private $service;

    public function __construct
    (
        WebhookServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function cancelamentoAssinatura()
    {
        $this->service->cancelamentoAssinatura();
    }

    public function trocaPlano()
    {
        $this->service->trocaPlano();
    }

    public function carrinhoAbandonado()
    {
        $this->service->carrinhoAbandonado();
    }

    public function eventoPedidos()
    {
        $this->service->eventoPedidos();
    }
}
