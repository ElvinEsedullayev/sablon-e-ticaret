<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class UrunController extends Controller
{
    public function index($slug)
    {
        $products = Product::whereSlug($slug)->firstOrFail();
        $categories=$products->category()->distinct()->get();//distinct bir kategoride bir mehsul iki defe olanda tekrar olan bir seyi bir defe gosterir..bu urun bladesinde foreach icinde yazilmisdi,controllere dasidiq deyiskene atdiq..category ise modelden gelir..product modelinde category metodu yazilib ki,category modeline baglansin
        return view('product',compact('products','categories'));
    }

    public function ara(Request $request)
    {
        //$aranan = request()->input('aranan');
        $aranan = $request->input('aranan');
        $products = Product::where('name','LIKE',"%$aranan%")
        ->orWhere('description','LIKE',"%$aranan%")
        ->paginate(2);//paginate reqemle gostersin deye providers icinde apservis providerde boot metodunda paginate ucun bir sey elave etdik
        //->get();//paginate yazanda get yazmaga gerek qalmir
        request()->flash();//arama formunda aranan soz qalsin deye bunu yazdiq,formda davalue icinde qeyd etdik
        return view('arama',compact('products'));
    }
}
