@extends('yonetim.layouts.master')
@section('title','Order Duzenle')
@section('content')
                <h1 class="sub-header">{{@$order->id>0 ? 'Product Duzenle' : 'Product Kaydet'}}</h1>
                @include('layouts.partials.alert')
                @include('layouts.partials.errors')
                <form action="{{route('yonetim.siparis.updated',@$order->id)}}" method="POST">
                  @csrf
                    <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ad Soyad</label>
                                <input type="text" class="form-control" id=""  name="adsoyad" value="{{old('adsoyad',$order->adsoyad)}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Adres</label>
                                <input type="text" class="form-control" id=""  name="adres" value="{{old('adres',$order->adres)}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                                <label for="">Telefon</label>
                                <input type="text" class="form-control" id=""  name="phone" value="{{old('phone',$order->phone)}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                                <label for="">Cib Telefon</label>
                                <input type="text" class="form-control" id=""  name="mobile" value="{{old('mobile',$order->mobile)}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="durum" id="" class="form-control">
                                    <option {{old('durum',$order->durum)=='ifarisiniz Alindi' ? 'selected' : ''}}>Sifarisiniz Alindi</option>
                                    <option {{old('durum',$order->durum)=='Odeme Onaylandi' ? 'selected' : ''}}>Odeme Onaylandi</option>
                                    <option {{old('durum',$order->durum)=='Karqoya Verildi' ? 'selected' : ''}}>Karqoya Verildi</option>
                                    <option {{old('durum',$order->durum)=='Sifarisiniz Tamamlandi' ? 'selected' : ''}}>Sifarisiniz Tamamlandi</option>
                                </select>
                            </div>
                        </div>
                        </div>
             
                    <button type="submit" class="btn btn-primary btn-block">Guncelle</button>
                </form>
                            <h2>Sipariş (SP-{{$order->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($order->sepet->sepet_urun as $sepeturun)
                <tr>
                    <td style="width: 120px;">
                        <a href="{{route('urun',$sepeturun->product->slug)}}">
                         <img src="{{asset('uploads/products/'.$sepeturun->product->details->sekil)}}" style="width: 120px; height: 100px;">
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
                    <td colspan="2">{{$order->siparis_tutar}}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV)</th>
                    <td colspan="2">{{$order->siparis_tutar * ((100+config('cart.tax'))/100)}}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Siparis Durum</th>
                    <td colspan="2">{{$order->durum}}</td>
                </tr>
            </table>
@endsection


