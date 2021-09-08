@extends('layouts.master')
@section('title','Sepet')
@section('content')
<div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')
            @if(count(Cart::content())>0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Adet Fiyati</th>
                    <th>Adet</th>
                    <th>Tutar</th>
                </tr>
            @foreach(Cart::content() as $productCartItem) {{-- cart::content() sepet kodlarini calisdirir--}}
                <tr>
                    <td> 
                      <a href="{{route('urun',$productCartItem->options->slug)}}">
                        <img src="http://lorempixel.com/120/100/food/2">
                        </a>
                    </td>
                    
                    <td>
                        <a href="{{route('urun',$productCartItem->options->slug)}}">
                        {{$productCartItem->name}}
                        </a>
                        <form action="{{route('sepetden.kaldir',$productCartItem->rowId)}}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger btn-xs" value="Sepetdem Kaldir">
                        </form>
                    </td>
                    <td>{{$productCartItem->price}} ₺</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun-adet-azalt" data-id="{{$productCartItem->rowId}}" data-adet="{{$productCartItem->qty-1}}">-</a>
                        <span style="padding: 10px 20px">{{$productCartItem->qty}}</span>{{--qty sepetde eded gosterir --}}
                        <a href="#" class="btn btn-xs btn-default urun-adet-artir" data-id="{{$productCartItem->rowId}}" data-adet="{{$productCartItem->qty+1}}">+</a>
                    </td>
                    <td>{{$productCartItem->subtotal}} ₺</td>{{--sebetde olan eyni productun qiymetinin cemini gosterir --}}
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Alt Toplam</th>
                    <td class="text-right">{{Cart::subtotal()}} ₺</td>{{--sepetdeki butun urunlerin qiymetinin cemini gosterir --}}
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <td class="text-right">{{Cart::tax()}} ₺</td>{{--sepetdeki butun urunlerin kdv deyerini hesabliyir --}}
                </tr>
                   <tr>
                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <td class="text-right">{{Cart::total()}} ₺</td>{{--sepetdeki butun urunlerin kdv deyerini hesabliyir --}}
                </tr>
            </table>
            <div>
              
                <form action="{{route('sepet.bosalt')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
                </form>
                <a href="{{route('odeme')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
            @else
            <div class="container">
            <div class="alert alert-danger">Sepetinizde hec bir urun yok.</div>
            </div>
            @endif
        </div>
    </div>
 @endsection
@section('footer')
<script>
    $(function(){
        $('.urun-adet-azalt, .urun-adet-artir').on('click', function() {// verilen class adlaridi..bax yuxari
            var id = $(this).attr('data-id');//teg icinde atribut adidi
            var adet = $(this).attr('data-adet');//teg icinde atribut adidi
            $.ajax({
                type: 'PATCH',
                url: '{{url('/sepet/guncelle')}}/' + id,
                data: { adet: adet },//edet sepetcontrollorda yazilib bax ora
                success: function(result) {
                window.location.href = '{{route('sepet')}}';
             }
         });
    });
});

</script>
@endsection