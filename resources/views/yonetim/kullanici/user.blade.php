@extends('yonetim.layouts.master')
@section('title','Kullanicilar')
@section('content')
                <h1 class="sub-header">
                    Kullanici Yonetimi
                    @include('layouts.partials.errors')
                    @include('layouts.partials.alert')
                </h1>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('yonetim.admin.user')}}" method="POST">
                            @csrf
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input type="text" name="aranan" class="form-control form-control-sm" placeholder="Ara" value="{{old('aranan')}}">
                                <span class="input-group-btn">
                                    <button style="margin-right: 5px;" type="submit" class="btn btn-primary">Ara</button>
                                <a href="{{route('yonetim.admin.user')}}" class="btn btn-primary">Temizle</a> </span>
                            </div>
                                
                        </form>
                    </div>
                    <div class="col-md-6">
                    <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="{{route('yonetim.create')}}" type="submit" class="btn btn-primary">Yeni</a>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Ad Soyad</th>
                                <th>Durum</th>
                                <th>Rol</th>
                                <th>Qeydiyyat Tarixi</th>
                                <th>Islemler</th>
                            </tr>
                        </thead>
                        <tbody>
                             @php 
                          $a = 1;
                          @endphp
                          @if(count($users)==0)
                            <tr><td colspan="7" class="text-center">Kullanici Bulunamadi</td></tr>
                          @endif
                          @foreach($users as $user)
                            <tr>
                                <td>{{$a++}}</td>
                                <td>{{$user->adsoyad}}</td>
                                <td>
                                  @if($user->aktiv == 1)
                                  <span class="label label-success">Aktiv</span>
                                  @else
                                  <span class="label label-warning">Passiv</span>
                                  @endif
                                </td>
                                <td>
                                  @if($user->is_admin ==1)
                                  <span class="label label-success">Admin</span>
                                  @else
                                  <span class="label label-info">User</span>
                                  @endif
                                  </td>
                                  <td>{{$user->created_at}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('yonetim.update',$user->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Duzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.delete',$user->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Eminmisiniz?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->appends('aranan',old('aranan'))->links()}}
                </div>
@endsection