@extends('layouts.master')
@section('content')
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>
      <li class="active">Arama Sonucu</li>
    </ol>
            <div class="products bg-content">
              @if(count($products)==0)
              <div class="alert alert-danger">Axtardiginiz Netice Tapilmadi!</div>
              @endif
                    <div class="row"> 
                        @foreach($products as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$product->slug)}}"><img src="{{$product->details->sekil ? asset('uploads/products/'.$product->details->sekil) : 'http://lorempixel.com/400/400/food/2'}}"></a>
                            <p><a href="{{route('urun',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} ₺</p>
                        </div>
                        @endforeach
                    </div>
                    {{--//paginate reqemle gostersin deye providers icinde apservis providerde boot metodunda paginate ucun bir sey elave etdik --}}
                    {{$products->appends(['aranan'=>old('aranan')])->links()}}{{--appends burda ona gore yazdiq ki,ikinci sehifeye kecende de axtarilan deyere gore kecsin..yoxsa hamsini gosterir..meselen l herfini axtardiq,ikinci sehifeye kecende l ile yox her seyi gosterirdi --}}
        </div>
  </div>
@endsection