<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Userdetay;
use Hash;
class YonetimUserController extends Controller
{

    public function login()
    {
        if(request()->isMethod('POST')){
            $this->validate(request(),[
                'email'=>'required|email',
                'password'=>'required',
            ]);
            $login = [
                'email'=>request()->get('email'),
                'password'=>request()->get('password'),
                'is_admin'=>1,
                'aktiv'=>1
            ];
            if(Auth::guard('yonetim')->attempt($login,request()->has('remember_me'))){//auth::guard('yonetim) bunu ona gore yazdiq ki,bir user giris edende front sehifeye aid olmasin..yonetimi de config icinde auth icinde yazdiq
                return redirect()->route('home');
            }
            return back()->withInput()->withErrors(['email'=>'Hatali Giris']);
        }
        return view('yonetim.auth.login');
    }

    public function logout()
    {
        Auth::guard('yonetim')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('yonetim.login');
    }

    public function index()
    { 
        if(request()->filled('aranan')){
           request()->flash('aranan');
            $aranan = request('aranan');
            $users = User::where('adsoyad','LIKE',"%$aranan%")
            ->whereOr('email','LIKE',"%$aranan%")
            ->orderByDesc('created_at')
            ->paginate(2);
            //->appends('aranan',$aranan)// bele de yazmaq olar/biz bunu user icinde yazdiq..tablenin asagisinda
        }else{
             $users = User::orderByDesc('created_at')->paginate(3);
        }
       
        return view('yonetim.kullanici.user',compact('users'));
    }

    public function form($id =0)
    {
        $user = new User;
        if($id > 0){
            $user = User::find($id);
        }
        return view('yonetim.kullanici.userupdate',compact('user'));
    }

    public function update($id=0)
    {
        $this->validate(request(),[
            'email'=>'required|email',
            'adsoyad'=>'required'
        ]);
       $data =request()->only(['adsoyad','email']);
       
        if(request()->filled('password')){//eger sifre dolu ise
            $data['password']=Hash::make(request('password'));
        }
        $data['aktiv']= request()->has('aktiv') && request('aktiv')==1 ? 1 : 0;//checkbox lari dolumu deye kontrol edir
        $data['is_admin'] = request()->has('is_admin') && request('is_admin')==1 ? 1 : 0;//ve sora yazilan sert yeni user yaradanda bunlari varsayilan olaraq aktiv ve admin kimi yaratmasin deye etdik..
        if($id>0){
            $user = User::where('id',$id)->firstOrfail();
            $user->update($data);
        }else{
            $user = User::create($data);
        }
        Userdetay::updateOrCreate(
            ['user_id'=>$user->id],
            ['adres'=>request('adres'),'phone'=>request('phone'),'mobile'=>request('mobile')]
        );
        return redirect()->route('yonetim.update',$user->id)
        ->with('message_type','success')
        ->with('message',($id>0 ? 'Guncellendi' : "Kayd Edildi"));
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->route('yonetim.admin.user')
        ->with('message_type','success')
        ->with('message','Kullanici silindi');
    }
}
