<?php

namespace App\Http\Interfaces\Services\Modules\Hotmart;

interface WebhookServiceInterface
{
    public function cancelamentoAssinatura();

    public function trocaPlano();

    public function carrinhoAbandonado();

    public function eventoPedidos();
}
