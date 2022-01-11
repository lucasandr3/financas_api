<?php

namespace App\Helpers;

class Constants
{
    // comparacao
    const ZERO = 0;

    // parcelamento
    const PARCELADO = 1;
    const SEM_PARCELA = 0;
    const PARCELADO_STRING = 'Parcelado';
    const SEM_PARCELA_STRING = 'Pagamento único';

    // dados iniciais clientes
    const SEM_RESTRICAO = 1;
    const SCORE = 3;

    //hotmart
    const API_SANDBOX = 'https://sandbox.hotmart.com/payments/api/v1';
    const API_PRODUCAO = 'https://developers.hotmart.com/payments/api/v1';
}
