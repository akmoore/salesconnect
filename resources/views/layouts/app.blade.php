<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SalesConnect') }}</title>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/hipster_cards.css">
    <link rel="stylesheet" type="text/css" href="/css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="/css/datedropper.min.css">
    <link rel="stylesheet" type="text/css" href="/css/timedropper.min.css">
    <link rel="stylesheet" type="text/css" href="/css/trumbowyg.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dropzone.css">
    <link rel="stylesheet" href="/css/toastr.min.css"/>

    @yield('css')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{url('/home')}}">
                    {{ config('app.name', 'SalesConnect') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->full_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{route('projects.index')}}">Projects</a>
                                </li>
                                <li>
                                    <a href="{{route('calendar')}}">Calendar</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{route('aes.index')}}">Account Executives</a>
                                </li>
                                <li>
                                    <a href="{{route('agencies.index')}}">Agencies</a>
                                </li>
                                <li>
                                    <a href="{{route('clients.index')}}">Clients</a>
                                </li>
                                <li>
                                    <a href="{{route('managers.index')}}">Managers</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="/js/underscore-min.js"></script>
    <script type="text/javascript" src="/js/jstz.min.js"></script>
    <script type="text/javascript" src="/js/moment.min.js"></script>
    <script type="text/javascript" src="/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/js/mustache.min.js"></script>
    <script type="text/javascript" src="/js/Chart.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/datedropper.min.js"></script>
    <script src="/js/timedropper.min.js"></script>
    <script src="/js/trumbowyg.min.js"></script>
    <script src="/js/toastr.min.js"></script>
    @yield('scripts')
    
</body>
</html>
