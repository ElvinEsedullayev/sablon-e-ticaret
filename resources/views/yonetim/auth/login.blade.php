<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Template Login Page (Bootstrap v3.3)</title>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{asset('back')}}/css/login.css">
</head>

<body>
    <div class="container">
        <form class="form-signin" action="{{route('yonetim.login')}}" method="POST">
            @csrf
            <img src="{{asset('back')}}/img/logo.png" class="logo">
            @include('layouts.partials.errors')
            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required aut>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="rememberme" value="1" checked> Meni Xatirla
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Giris Et</button>
            <div class="links">
                <a href="{{route('anasayfa')}}">&larr; Sayta Geri Don</a>
            </div>
        </form>
    </div>
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

</body>

</html>