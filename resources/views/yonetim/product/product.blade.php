@extends('yonetim.layouts.master')
@section('title','Product')
@section('content')
                <h1 class="sub-header">
                    Product Yonetimi

                </h1>
                <div class="row">
                    @include('layouts.partials.errors')
                    @include('layouts.partials.alert')
                    <div class="col-md-6">
                        <form action="{{route('yonetim.admin.product')}}" method="POST">
                            @csrf
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input type="text" name="aranan" class="form-control form-control-sm" placeholder="Ara" value="{{old('aranan')}}">
                                <span class="input-group-btn">
                                    <button style="margin-right: 5px;" type="submit" class="btn btn-primary">Ara</button>
                                <a href="{{route('yonetim.admin.product')}}" class="btn btn-primary">Temizle</a> </span>
                            </div>
                                
                        </form>
                    </div>
                    <div class="col-md-6">
                    <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="{{route('yonetim.product.create')}}" type="submit" class="btn btn-primary">Yeni</a>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             @php 
                          $a = 1;
                          @endphp
                          @if(count($products)==0)
                            <tr><td colspan="6" class="text-center">Kayit Bulunamadi</td></tr>
                          @endif
                          @foreach($products as $product)
                            <tr>
                                <td>{{$a++}}</td>
                                <td>{{$product->name}}</td>
                             <td>{{$product->slug}}</td>
                                  <td>{{$product->created_at}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('yonetim.product.update',$product->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Duzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.product.delete',$product->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Eminmisiniz?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
@endsection