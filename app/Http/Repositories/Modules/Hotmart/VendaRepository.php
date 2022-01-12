<?php

namespace App\Http\Repositories\Modules\Hotmart;

use App\Helpers\ApiServiceHotmart;
use App\Http\Interfaces\Repositories\Modules\Hotmart\VendaRepositoryInterface;
use Illuminate\Support\Facades\DB;

class VendaRepository implements VendaRepositoryInterface
{
    private $api;

    public function __construct(ApiServiceHotmart $api)
    {
        $this->api = $api;
    }

    public function getHistoricoVendas()
    {
        $retorno = $this->api->get('/sales/history');
        if (isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function getSumarioVendas()
    {
        $retorno = $this->api->get('/sales/summary');
        if (isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function getParticipantesVendas()
    {
        $retorno = $this->api->get('/sales/users');
        if (isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function getComissaoVendas()
    {
        $retorno = $this->api->get('/sales/commission');
        if (isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function getDetalhesPrecosVendas()
    {
        $retorno = $this->api->get('/sales/price/details');
        if (isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }
}
