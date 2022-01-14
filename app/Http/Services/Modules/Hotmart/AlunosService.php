<?php

namespace App\Http\Services\Modules\Hotmart;

use App\Http\Interfaces\Repositories\Modules\Hotmart\AlunosRepositoryInterface;
use App\Http\Interfaces\Services\Modules\Hotmart\AlunosServiceInterface;
use Illuminate\Support\Facades\Validator;

class AlunosService implements AlunosServiceInterface
{
    private $repository;

    public function __construct
    (
        AlunosRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function modulos($subDomain)
    {
        // subDomain = my_subdomain
        $modulos = $this->repository->getModulos($subDomain);

    }

    public function paginas($modulo)
    {
        // subDomain = my_subdomain
        // modulos = 2Z7RAMXEJW | D64L09Q4JW | DPEA5MOEWE | J14OKVB4PL | V94JMXYOGZ
        $paginas = $this->repository->getPaginas($modulo);

    }

    public function alunos($subDomain)
    {
        // subDomain = my_subdomain
        $alunos = $this->repository->getAlunos($subDomain);

    }

    public function progresso($aluno, $subDomain)
    {
        // subDomain = my_subdomain
        // alunos = N2OM623N46 | WX7WPWRQO2 | ZYOMWXLDED
        $progresso = $this->repository->getProgresso($aluno, $subDomain);

    }
}
