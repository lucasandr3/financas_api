<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueInstallments extends Model
{
    protected $table = "revenue_installments";
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
