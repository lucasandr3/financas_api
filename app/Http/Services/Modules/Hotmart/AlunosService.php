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

    public function modulos()
    {
        // TODO: Implement modulos() method.
    }

    public function paginas()
    {
        // TODO: Implement paginas() method.
    }

    public function alunos()
    {
        // TODO: Implement alunos() method.
    }

    public function progresso()
    {
        // TODO: Implement progresso() method.
    }
}
