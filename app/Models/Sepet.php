<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sepet extends Model
{
    use HasFactory, softDeletes;
    protected $guarded =[];

    public function siparis()
    {
        return $this->hasOne('App\Models\Siparis');
    }

    public function sepet_urun()
    {
        return $this->hasMany('App\Models\Sepeturun');
    }

    public static function aktiv_sepet_id()
    {
        $aktiv_sepet = DB::table('sepet as s')//sepet tablosu ile bir sorgulama edirik dedik..as ile de qisaltdiq s yazdiq
        ->leftJoin('siparis as si','si.sepet_id','=','s.id')//sifaris tablosu ile iliski yaratdiq,sufairisi de qisaltdiq si etdik..sifarisdeki sebet id ile sepetdeki idni beraberlesdirdik
        ->where('s.user_id',auth()->id())//user id ancaq aktiv user id olan..login olan user yeni
        ->whereRaw('si.id is null')//siparis null ise bunu sayacaq. yeni biz sepeti doldurub ve sifaris etmisikse sora yeni sebet yaradanda hemin sebeti nezere alaccaq
        ->orderByDesc('s.created_at')
        ->select('s.id')
        ->first();
        if (!is_null($aktiv_sepet)) return $aktiv_sepet->id;
    }

    public function sepet_urun_adet()
    {
        return DB::table('sepeturuns')->where('sepet_id',$this->id)->sum('eded');//hansi sepeti sorguluyuruqsa o sebetin bilgisin dondurer
    }

     public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
