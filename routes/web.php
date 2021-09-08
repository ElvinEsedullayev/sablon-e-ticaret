<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UrunController;
use App\Http\Controllers\SepetController;
use App\Http\Controllers\OdemeController;
use App\Http\Controllers\SiparisController;
use App\Http\Controllers\UserController;
####################################################YONETIM###############################################################################
use App\Http\Controllers\Yonetim\YonetimUserController;
use App\Http\Controllers\Yonetim\HomeController;
use App\Http\Controllers\Yonetim\CategoriController;
use App\Http\Controllers\Yonetim\ProductController;
use App\Http\Controllers\Yonetim\OrderController;


Route::group(['prefix'=>'yonetim'],function(){
    Route::redirect('/','yonetim/login');//yonlerime etdi.bos yonetim yazsaq da yonetim logine atir
    Route::match(['POST','GET'],'/login',[YonetimUserController::class,'login'])->name('yonetim.login');
    Route::get('/logout',[YonetimUserController::class,'logout'])->name('yonetim.logout');

    Route::group(['middleware'=>'isAdmin'],function(){
        Route::get('/home',[HomeController::class,'index'])->name('home');
        Route::group(['prefix'=>'admin'],function(){
            Route::match(['POST','GET'],'/user',[YonetimUserController::class,'index'])->name('yonetim.admin.user');
            Route::get('/create',[YonetimUserController::class,'form'])->name('yonetim.create');
            Route::get('/update/{id}',[YonetimUserController::class,'form'])->name('yonetim.update');
            Route::post('/update/{id?}',[YonetimUserController::class,'update'])->name('yonetim.updated');
            Route::get('/delete/{id}',[YonetimUserController::class,'delete'])->name('yonetim.delete');
        });

            Route::group(['prefix'=>'category'],function(){
            Route::match(['POST','GET'],'/categoriler',[CategoriController::class,'index'])->name('yonetim.admin.categoriler');
            Route::get('/create',[CategoriController::class,'form'])->name('yonetim.category.create');
            Route::get('/update/{id}',[CategoriController::class,'form'])->name('yonetim.category.update');
            Route::post('/update/{id?}',[CategoriController::class,'update'])->name('yonetim.category.updated');
            Route::get('/delete/{id}',[CategoriController::class,'delete'])->name('yonetim.category.delete');
        });

            Route::group(['prefix'=>'product'],function(){
            Route::match(['POST','GET'],'/products',[ProductController::class,'index'])->name('yonetim.admin.product');
            Route::get('/create',[ProductController::class,'form'])->name('yonetim.product.create');
            Route::get('/update/{id}',[ProductController::class,'form'])->name('yonetim.product.update');
            Route::post('/update/{id?}',[ProductController::class,'update'])->name('yonetim.product.updated');
            Route::get('/delete/{id}',[ProductController::class,'delete'])->name('yonetim.product.delete');
        });

            Route::group(['prefix'=>'order'],function(){
            Route::match(['POST','GET'],'/order',[OrderController::class,'index'])->name('yonetim.admin.siparis');
            Route::get('/create',[OrderController::class,'form'])->name('yonetim.siparis.create');
            Route::get('/update/{id}',[OrderController::class,'form'])->name('yonetim.siparis.update');
            Route::post('/update/{id?}',[OrderController::class,'update'])->name('yonetim.siparis.updated');
            Route::get('/delete/{id}',[OrderController::class,'delete'])->name('yonetim.siparis.delete');
        });
    });
});

Route::get('/', [AnasayfaController::class,'index'])->name('anasayfa');
Route::get('/kategory/{slug}', [CategoryController::class,'index'])->name('category');
Route::get('/urun/{slug}', [UrunController::class,'index'])->name('urun');
Route::post('/ara', [UrunController::class,'ara'])->name('urun_ara');
Route::get('/ara', [UrunController::class,'ara'])->name('urun_ara');

Route::group(['prefix'=>'sepet'],function(){
    Route::get('/', [SepetController::class,'index'])->name('sepet');
    Route::post('/ekle',[SepetController::class,'ekle'])->name('sepete.ekle');
    Route::delete('/kaldir/{rowid}',[SepetController::class,'kaldir'])->name('sepetden.kaldir');
    Route::delete('/bosalt',[SepetController::class,'bosalt'])->name('sepet.bosalt');
    Route::patch('/guncelle/{rowid}',[SepetController::class,'guncelle'])->name('sepet.guncelle');
});

 Route::get('/odeme', [OdemeController::class,'index'])->name('odeme');
 Route::post('/odeme', [OdemeController::class,'odemeyap'])->name('odemeyap');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/siparisler', [SiparisController::class,'index'])->name('siparisler');
    Route::get('/siparisler/{id}', [SiparisController::class,'detay'])->name('siparis.detay');
});



Route::group(['prefix'=>'user'],function(){
    Route::get('/login', [UserController::class,'login'])->name('login');
    Route::post('/login', [UserController::class,'login_ol'])->name('login');//name ayzmasaqda olar,yuxaridakindan goturur
    Route::get('/register', [UserController::class,'register'])->name('register');
    Route::post('/register', [UserController::class,'register_ol'])->name('register');
    Route::get('/aktivlesdir/{anahtar}',[UserController::class,'aktivlesdir'])->name('aktivlesdir');
    Route::post('logout',[UserController::class,'logout'])->name('logout');
});

Route::get('/test/mail',function(){
    $user = \App\Models\User::find(1);
    return new App\Mail\UserRegisterMail($user);
});