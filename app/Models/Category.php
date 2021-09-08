<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable=['name','slug'];
    //protected $guarded=['slug'];//yeni bundan basqa butun sutunlar islenecek
    //protected $table =['kategori'];//eger biz ozuzum bir table yaradiriqsa laravele uygun olmuyan onu modelimizde qeyd edirik
    //const CREATED_AT = 'olusturma_tarixi';//eger bu timestamp deyerini ozumuz istediyimiz kimi yazsqq onu burda qeyd edirik
    //const DELETED_AT ='silinme_tarix';

    public function product()
    {
        return $this->belongsToMany('App\Models\Product','category_products');
    }
  
    public function ust_category()
    {
        return $this->belongsTo('App\Models\Category','ust_id')->withDefault([
            'name'=>'Ana Category'
        ]);
    }
}
