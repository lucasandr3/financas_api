<?php

namespace App\Http\Interfaces\Repositories\Modules\Hotmart;

interface AssinaturaRepositoryInterface
{
    public function getAssinaturas();

    public function getComprasAssinantes();

    public function cancelarAssinaturaUpdate();

    public function cancelarListaAssinaturasUpdate();

    public function reativarCobrarAssinaturaUpdate();

    public function reativarCobrarListaAssinaturaUpdate();

    public function alterarDiaCobrancaUpdate();
}
