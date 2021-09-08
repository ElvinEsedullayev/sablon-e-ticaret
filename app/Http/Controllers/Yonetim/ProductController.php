<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productdetay;
use Illuminate\Support\Str;
use App\Models\Category;
class ProductController extends Controller
{
    public function index()
    {
       
        if(request()->filled('aranan')){
            request()->flash();
             $aranan = request('aranan');
            $products = Product::where('name','LIKE',"%$aranan%")
            ->orderByDesc('created_at')
            ->paginate(4)
            ->appends('aranan',$aranan);
        }else{
            request()->flush();
            $products = Product::orderByDesc('id')->paginate(8);
        }
       
        return view('yonetim.product.product',compact('products'));
    }

    public function form($id =0)
    {
        $product = new Product;
        $product_categories =[];
        if($id > 0){
            $product = Product::find($id);
            $product_categories = $product->category()->pluck('category_id')->all();//select 2 olan hisseni ekranda gostermek ucundu..yeni placeholder kimi gosterilmesi..yuxarda bos array da buna gore yaradildi
        }
         $categories = Category::all();
        return view('yonetim.product.productupdate',compact('product','categories','product_categories'));
    }

    public function update($id = 0)
    {
       
        $data =request()->only('name','slug','price','description');
        $data_detay =request()->only('goster_slider','goster_gunun_firsati','goster_one_cixan','cox_satilan','endirim');
        if(!request()->filled('slug')){
             $data['slug']=Str::slug(request('name'));
             request('slug')->merge(['slug'=>$data['slug']]);
        }
         $this->validate(request(),[
            'name'=>'required',
            'slug'=>(request('orginal_slug') !=request('slug') ?  'unique:products,slug' : '')
        ]);
        $categories = request('categories');
        
        if($id >0){
            $product = Product::where('id',$id)->firstORFail();
            $product->update($data);
            $product->details()->update($data_detay);
            $product->category()->sync($categories);
        }else{
            $product = Product::create($data);
            $product->details()->create($data_detay);
            $product->category()->attach($categories);
        }
        if(request()->hasFile('sekil')){//requestden sekil gelibmi
            $this->validate(request(),[
                'sekil'=>'image|mimes:jpeg,png,jpg,gif|max:5000'
            ]);
            $productimage = request()->file('sekil');
            $productimage = request()->sekil;
            //$productimage->extension();//resmin uzantisini cekir
            //$productimage->getClientOrginalName();//resmin orginal adini cekir
            //$productimage->hasName();//haslanaraq ad verir
            $dosyadi=$product->id. '-'. time(). '.'. $productimage->extension();
            //$dosyadi=$productimage->getClientOrginalName();
            //$dosyadi=$productimage->hasName();
            if($productimage->isValid()){//yukleme isini kecici dosyada saxliyir
                $productimage->move('uploads/products',$dosyadi);
                Productdetay::updateOrCreate(
                    ['product_id'=>$product->id],
                    ['sekil'=>$dosyadi]
                );
            }
        }
        return redirect()->route('yonetim.product.update',$product->id)
        ->with('message_type','success')
        ->with('message',($id>0 ? 'Guncellendi' : 'Kaydeildi'));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->category()->detach();
        //$product->details()->delete(); soft delete etdiyimize gore bunu silmemekde olar..mehsulu geri qaytarsaq xeta olmasin
        $product->delete();
        return redirect()->route('yonetim.admin.product')
        ->with('message_type','success')
        ->with('message','Product Silindi');
    }
}
