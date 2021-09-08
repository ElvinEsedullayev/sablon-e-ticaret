<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Productdetay;
use App\Models\Product;
class AnasayfaController extends Controller
{
    public function index()
    {
         $categories = Category::whereRaw('ust_id is null')->take(8)->get();//take 8 sehifede 8 denesini gostermeyimizi istedik
         //whereRaw moterizede olan sorgu kimi yazilisa imkan verir..yeni ust id si olmuyanlari ,ana kategorileri gostermek ucundu..



        //$goster_slider = Productdetay::with('product')->where('goster_slider',1)->take(5)->get();bunu asagidaki kimi gosteririk
        $goster_slider = Product::select('products.*')//yuxarida olan da bu sorgunu yerine yetirirdi
        ->join('productdetays','productdetays.product_id','product_id')
        ->where('productdetays.goster_slider',1)
        ->orderBy('updated_at','DESC')
        ->take(5)->get();

        $gunun_firsati = Product::select('products.*')//(sadece belirli sutunlari cekmek ucun yazilir)burda deyilir ki,producta aid butun sutunlari cek..productdetays sutunlarini cekmek istemirikse bele yaziriq
        ->join('productdetays','productdetays.product_id','product_id')//join ile bir modele basqa bir tablonu bagliyaraq verileri cekmek olur,yeni iliskili tablolarda iliskini gosteren koddu.....1ci parametrde iliski vereceyimiz tablonu yaziriq(productdetays), 2ci parametrde hemin tabloda onun id sini gotururuk, 3parametrde ise product modelinde id(product_id) deyerinin bunlarla iliskili oldugunu gosterir
        ->where('productdetays.goster_gunun_firsati',1)//product modelinden productdetaya baglanmisiq deye ona qosulu sekilde gunun firsati sutuna baglana bilirik
        ->orderBy('updated_at','DESC')
        ->first();

        $goster_one_cixan = Product::select('products.*')
        ->join('productdetays','productdetays.product_id','product_id')
        ->where('productdetays.goster_one_cixan',1)
        ->orderBy('updated_at','DESC')
        ->take(4)->get();

         $cox_satilan = Product::select('products.*')
        ->join('productdetays','productdetays.product_id','product_id')
        ->where('productdetays.cox_satilan',1)
        ->orderBy('updated_at','DESC')
        ->take(4)->get();

         $endirim = Product::select('products.*')
        ->join('productdetays','productdetays.product_id','product_id')
        ->where('productdetays.endirim',1)
        ->orderBy('updated_at','DESC')
        ->take(4)->get();
        return view('home',compact('categories','goster_slider','gunun_firsati','goster_one_cixan','cox_satilan','endirim'));
    }
}
