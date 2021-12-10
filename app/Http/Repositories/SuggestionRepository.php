<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\SuggestionRepositoryInterface;
use App\Models\Suggestion;
use App\Models\CategorySuggestion;
use Illuminate\Support\Facades\DB;

class SuggestionRepository implements SuggestionRepositoryInterface
{

    public function allSuggestions()
    {
        return Suggestion::all();
    }

    public function getSuggestion(int $sugestion)
    {
        return DB::table('suggestions')
            ->where('id', $sugestion)
            ->get();
    }

    public function saveSuggestion(object $request)
    {
        try {

            $sugestion = new Suggestion;
            $sugestion->user_id = $request->input('user_id');
            $sugestion->category_suggestion = $request->input('category_suggestion');
            $sugestion->title = $request->input('title');
            $sugestion->suggestion = $request->input('suggestion');
            $sugestion->date_suggestion = date('Y-m-d');

            $sugestion->save();
            return response()->json(['user' => $sugestion, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar sugestão!'], 409);
        }
    }
}
