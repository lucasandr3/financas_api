<?php

namespace App\Http\Services;

use App\Http\Interfaces\Repositories\SuggestionRepositoryInterface;
use App\Http\Interfaces\Services\SuggestionServiceInterface;
use Illuminate\Support\Facades\Validator;

class SuggestionService implements SuggestionServiceInterface
{
    private $repository;

    public function __construct
    (
        SuggestionRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function allSuggestions()
    {
        $suggestions = $this->repository->allSuggestions();
        return response()->json($suggestions, 201);
    }

    public function getSuggestion(int $suggestion)
    {
        $suggestionObj = $this->repository->getCategoryById($suggestion);

        if (!sizeof($suggestionObj) > 0) {
            return ['code' => 204, 'message' => 'Sugestão não existe.'];
        }

        return response()->json($suggestionObj, 201);
    }

    public function newSuggestion(object $resquest)
    {
        $validator = Validator::make($resquest->all(), [
            'user_id' => 'required',
            'category_suggestion' => 'required',
            'title' => 'required|string',
            'suggestion' => 'required|string'
        ]);

        if (!$validator->fails()) {

            $response = $this->repository->saveSuggestion($resquest);

            if ($response) {
                return response()->json(['message' => 'Sugestão salva com sucesso!'], 201);
            } else {
                return response()->json(['message' => 'Erro ao cadastrar Sugestão!'], 500);
            }

        } else {
            return response()->json(['error' => $validator->errors()], 500);
        }
    }
}
