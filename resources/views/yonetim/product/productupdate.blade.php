@extends('yonetim.layouts.master')
@section('title','Product Duzenle')
@section('content')
                <h1 class="sub-header">{{@$product->id>0 ? 'Product Duzenle' : 'Product Kaydet'}}</h1>
                @include('layouts.partials.alert')
                @include('layouts.partials.errors')
                <form action="{{route('yonetim.product.updated',@$product->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Product Adi</label>
                                <input type="text" class="form-control" id="" placeholder="Product Adi" name="name" value="{{old('name',$product->name)}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Product Slug</label>
                                <input type="hidden" name="orginal_slug" value="{{old('slug',$product->slug)}}">
                                <input type="text" class="form-control" id="" placeholder="Product SLug" name="slug" value="{{old('slug',$product->slug)}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                                <label for="">Product Qiymet</label>
                                <input type="text" class="form-control" id="" placeholder="Product Qiymeti" name="price" value="{{old('price',$product->price)}}">
                            </div>
                        </div>
                           
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea type="text" class="form-control" id="description" placeholder="Aciqlama" name="description">{{old('description',$product->description)}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="categories[]" id="categories" class="form-control" multiple>
                                    @foreach($categories as $category) 
                                    <option value="{{$category->id}}" {{collect(old('categories',$product_categories))->contains($category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                                @if($product->details->sekil !=null)
                                <img src="{{asset('uploads/products/'.$product->details->sekil)}}" alt="" style="height: 100px; margin-right: 20px;" class="thumbnail pull-left">
                                @endif
                                <label for="">Sekil</label>
                                <input type="file" class="form-control" name="sekil" value="">
                            </div>
                        </div>
                         <div class="col-md-12">
                       <div class="checkbox">
                        <label>
                            {{--<input type="checkbox" value="1" name="is_admin" @if($user->is_admin ==1) checked @endif> Admin --}}
                            <input type="hidden" name="goster_slider" value="0">
                            <input type="checkbox" value="1" name="goster_slider" {{old('goster_slider',$product->details->goster_slider) ? 'checked' : ''}}> Slider
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            {{--<input type="checkbox" value="1" name="is_admin" @if($user->is_admin ==1) checked @endif> Admin --}}
                            <input type="hidden" name="goster_gunun_firsati" value="0">
                            <input type="checkbox" value="1" name="goster_gunun_firsati" {{old('goster_gunun_firsati',$product->details->goster_gunun_firsati) ? 'checked' : ''}}> Gunun Firsati
                        </label>
                    </div>
                          <div class="checkbox">
                        <label>
                            {{--<input type="checkbox" value="1" name="is_admin" @if($user->is_admin ==1) checked @endif> Admin --}}
                            <input type="hidden" name="goster_one_cixan" value="0">
                            <input type="checkbox" value="1" name="goster_one_cixan" {{old('goster_one_cixan',$product->details->goster_one_cixan) ? 'checked' : ''}}> One Cixan
                        </label>
                    </div>
                       <div class="checkbox">
                        <label>
                            {{--<input type="checkbox" value="1" name="is_admin" @if($user->is_admin ==1) checked @endif> Admin --}}
                            <input type="hidden" name="cox_satilan" value="0">
                            <input type="checkbox" value="1" name="cox_satilan" {{old('cox_satilan',$product->details->cox_satilan) ? 'checked' : ''}}> Cox Satilan
                        </label>
                    </div>
                     <div class="checkbox">
                        <label>
                            {{--<input type="checkbox" value="1" name="is_admin" @if($user->is_admin ==1) checked @endif> Admin --}}
                            <input type="hidden" name="endirim" value="0">
                            <input type="checkbox" value="1" name="endirim" {{old('endirim',$product->details->endirim) ? 'checked' : ''}}> Endirim
                        </label>
                    </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{@$product->details->id >0 ? 'Guncelle' : 'Kaydet'}}</button>
                </form>
@endsection
@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('footer')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function(){
        $('#categories').select2({
            placeholder: 'Zehmet olmasa Category secin'
        });
    });
</script>
@endsection