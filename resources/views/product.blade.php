@extends('layouts.master')
@section('title','Urun')
@section('content')
<div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Anasayfa</a></li>
           {{-- @foreach($products->category()->distinct()->get() as $category) --}} {{--products yaninda category modelden gelir..product modelinden category tablosunu cekmek ucun ve burda ardindan yazilan kod ona gorediki bir mehsul bir kategoride tekrar ola biler..onun qarsini almaq ucundu..tekrar yazilmasin..foreach icinde bele kod yazmaqdansa controllerde yazmaq daha meqsede uygun oldugundan onu deyiskene ataraq controllerde yazdiq--}}
           @foreach($categories as $category)
            <li><a href="{{route('category',$category->slug)}}">{{$category->name}}</a></li>
            @endforeach
            <li class="active">{{$products->name}}</li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{$products->details->sekil ? asset('uploads/products/'.$products->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}" style="width: 470px; height: 400px;">
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="{{$products->details->sekil ? asset('uploads/products/'.$products->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="{{$products->details->sekil ? asset('uploads/products/'.$products->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="{{$products->details->sekil ? asset('uploads/products/'.$products->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{$products->name}}</h1>
                    <p class="price">{{$products->price}} ₺</p>
                             <form action="{{route('sepete.ekle')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$products->id}}">
                                <input type="submit" value="Sepete Ekle" class="btn btn-theme">
                            </form>
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Ürün Açıklaması</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">{{$products->description}}</div>
                    <div role="tabpanel" class="tab-pane" id="t2">Hele hec bir rey yoxdu!</div>
                </div>
            </div>

        </div>
    </div>
 @endsection