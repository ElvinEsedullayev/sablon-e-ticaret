<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="{{asset('front')}}/img/logo.png">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" action="{{route('urun_ara')}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="navbar-search" class="form-control" placeholder="Ara" name="aranan" value="{{old('aranan')}}">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('sepet')}}"><i class="fa fa-shopping-cart"></i> Sepet <span class="badge badge-theme">{{Cart::count()}}</span></a></li>
                    @guest{{--bu oturum acan adamlarin bunlari gormesin deye yazdiq. --}}
                    <li><a href="{{route('login')}}">Oturum Aç</a></li>
                    <li><a href="{{route('register')}}">Kaydol</a></li>
                    @endguest

                    @auth{{--oturum acmamis sexsler bunlari gormesin --}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Profil <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('siparisler')}}">Siparişlerim</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a></li>
                            {{-- bu js kodu tehlukesizlik ucun yazildi..yeni qiraqdan kimse iceri sizib ede bilmesin--}}
                            <form action="{{route('logout')}}" method="POST" id="logout-form" style="display: none;">@csrf</form>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>