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
        $assinaturas = $this->api->get('/subscriptions?status=CANCELLED_BY_SELLER&status=ACTIVE');
        return json_decode($assinaturas);
    }

    public function getComprasAssinantes()
    {
        // TODO: Implement getComprasAssinantes() method.
    }

    public function cancelarAssinaturaUpdate()
    {
        // TODO: Implement cancelarAssinaturaUpdate() method.
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
