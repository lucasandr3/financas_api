<?php

namespace App\Models\Modules\Hotmart;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    protected $table = "receipts";
    protected $fillable = ['*'];
    public $timestamps = false;
}
