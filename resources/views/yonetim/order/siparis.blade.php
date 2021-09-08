@extends('yonetim.layouts.master')
@section('title','Order')
@section('content')
                <h1 class="sub-header">
                    Siparis Yonetimi

                </h1>
                <div class="row">
                    @include('layouts.partials.errors')
                    @include('layouts.partials.alert')
                    <div class="col-md-6">
                        <form action="{{route('yonetim.admin.siparis')}}" method="POST">
                            @csrf
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input type="text" name="aranan" class="form-control form-control-sm" placeholder="Ara" value="{{old('aranan')}}">
                                <span class="input-group-btn">
                                    <button style="margin-right: 5px;" type="submit" class="btn btn-primary">Ara</button>
                                <a href="{{route('yonetim.admin.siparis')}}" class="btn btn-primary">Temizle</a> </span>
                            </div>
                                
                        </form>
                    </div>
              
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sifaris Kodu</th>
                                <th>Kullanici</th>
                                <th>Adres</th>
                                <th>Siparis Tutar</th>
                                <th>Durum</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             @php 
                          $a = 1;
                          @endphp
                          @if(count($orders)==0)
                            <tr><td colspan="6" class="text-center">Kayit Bulunamadi</td></tr>
                          @endif
                          @foreach($orders as $order)
                            <tr>
                                <td>SP - {{$order->id}}</td>
                                <td>{{$order->sepet->user->adsoyad}}</td>
                                <td>{{$order->adres}}</td>
                                <td>{{$order->siparis_tutar *(100 +config('cart.tax'))/100}}</td>
                                <td>{{$order->durum}}</td>
                                  <td>{{$order->created_at}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('yonetim.siparis.update',$order->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Duzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.siparis.delete',$order->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Eminmisiniz?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$orders->links()}}
                </div>
@endsection