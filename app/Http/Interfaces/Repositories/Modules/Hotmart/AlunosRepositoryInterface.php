<?php

namespace App\Http\Interfaces\Repositories\Modules\Hotmart;

interface AlunosRepositoryInterface
{
    public function getModulos($subDomain);

    public function getPaginas($modulo);

    public function getAlunos($subDomain);

    public function getProgresso($aluno, $subDomain);
}
