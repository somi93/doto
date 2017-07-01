<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="doto">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Doto</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.countdown.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.countdown.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
</head>
<body>
    <div class="container-box">
        <nav class="navbar navbar-inverse navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('img/logo.png') }}">
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/teams">Teams</a></li>
                    <li><a href="/tournaments">Tournaments</a></li>
                    <li><a href="/transfers">Transfers</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Gallery</a></li>
                </ul>
                <div class="col-sm-4 pull-right">
                    <div id="countdown"></div>
                    <p id="note"></p>
                </div>
            </div>
        </nav>
        <div class="col-sm-12">
            <div class="col-sm-8">
                @yield('content')
            </div>
            <div class="col-sm-4 doto-sidebar">
                <div class="ad-container hidden-xs">
                    <img src="{{ asset('img/ads/dota-2-international-championship.jpg') }}" style="width:100%">
                    <img src="{{ asset('img/ads/strix.jpg') }}" style="width:100%">
                    <img src="{{ asset('img/ads/d2cl.png') }}" style="width:100%">
                </div>
            </div>
        </div>
        <footer>
            <div id="copyright"><span class="rights">Copyright © 2017 Doto. All rights reserved.</span></div>
        </footer>
    </div>
    {{--Scripts--}}
    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/app.js') }}"></script>
    <script src="{{ asset('js/moment/moment.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
