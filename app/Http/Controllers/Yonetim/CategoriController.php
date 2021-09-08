<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoriController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan') or request()->filled('ust_id')){
            request()->flash();
            $aranan =request('aranan');
            $ust_id =request('ust_id');
            $categories = Category::with('ust_category')
            ->where('name','LIKE',"%$aranan%")
            ->where('ust_id',$ust_id)
            ->orderByDesc('id')
            ->paginate(5)
            ->appends(['aranan'=>$aranan,'ust_id'=>$ust_id]);
        }else{
             request()->flush();
             $categories = Category::with('ust_category')->orderByDesc('id')->paginate(5);
        }
        $anacategoriler = Category::whereRaw('ust_id is null')->get();
        return view('yonetim.category.category',compact('categories','anacategoriler'));
    }

    public function form($id =0)
    {
        $category = new Category;
        if($id > 0){
            $category = Category::find($id);
        }
        $categories = Category::all();
        return view('yonetim.category.categoryupdate',compact('category','categories'));
    }

    public function update($id =0)
    {

        $data = request()->only('name','slug','ust_id');
        if(!request()->filled('slug'))
        {
            $data['slug']= Str::slug(request('name'));
            request()->merge(['slug'=>$data['slug']]);//slug data icinde olan sluga beraberdise..yeni requestden gelen yeni slug veritabaninda varsa eynilesdirir..ve validate xetasi verecek
        }
            $this->validate(request(),[
            'name'=>'required',
            'slug'=>(request('orginal_slug') != request('slug') ? 'unique:categories,slug' : '')
            //bu kontrol categoryupdate sehifesinde slug ucun hidden input orginal_slug adinda yaradildi...deyilir ki,eger orginal slug requestden gelen sluga beraber deyilse o zaman validate isini gor
        ]);
        /*   eyni adda slugun olma kontroludu..bu yazilanda validate bundan qabaq olur..basqa cur yeni aciqda olan kod kimi yazanda ise validate sora gelir
        if(Category::whereSlug($data['slug'])->count()>0){
            return back()->withInput()->withErrors(['slug'=>'Bu adda slug movcuddur']);
        }
        */
        if($id > 0){
            $category = Category::where('id',$id)->firstORFail();
            $category->update($data);
        }else{
            $category = Category::create($data);
        }
        return redirect()->route('yonetim.category.update',$category->id)
        ->with('message_type','success')
        ->with('message',($id > 0 ? 'Guncellendi' : 'Kaydedildi'));
    }

    public function delete($id)
    {
        //attach--coxa cox iliskide veri yukluyur  // detach--coxa cox iliskide veri silir
        $category = Category::find($id);
        $category->product()->detach();
        $category->delete($id);
        return redirect()->route('yonetim.admin.categoriler')
        ->with('message_type','success')
        ->with('message','Category Silindi');
    }
}
