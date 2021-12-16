<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = "expenses";
    protected $fillable = ['*'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
//            $model->user_id = auth()->user()->getAuthIdentifier();
            $model->user_id = 1;
        });

        static::retrieved(function($model) {
            $model->user_id = auth()->user()->getAuthIdentifier();
        });
    }
}
