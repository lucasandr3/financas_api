<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardInstallments extends Model
{
    protected $table = "card_installments";
    protected $fillable = ['*'];
    public $timestamps = false;
}
