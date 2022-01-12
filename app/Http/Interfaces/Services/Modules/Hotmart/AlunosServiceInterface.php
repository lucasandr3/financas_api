<?php

namespace App\Http\Interfaces\Services\Modules\Hotmart;

interface AlunosServiceInterface
{
    public function modulos($subDomain);

    public function paginas($modulo);

    public function alunos($subDomain);

    public function progresso($aluno, $subDomain);
}
