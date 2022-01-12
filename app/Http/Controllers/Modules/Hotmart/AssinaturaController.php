<?php

namespace App\Http\Controllers\Modules\Hotmart;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Modules\Hotmart\AssinaturaServiceInterface;

class AssinaturaController extends Controller
{
    private $service;

    public function __construct
    (
        AssinaturaServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function assinaturas()
    {
        return $this->service->assinaturas();
    }

    public function comprasAssinantes($assinante)
    {
        // id errado X53ZPFQZ
        // id certo B2HNQAXJ
        return $this->service->comprasAssinantes($assinante);
    }

    public function cancelarAssinatura($assinante)
    {
        // id errado X53ZPFQZ
        // id certo B2HNQAXJ
        return $this->service->cancelarAssinatura($assinante);
    }

    public function cancelarListaAssinaturas()
    {
        return $this->service->cancelarListaAssinaturas();
    }

    public function reativarCobrarAssinatura()
    {
        return $this->service->reativarCobrarAssinatura();
    }

    public function reativarCobrarListaAssinatura()
    {
        return $this->service->reativarCobrarListaAssinatura();
    }

    public function alterarDiaCobranca()
    {
        return $this->service->alterarDiaCobranca();
    }
}
