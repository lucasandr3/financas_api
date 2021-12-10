<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\CategoriesSuggestionRepositoryInterface;
use App\Models\Card;
use App\Models\CategorySuggestion;
use Illuminate\Support\Facades\DB;

class CategoriesSuggestionRepository implements CategoriesSuggestionRepositoryInterface
{

    public function getAllcategories()
    {
        return CategorySuggestion::all();
    }

    public function getCategoryById(int $category)
    {
        return DB::table('categories_suggestion')
            ->where('id', $category)
            ->get();
    }

    public function saveCategory(object $request)
    {
        try {

            $category = new CategorySuggestion;
            $category->name = $request->input('name');

            $category->save();
            return response()->json(['user' => $category, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar categoria!'], 409);
        }
    }
}
