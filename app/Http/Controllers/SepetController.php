<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sepeturun;
use App\Models\Sepet;
//use Gloudemans\Shoppingcart\Facades\Cart;
use Cart;
use Validator;
class SepetController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');//middlewareni controllor icinde nece yazilmali oldugunu gosterir
    }
    */
    public function index()
    {
        return view('sepet');
    }

    public function ekle()
    {
        $products = Product::find(request('id'));
        $cartItem =Cart::add($products->id,$products->name,1,$products->price,['slug'=>$products->slug]);//1ci id ,ikinci ad,sora eded ve qiymet parametrleri qebul edir..sebet ucun slug sutunu yazmamisiq..burda bunu elave edenden sora link icinde sebetin yaninda slug deyerini de almis oluruq..sebetde name ucun verilen linke bax


        #########################SEPET VERI TABANI ISLEMLERI..KULLANICI GIRISI OLUBSA#########################
        if(auth()->check()){//bir kullanici girisi edildise
            $aktiv_sepet_id = session('aktiv_sepet_id');
            if(!isset($aktiv_sepet_id)){//eger bir defe sepet sessiona atilmamissa bu kodu calisdir
            $aktiv_sepet = Sepet::create([//kullanici girisi oldusa db da sepet yaradiriq
                'user_id'=>auth()->id()
            ]);
            $aktiv_sepet_id = $aktiv_sepet->id;//olusturdugumuz aktiv sebetin id sini cekirik
            session()->put('aktiv_sepet_id',$aktiv_sepet_id);//cekdiyimiz aktiv sebet id ni sessionda tuturuq
        }
        Sepeturun::updateOrCreate(
            ['sepet_id'=>$aktiv_sepet_id ,'product_id'=>$products->id],//sepeturun tablosu yaradilan zaman birinci baxir bu id sepetde var ya yox(yeni bu sepet id ve urun id varmi ya yoxmu)..varsa asagidaki bilgileri update edir..yoxdusa eger yaradir
            ['eded'=>$cartItem->qty,'price'=>$products->price,'durum'=>'Beklemede']
        );
    }
    ####################################################################################

        return redirect()->route('sepet')
        ->with('message_type','success')
        ->with('message','Urun sepete eklendu');
    }

    public function kaldir($rowid)
    {
        ##############################################
        if(auth()->check()){
            $aktiv_sepet_id = session('aktiv_sepet_id');
            $cartItem = Cart::get($rowid);//cart icinde olan butun melumatlari cekir
            Sepeturun::where('sepet_id',$aktiv_sepet_id)->where('product_id',$cartItem->id)->delete();
        }
        #################################################
        Cart::remove($rowid);
        return redirect()->route('sepet')
        ->with('message_type','success')
        ->with('message','Urun Sepetden Kaldirildi');
    }

    public function bosalt()
    {
        ###########################################
         if(auth()->check()){
            $aktiv_sepet_id = session('aktiv_sepet_id');
            Sepeturun::where('sepet_id',$aktiv_sepet_id)->delete();//butun sebeti silirik deye burda product idni sildik..
        }
        ############################################
        Cart::destroy();
        return redirect()->route('sepet')
        ->with('message_type','success')
        ->with('message','Sepetiniz Bosaldildi.');
    }

    public function guncelle($rowid)
    {
        $validator = Validator::make(request()->all(),[
            'adet'=>'required|numeric|between:0,5'
        ]);
        if($validator->fails()){
            session()->flash('message_type','danger');
            session()->flash('message','Adet deyeri en az 1 en cox 5  olmalidi');
             return response()->json([
            'success'=>false
        ]);
        }
            #########################################################
            if(auth()->check()){
            $aktiv_sepet_id = session('aktiv_sepet_id');
            $cartItem = Cart::get($rowid);//cart icinde olan butun melumatlari cekir
            if(request('adet')==0){//bunu ona gore etdik ki,sepetden sil yox sebetde 1 dene olan mehsulu 1 azaltsaq 0 qalir deye silinsin 
                Sepeturun::where('sepet_id',$aktiv_sepet_id)->where('product_id',$cartItem->id)->delete();
            }else{
            Sepeturun::where('sepet_id',$aktiv_sepet_id)->where('product_id',$cartItem->id)
            ->update(['eded'=>request('adet')]);
            }
        }
        ##################################################################

        Cart::update($rowid,request('adet'));//js icinde adet deyerini vermisik
        session()->flash('message_type','success');
        session()->flash('message','Adet ugurla guncellendi');
        return response()->json([
            'success'=>true
        ]);
    }

}
