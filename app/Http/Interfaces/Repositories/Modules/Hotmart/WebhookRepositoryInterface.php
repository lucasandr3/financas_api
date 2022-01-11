<?php

namespace App\Http\Interfaces\Repositories\Modules\Hotmart;

interface WebhookRepositoryInterface
{
    public function addCancelamentoAssinatura();

    public function addTrocaPlano();

    public function addCarrinhoAbandonado();

    public function addEventoPedidos();
}
