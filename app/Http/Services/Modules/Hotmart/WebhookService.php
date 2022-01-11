<?php

namespace App\Http\Services\Modules\Hotmart;

use App\Http\Interfaces\Repositories\Modules\Hotmart\WebhookRepositoryInterface;
use App\Http\Interfaces\Services\Modules\Hotmart\WebhookServiceInterface;
use Illuminate\Support\Facades\Validator;

class WebhookService implements WebhookServiceInterface
{
    private $repository;

    public function __construct
    (
        WebhookRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function cancelamentoAssinatura()
    {
        // TODO: Implement cancelamentoAssinatura() method.
    }

    public function trocaPlano()
    {
        // TODO: Implement trocaPlano() method.
    }

    public function carrinhoAbandonado()
    {
        // TODO: Implement carrinhoAbandonado() method.
    }

    public function eventoPedidos()
    {
        // TODO: Implement eventoPedidos() method.
    }
}
