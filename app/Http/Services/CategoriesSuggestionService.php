<?php

namespace App\Http\Services;

use App\Http\Interfaces\Repositories\CategoriesSuggestionRepositoryInterface;
use App\Http\Interfaces\Services\CategoriesSuggestionServiceInterface;
use Illuminate\Support\Facades\Validator;

class CategoriesSuggestionService implements CategoriesSuggestionServiceInterface
{
    private $repository;

    public function __construct
    (
        CategoriesSuggestionRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function allCategories()
    {
        $categories = $this->repository->getAllcategories();
        return response()->json($categories, 201);
    }

    public function getCategory(int $category)
    {
        $categoryObj = $this->repository->getCategoryById($category);

        if (!sizeof($categoryObj) > 0) {
            return ['code' => 204, 'message' => 'Categoria não existe.'];
        }

        return response()->json($categoryObj, 201);
    }

    public function newCategory(object $resquest)
    {
        $validator = Validator::make($resquest->all(), [
            'name' => 'required|string',
        ]);

        if (!$validator->fails()) {

            $response = $this->repository->saveCategory($resquest);

            if ($response) {
                return response()->json(['message' => 'Categoria salvo com sucesso!'], 201);
            } else {
                return response()->json(['message' => 'Erro ao cadastrar Categoria!'], 500);
            }

        } else {
            return response()->json(['error' => $validator->errors()], 500);
        }
    }
}
