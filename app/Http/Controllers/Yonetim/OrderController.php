<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siparis;
class OrderController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan')){
            request()->flash();
            $aranan = request('aranan');
            $orders = Siparis::with('sepet.user')->where('adsoyad','LIKE',"%$aranan%")
            ->orWhere('id',$aranan)
            ->orderByDesc('created_at')
            ->paginate(4)
            ->appends('aranan',$aranan);
        }else{
            request()->flush();
            $orders = Siparis::with('sepet.user')->orderByDesc('id')->paginate(4);
        }
        return view('yonetim.order.siparis',compact('orders'));
    }
    
    public function form($id=0)
    {
        if($id >0)
        {
            $order = Siparis::with('sepet.sepet_urun.product')->find($id);
            //dd($order);
        }
        return view('yonetim.order.siparisupdate',compact('order'));
    }

    public function update($id = 0)
    {
        $data = request()->only('adsoyad','adres','phone','mobile','durum');
        $this->validate(request(),[
            'adsoyad'=>'required',
            'adres'=>'required',
            'mobile'=>'required',
            'phone'=>'required',
            'durum'=>'required'
        ]);
        if($id>0){
            $order = Siparis::where('id',$id)->firstOrFail();
            $order->update($data);
        }
         return redirect()->route('yonetim.siparis.update',$order->id)
        ->with('message_type','success')
        ->with('message','Guncellendi');
    }

    public function delete($id)
    {
        $order = Siparis::destroy($id);
        return redirect()->route('yonetim.admin.siparis')
        ->with('message_type','success')
        ->with('message','Siparis silindi');
    }
}
