<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sepeturun extends Model
{
    use HasFactory, softDeletes;
    protected $guarded = [];
    protected $table ='sepeturuns';
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
}
