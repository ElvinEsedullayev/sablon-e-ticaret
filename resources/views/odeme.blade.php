@extends('layouts.master')
@section('title','Sepet')
@section('content')
 <div class="container">
        <div class="bg-content">
            <h2>Ödeme</h2>
            <form action="{{route('odemeyap')}}" method="POST">
                @csrf
            <div class="row">
                <div class="col-md-5">
                    <h3>Ödeme Bilgileri</h3>
                    <div class="form-group">
                        <label for="kartno">Kredi Kartı Numarası</label>
                        <input type="text" class="form-control kredikarti" id="kartno" name="cardnumber" style="font-size:20px;" required>
                    </div>
                    <div class="form-group">
                        <label for="cardexpiredatemonth">Son Kullanma Tarihi</label>
                        <div class="row">
                            <div class="col-md-6">
                                Ay
                                <select name="kullanim_tarixi_ay" id="cardexpiredatemonth" class="form-control" required>
                                    <option>1</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                Yıl
                                <select name="kullanim_tarixi_il" class="form-control" required>
                                    <option>2021</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardcvv2">CVV (Güvenlik Numarası)</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control kredikarti_cvv" name="cardcvv2" id="cardcvv2" required>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" checked> Ön bilgilendirme formunu okudum ve kabul ediyorum.</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" checked> Mesafeli satış sözleşmesini okudum ve kabul ediyorum.</label>
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-success btn-lg">Ödeme Yap</button>
                </div>
                <div class="col-md-7">
                    <h4>Ödenecek Tutar</h4>
                    <span class="price">{{Cart::total()}} <small>TL</small></span>

                    <h4>Iletisim ve Fatura Bilgileri</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ad Soyad</label>
                                <input type="text" name="adsoyad" id="adsoyad" class="form-control" required value="{{auth()->user()->adsoyad}}">
                            </div>
                        </div>
                            <div class="col-md-8">
                             <div class="form-group">
                                <label for="">Adres</label>
                                <input type="text" name="adres" id="adres" class="form-control" required value="{{$kullanici_detay->adres}}">
                            </div>
                            </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefon</label>
                                <input type="text" name="phone" id="phone" class="form-control" required value="{{$kullanici_detay->phone}}">
                            </div>
                        </div>
                            <div class="col-md-8">
                             <div class="form-group">
                                <label for="">Cep Telefon</label>
                                <input type="text" name="mobile" id="mobile"  class="form-control" required value="{{$kullanici_detay->mobile}}">
                            </div>
                            </div>
                        </div>
                 
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
@endsection    