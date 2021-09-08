<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productdetay extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
