<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sepet;
use App\Models\Sepeturun;
use App\Models\Userdetay;
use Illuminate\Support\Str;//slug ucun bu kitabxanani elave edirik
use Illuminate\Support\Facades\Hash;//kod ucun yazilir
use Illuminate\Support\Facades\Auth;//auth istifade etmek ucun kitabxanani elave edirik
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisterMail;
use Cart;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //guest middleware oturumu acan adamlarin bu sehifelere getmeyinin qarsini alir..yeni melesen giris etmisense teezeden giris sehifesine gede bilmersen..except ise bu metod xaric demekdi..yeni giris eden adam logout metodune gede bilsin cixis isini etsin
    }


        public function login()
    {
        return view('kullanici.login');
    }

    public function login_ol()
    {
        $this->validate(request(),[
            'email'=>'required | email ',
             'password'=>'required '
        ]);
        $login =[
            'email' => request('email'),
             'password' => request('password'),
            // 'aktiv'=>1
        ];
        if(Auth::attempt($login,request()->has('remember_me'))){
            request()->session()->regenerate();//session ,elumatlarini yeniliyir,id deyerini sifirliyir

            #####################################################################################################
            
            $aktiv_sepet_id = Sepet::firstOrCreate(['user_id'=>auth()->id()])->id;
            /*
            $aktiv_sepet_id = Sepet::aktiv_sepet_id();//sepet id de bu funksiyani yazdiq
            if(is_null($aktiv_sepet_id)){
                $aktiv_sepet = Sepet::create(['user_id'=>auth()->id()]);
                $aktiv_sepet_id = $aktiv_sepet->id;
            }
            */
           
            session()->put('aktiv_sepet_id',$aktiv_sepet_id);

            if(Cart::count()>0){
                foreach (Cart::content() as $cartItem) 
                {
                    Sepeturun::updateOrCreate(
                        ['sepet_id'=>$aktiv_sepet_id,'product_id'=>$cartItem->id],
                        ['eded'=>$cartItem->qty,'price'=>$cartItem->price,'durum'=>'Beklemede']
                    );
                }
            }
            Cart::destroy();
            $sepeturunler = Sepeturun::with('product')->where('sepet_id',$aktiv_sepet_id)->get();
            foreach($sepeturunler as $sepeturun){
                Cart::add($sepeturun->product->id,$sepeturun->product->name,$sepeturun->eded,$sepeturun->price,['slug'=>$sepeturun->product->slug]);
            }
            
            #####################################################################################################

            return redirect()->intended('/');//giris olmadisa yeniden o sehifeye o da olmasa ana sehifeye atir
        }else{
            $errors=[
                'email'=>'Hatali Giris'
            ];
            return back()->withErrors($errors);
        }
    }

    public function register()
    {
        return view('kullanici.register');
    }
    public function register_ol()
    {
        $this->validate(request(),[
            'adsoyad'=>'required |min:3',
            'email'=>'required | email |unique:users',
            'password'=>'required |confirmed|min:5|max:15'
        ]);
        $user = User::create([
            'adsoyad'=>request('adsoyad'),
            'email'=>request('email'),
            'password'=>Hash::make(request('password')),
            'aktivasyon_anahtar'=>Str::random(60),
            'aktiv'=>0
        ]);
        $user->detay()->save(new Userdetay());//userdetay ozu yaradavaq..ayri tabledi..bos olaraq yaradar
        Mail::to(request('email'))->send(new UserRegisterMail($user));//register olanda mail gonderir..userregistermail terminalda yaradilan mail adidi
        //Mail::to(request('email'))->cc()->bcc()->send(new UserRegisterMail($user));cc basqa kisilere mail gonderir,bcc ise gizli kisilere mail gonderir
        auth()->login($user);//bu register olanda sisteme avtomatik giris ucun yazilan koddu
        return redirect()->route('anasayfa');
    }

    public function aktivlesdir($anahtar)
    {
        $user = User::where('aktivasyon_anahtar',$anahtar)->first();
        if(!is_null($user)){
            $user->aktivasyon_anahtar=null;
            $user->aktiv=1;
            $user->save();
            return redirect()->to('/')->with('message','Kullanici kaydiniz aktivlesdirildi')
            ->with('message_type','success');
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();//seesion icinde olan bilgileri sifirliyir
        request()->session()->regenerate();//session id deyerini de sifirladiq
        return redirect()->route('anasayfa');
    }


}
