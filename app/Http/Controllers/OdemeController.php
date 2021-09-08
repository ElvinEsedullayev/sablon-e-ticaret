<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Siparis;
class OdemeController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('login')
            ->with('message_type','info')
            ->with('message','Odeme sehifesine girmek ucun giris etmelisiz ve ya qeydiyyat olmalisiz');
        }else if(count(Cart::content())==0){
             return redirect()->route('anasayfa')
            ->with('message_type','info')
            ->with('message','Odeme sehifesine girmek ucun sepetinizde en azi 1 urun olmalidi');
        }
        $kullanici_detay = auth()->user()->detay;
        return view('odeme',compact('kullanici_detay'));
    }

    public function odemeyap()
    {
        $siparis = request()->all();
        $siparis['sepet_id']=session('aktiv_sepet_id');
        //$siparis['adsoyad']=request('adsoyad');
        //$siparis['adres']=request('adres');
        //$siparis['phone']=request('phone');
        //$siparis['mobile']=request('mobile');
        $siparis['bank']='Garanti';
        $siparis['siparis_tutar']=1;
        $siparis['taksit_sayisi']=Cart::subtotal();
        $siparis['durum']='Sifarisiniz Alindi';

        Siparis::create($siparis);
        Cart::destroy();//sepeti de silirlk
        session()->forget('aktiv_sepet_id');//aktiv sepet id ni sessionda silirik..sifaris tamamlananda
        return redirect()->route('siparisler')
        ->with('message_type','success')
        ->with('message','Siparisiniz ugurla qebul edildi');
    }
}
