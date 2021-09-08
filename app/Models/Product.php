<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
     use softDeletes;
    protected $guarded=[];//butun xanalar doldurula biler
    public function category()
    {
        return $this->belongsToMany('App\Models\Category','category_products');
    }
    public function details()
    {
        return $this->hasOne('App\Models\Productdetay')->withDefault();
    }
}
