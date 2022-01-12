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

    public function comprasAssinantes()
    {
        return $this->service->comprasAssinantes();
    }

    public function cancelarAssinatura()
    {
        return $this->service->cancelarAssinatura();
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
