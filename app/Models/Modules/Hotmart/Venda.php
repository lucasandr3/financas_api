<?php

namespace App\Models\Modules\Hotmart;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = "receipts";
    protected $fillable = ['*'];
    public $timestamps = false;
}
