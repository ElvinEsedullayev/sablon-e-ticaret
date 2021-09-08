@extends('layouts.master')
@section('title','Anasayfa')
@section('content')
@include('layouts.partials.alert')
  <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                        @foreach($categories as $category)
                        <a href="{{route('category',$category->slug)}}" class="list-group-item"><i class="fa fa-television"></i> {{$category->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0; $i<count($goster_slider); $i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="{{$i==0 ? 'acitev' : ''}}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($goster_slider as $index => $product_detay)
                        <div class="item {{$index==0 ? 'active' : ''}}">
                            <img src="{{asset('uploads/products/'.$product_detay->details->sekil)}}" alt="..." style="width: 640px; height: 400px;">
                            <div class="carousel-caption">
                                {{$product_detay->name}}
                            </div>
                        </div>
                   @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Gunun Firsati</div>
                    <div class="panel-body">
                        <a href="{{route('urun',$gunun_firsati->slug)}}">
                            <img src="{{$gunun_firsati->details->sekil ? asset('uploads/products/'.$gunun_firsati->details->sekil) : 'http://lorempixel.com/400/400/food/1'}}" class="img-responsive" style="min-width: 100%;">
                            {{$gunun_firsati->name}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row"> 
                        @foreach($goster_one_cixan as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$product->slug)}}"><img src="{{$product->details->sekil ? asset('uploads/products/'.$product->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                            <p><a href="{{route('urun',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($cox_satilan as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$product->slug)}}"><img src="{{$product->details->sekil ? asset('uploads/products/'.$product->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                            <p><a href="{{route('urun',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($endirim as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$product->slug)}}"><img src="{{$product->details->sekil ? asset('uploads/products/'.$product->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                            <p><a href="{{route('urun',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} ₺</p>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection