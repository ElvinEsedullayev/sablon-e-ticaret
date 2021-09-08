@extends('layouts.master')
@section('title',$categories->name)
@section('content')
   <div class="container">
         <ol class="breadcrumb">
            <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>
            
            <li class="active">{{$categories->name}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$categories->name}}</div>
                    <div class="panel-body">
                        @if(count($alt_categories)>0)
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($alt_categories as $alt_category)
                            <a href="{{route('category',$alt_category->slug)}}" class="list-group-item"><i class="fa fa-television"></i>{{$alt_category->name}}</a>
                            @endforeach
                        </div>
                        @else
                        <div class="alert alert-danger" style="margin-top:20px;">Alt Categori Yoxdu</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    @if(count($urunler)>0)
                    Sırala
                    <a href="?order=coksatanlar" class="btn btn-default">Çok Satanlar</a>
                    <a href="?order=yeni" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    @endif
                    <div class="row">
                        @if(count($urunler)==0)
                        <div class="alert alert-danger" style="margin-top:20px;">Bu Categoriye Aid Mehsul Yoxdu</div>
                        @endif
                       @foreach($urunler as $urun)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$urun->slug)}}"><img src="{{$urun->details->sekil ? asset('uploads/products/'.$urun->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                            <p><a href="{{route('urun',$urun->slug)}}">{{$urun->name}}</a></p>
                            <p class="price">{{$urun->price}} ₺</p>
                            <form action="{{route('sepete.ekle')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$urun->id}}">
                                <input type="submit" value="Sepete Ekle" class="btn btn-theme">
                            </form>
                        
                        </div>
                        @endforeach
                    </div>
                    {{ request()->has('aranan') ? $urunler->appends(['order'=>request('order')])->links() : $urunler->links()}}
                </div>
            </div>
        </div>
    </div>
 @endsection