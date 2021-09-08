<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Siparis extends Model
{
    use HasFactory, softDeletes;
    protected $table ='siparishes';
    protected $fillable = ['adsoyad','adres','phone','mobile','sepet_id','siparis_tutar','durum','bank','taksit_sayisi'];

    public function sepet()
    {
        return $this->belongsTo('App\Models\Sepet');
    }
}
