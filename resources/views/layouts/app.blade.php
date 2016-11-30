<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CSU Online Judge</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->


                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <bold><font color="#1b649b" size="8" style="font-style:oblique;"><img src="/img/index.png" height="80">中南大学ACM/ICPC在线评测系统</font></bold>
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
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
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

            <div class="container" class="navbar-header">

                <div>

                    <!-- Collapsed Hamburger -->


                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/problems') }}">
                        <h2>ProblemSet<h2>
                    </a>
                </div>

                <div>

                    <!-- Collapsed Hamburger -->


                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/status') }}">
                        <h2>Status<h2>
                    </a>
                </div>

                <div>

                    <!-- Collapsed Hamburger -->


                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/rank') }}">
                        <h2>Ranklist<h2>
                    </a>
                </div>

                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->


                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/contests') }}">
                        <h2>Contest<h2>
                    </a>
                </div>

            </div>
        </nav>

        <div id="container">
            @yield('content')
            <div class="push"></div>
        </div>



            <div class="footer">

                <!--img class="pull-right" width="64px" height="64px" src="/static/images/ICPC-Logo-Fishead.png"-->
                <div >
                    <small class="pull-left">服务器时间:<?php echo date("Y-m-d G:i:s");?> </small>
                    <!--<div class="pull-right text-right">-->
                        <small class="pull-right">中南大学开放式在线评测系统</small>
                        <br>
                        <p><small class="pull-right"> ©版权所有 2016-<?php echo date("Y")?>，<a href="mailto:yy.studioflaming@gmail.com">CSU_ACM TEAM</a>，保留一切权利 </small> </p>
                        
                </div>

            </div>


        </div>

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
