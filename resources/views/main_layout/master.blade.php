<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
    <meta name="keywords"
        content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup, html5 template, site template">
    <meta name="author" content="elemis">
    <title>@yield('tittle')</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    @yield('custom-css')
</head>

<body>
    <header class="wrapper bg-soft-primary">
        <nav class="navbar navbar-expand-lg center-nav navbar-light navbar-bg-light">
            <div class="container flex-lg-row flex-nowrap align-items-center">
                <div class="navbar-brand w-100">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                    <div class="offcanvas-header d-lg-none">
                        <h3 class="text-white fs-30 mb-0">Technology Blog</h3>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">HOME</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                    href="{{ route('category.index') }}">CATEGORIES</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    @foreach ($navbar_category as $category)
                                        <li class="nav-item"><a class="dropdown-item"
                                                href="{{ route('category.show', $category) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">ABOUT US</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.create') }}">CONTACT</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="navbar-other w-100 d-flex ms-auto">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        @guest
                            <li class="nav-item d-none d-md-block">
                                <a href="{{ route('register') }}" class="btn btn-sm btn-primary rounded-pill">Sign Up</a>
                            </li>

                            <li class="nav-item d-none d-md-block">
                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary rounded-pill">Sign In</a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    @if (auth()->user()->isAdmin())
                                        <li class="nav-item"><a class="dropdown-item"
                                                href="{{ route('admin.index') }}">Dashboard</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="dropdown-item"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            href="#">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth

                        <li class="nav-item d-lg-none">
                            <button class="hamburger offcanvas-nav-btn"><span></span></button>
                        </li>
                    </ul>
                    <!-- /.navbar-nav -->
                </div>
                <!-- /.navbar-other -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- /.navbar -->
    </header>
    <div class="content-wrapper">
        <section class="wrapper bg-light wrapper-border">
            <div class="container inner py-8">
                <div class="row gx-lg-8 gx-xl-12 gy-4 gy-lg-0">
                    <div class="col-lg-8 align-self-center">
                    </div>
                    <!--/column -->
                    <aside class="col-lg-4 sidebar">
                        <form class="search-form" action="{{ route('posts.search') }}">
                            <div class="form-floating mb-0">
                                <input id="search-form" name="keyword" type="text" class="form-control"
                                    placeholder="Search">
                                <label for="search-form">Search</label>
                            </div>
                        </form>
                        <!-- /.search-form -->
                    </aside>
                    <!-- /column .sidebar -->
                </div>
                <!--/.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->
        <section class="wrapper bg-light">
            <div class="container py-14 py-md-8">
                <div class="row gx-lg-8 gx-xl-12">
                    @yield('content')
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="bg-dark text-inverse">
        <div class="container py-13 py-md-15">
            <div class="row gy gy-lg-0">
                <div class="col-md-4 col-lg-4">
                    <div class="widget">
                        <img class="mb-4" src="{{ asset('img/logo-dark.png') }}" />
                        <p class="mb-4">©
                            2022 Technology Blogpost. <br class="d-none d-lg-block" />All rights reserved.
                        </p>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-4">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Get in Touch</h4>
                        <address class="pe-xl-15 pe-xxl-17">{{ $settings->where('key', 'address')->first()->value }}
                        </address>
                        <a
                            href="mailto:{{ $settings->where('key', 'email')->first()->value }}">{{ $settings->where('key', 'email')->first()->value }}</a><br />
                        {{ $settings->where('key', 'phone')->first()->value }}
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-4">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Learn More</h4>
                        <ul class="list-unstyled  mb-0">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact.create') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </footer>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/headhesive.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/svg-inject.min.js') }}"></script>
    <script src="{{ asset('vendor/scrollCue.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox.js') }}"></script>
    <script src="{{ asset('vendor/plyr.js') }}"></script>
    <script src="{{ asset('vendor/counterup.min.js') }}"></script>
    <script src="{{ asset('vendor/itooltip.min.js') }}"></script>
    <script src="{{ asset('vendor/clipboard.min.js') }}"></script>
    <script src="{{ asset('vendor/noframework.waypoints.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    @yield('custom-js')
</body>

</html>
