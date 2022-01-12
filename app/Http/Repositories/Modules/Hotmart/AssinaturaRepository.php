<?php

namespace App\Http\Repositories\Modules\Hotmart;

use App\Helpers\ApiServiceHotmart;
use App\Http\Interfaces\Repositories\Modules\Hotmart\AssinaturaRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AssinaturaRepository implements AssinaturaRepositoryInterface
{

    private $api;

    public function __construct(ApiServiceHotmart $api)
    {
        $this->api = $api;
    }

    public function getAssinaturas()
    {
        $assinaturas = $this->api->get('/subscriptions');
        if(isset($compras->code)) {
            return $compras;
        }
        return json_decode($assinaturas);
    }

    public function getComprasAssinantes($assinante)
    {
        $compras = $this->api->get('/subscriptions/'.$assinante.'/purchases');

        if(isset($compras->code)) {
            return $compras;
        }
        return json_decode($compras);
    }

    public function cancelarAssinaturaUpdate($assinante)
    {
        $retorno = $this->api->post('/subscriptions/'.$assinante.'/cancel');

        if(isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function cancelarListaAssinaturasUpdate()
    {
        // TODO: Implement cancelarListaAssinaturasUpdate() method.
    }

    public function reativarCobrarAssinaturaUpdate()
    {
        // TODO: Implement reativarCobrarAssinaturaUpdate() method.
    }

    public function reativarCobrarListaAssinaturaUpdate()
    {
        // TODO: Implement reativarCobrarListaAssinaturaUpdate() method.
    }

    public function alterarDiaCobrancaUpdate()
    {
        // TODO: Implement alterarDiaCobrancaUpdate() method.
    }
}
