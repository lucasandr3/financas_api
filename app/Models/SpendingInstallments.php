<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpendingInstallments extends Model
{
    protected $table = "spending_installments";
    protected $fillable = ['*'];
    public $timestamps = false;
}
