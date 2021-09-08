@extends('yonetim.layouts.master')
@section('title','Kullanicilar Duzenle')
@section('content')
                <h1 class="sub-header">{{@$user->id>0 ? 'Kullanici Duzenle' : 'Kullanici Kaydet'}}</h1>
                @include('layouts.partials.alert')
                @include('layouts.partials.errors')
                <form action="{{route('yonetim.updated',@$user->id)}}" method="POST">
                  @csrf
                    <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ad Soyad</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ad Soyad" name="adsoyad" value="{{old('adsoyad',$user->adsoyad)}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{old('email',$user->email)}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Address" name="adres" value="{{old('adres',$user->detay->adres)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Telefon</label>
                                <input type="text" class="form-control" id="address" placeholder="Telefon" name="phone" value="{{old('phone',$user->detay->phone)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Cib Telefon</label>
                                <input type="text" class="form-control" id="address" placeholder="Cib Telefon" name="mobile" value="{{old('mobile',$user->detay->mobile)}}">
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                           {{-- <input type="checkbox" value="1" name="aktiv" @if($user->aktiv == 1) checked @endif> Aktiv --}}
                           <input type="hidden" name="aktiv" value="0">
                            <input type="checkbox" value="1" name="aktiv" {{old('aktiv',$user->aktiv) ? 'checked' : ''}}> Aktiv
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            {{--<input type="checkbox" value="1" name="is_admin" @if($user->is_admin ==1) checked @endif> Admin --}}
                            <input type="hidden" name="is_admin" value="0">
                            <input type="checkbox" value="1" name="is_admin" {{old('is_admin',$user->is_admin) ? 'checked' : ''}}> Admin
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{@$user->id >0 ? 'Guncelle' : 'Kaydet'}}</button>
                </form>
@endsection