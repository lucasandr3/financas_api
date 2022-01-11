<?php

namespace App\Http\Interfaces\Services\Modules\Hotmart;

interface AssinaturaServiceInterface
{
    public function assinaturas();

    public function comprasAssinantes();

    public function cancelarAssinatura();

    public function cancelarListaAssinaturas();

    public function reativarCobrarAssinatura();

    public function reativarCobrarListaAssinatura();

    public function alterarDiaCobranca();
}
