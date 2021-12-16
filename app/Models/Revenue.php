<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $table = "revenues";
    protected $fillable = ['*'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->user_id = auth()->user()->getAuthIdentifier();
        });

        static::retrieved(function($model) {
            $model->user_id = auth()->user()->getAuthIdentifier();
        });
    }
}
