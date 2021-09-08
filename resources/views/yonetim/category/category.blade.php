@extends('yonetim.layouts.master')
@section('title','Category')
@section('content')
                <h1 class="sub-header">
                    Category Yonetimi
                    @include('layouts.partials.errors')
                    @include('layouts.partials.alert')
                </h1>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('yonetim.admin.categoriler')}}" method="POST">
                            @csrf
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input style="width: 170px; margin-right: 20px;" type="text" name="aranan" class="form-control form-control-sm" placeholder="Ara" value="{{old('aranan')}}">
                                  <select style="float: left; width: 180px;" name="ust_id" class="form-control">
                                      <option value="">Secin</option>
                                      @foreach($anacategoriler as $cat)
                                      <option value="{{$cat->id}}" {{old('ust_id') == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
                                      @endforeach
                                  </select>
                                <span class="input-group-btn">
                                    <button style="margin-right: 5px;" type="submit" class="btn btn-primary">Ara</button>
                                <a href="{{route('yonetim.admin.categoriler')}}" class="btn btn-primary">Temizle</a> </span>
                            </div>
                                
                        </form>
                    </div>
                    <div class="col-md-6">
                    <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="{{route('yonetim.category.create')}}" type="submit" class="btn btn-primary">Yeni</a>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Ust Category</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             @php 
                          $a = 1;
                          @endphp
                          @if(count($categories)==0)
                            <tr><td colspan="6" class="text-center">Kayit Bulunamadi</td></tr>
                          @endif
                          @foreach($categories as $category)
                            <tr>
                                <td>{{$a++}}</td>
                                <th>{{$category->ust_category->name}}</th>
                                <td>{{$category->name}}</td>
                             <td>{{$category->slug}}</td>
                                  <td>{{$category->created_at}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('yonetim.category.update',$category->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Duzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.category.delete',$category->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Eminmisiniz?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
@endsection