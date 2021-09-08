@extends('yonetim.layouts.master')
@section('title','Category Duzenle')
@section('content')
                <h1 class="sub-header">{{@$category->id>0 ? 'Category Duzenle' : 'Category Kaydet'}}</h1>
                @include('layouts.partials.alert')
                @include('layouts.partials.errors')
                <form action="{{route('yonetim.category.updated',@$category->id)}}" method="POST">
                  @csrf
                    <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Adi</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Adi" name="name" value="{{old('name',$category->name)}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Slug</label>
                                <input type="hidden" name="orginal_slug" value="{{old('slug',$category->slug)}}">
                                {{--bu input categori adinda deyisiklik etmeden guncelleme ede bilmek ucundu..yeni deyek adi deyisdik,slug ise deyismek istemedik..o zaman slug xetasi vermesin..bunun ucun validatede kod yazilib --}}
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Slug" name="slug" value="{{old('slug',$category->slug)}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">USt Category</label>
                              <select name="ust_id" class="form-control">
                                <option value="">Ust Category</option>
                                @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                              </select>

                            </div>
                            <button type="submit" class="btn btn-primary btn-block">{{@$category->id >0 ? 'Guncelle' : 'Kaydet'}}</button>
                        </div>
                    </div>
                    
                </form>
@endsection