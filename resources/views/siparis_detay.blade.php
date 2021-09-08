@extends('layouts.master')
@section('title','Sepet')
@section('content')
   <div class="container">
        <div class="bg-content">
            <a href="{{route('siparisler')}}" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Siparisler</a>
            <h2>Sipariş (SP-{{$siparisler->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($siparisler->sepet->sepet_urun as $sepeturun)
                <tr>
                    <td style="width: 120px;">
                        <a href="{{route('urun',$sepeturun->product->slug)}}">
                         <img src="{{$sepeturun->product->details->sekil!=null ? asset('uploads/products/'.$sepeturun->product->details->sekil) : 'http://lorempixel.com/120/100/food/2'}}" style="width: 120px; height: 100px;">
                         </a>
                    </td>
                    <td>
                         <a href="{{route('urun',$sepeturun->product->slug)}}">
                        {{$sepeturun->product->name}}
                            </a>
                    </td>
                    <td>{{$sepeturun->price}}</td>
                    <td>{{$sepeturun->eded}}</td>
                    <td>{{$sepeturun->price * $sepeturun->eded}}</td>
                    <td>
                        {{$sepeturun->durum}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar</th>
                    <td colspan="2">{{$siparisler->siparis_tutar}}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV)</th>
                    <td colspan="2">{{$siparisler->siparis_tutar * ((100+config('cart.tax'))/100)}}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Siparis Durum</th>
                    <td colspan="2">{{$siparisler->durum}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection