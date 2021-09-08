<h1>{{config('app.name')}}</h1>
<p>Salam {{$user->adsoyad}}.Kaydiniz Basarili Sekilde Olusturuldu!</p>
<p>Kaydinizi aktivlesdirmek icin <a href="{{config('app.url')}}/user/aktivlesdir/{{$user->aktivasyon_anahtar}}">tiklayin</a> ve ya asagidaki baglantiyi internetinizde acin.</p>
<p>{{config('app.url')}}/user/aktivlesdir/{{$user->aktivasyon_anahtar}}</p>