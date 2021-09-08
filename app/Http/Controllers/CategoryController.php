<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index($slug)
    {
        $categories = Category::where('slug',$slug)->firstOrFail();
        $alt_categories = Category::where('ust_id',$categories->id)->get();
        $order = request('order');
        if($order == 'coksatanlar'){
            $urunler = $categories->product()
            ->distinct()
            ->join('productdetays','productdetays.product_id','products.id')
            ->orderBy('productdetays.cox_satilan','DESC')
            ->paginate(2);
        }else if($order =='yeni'){
            $urunler = $categories->product()->distinct()->orderBy('updated_at','DESC')->paginate(2);
        }else{
            $urunler = $categories->product()->distinct()->paginate(2);
        }
        
        return view('kategory',compact('categories','alt_categories','urunler'));
    }
}
