<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siparis;
class SiparisController extends Controller
{
    public function index()
    {
        $siparisler = Siparis::with('sepet')
        ->whereHas('sepet',function($query){
            $query->where('user_id',auth()->id());//giris eden userin siparislerini gosterir
        })
        ->orderByDesc('created_at')
        ->get();
        return view('siparis',compact('siparisler'));
    }

    public function detay($id)
    {
        $siparisler = Siparis::with('sepet.sepet_urun.product')
        ->whereHas('sepet',function($query){
            $query->where('user_id',auth()->id());//giris eden userin siparislerini gosterir
        })
        ->where('siparishes.id',$id)
        ->firstOrFail();
        return view('siparis_detay',compact('siparisler'));
    }
}
