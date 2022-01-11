<?php

namespace App\Models\Modules\Receipts;

use Illuminate\Database\Eloquent\Model;

class Receipts extends Model
{
    protected $table = "receipts";
    protected $fillable = ['*'];
    public $timestamps = false;
}
