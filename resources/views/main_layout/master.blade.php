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
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('custom-css')
</head>

<body>
    <header class="wrapper bg-soft-primary">
        <nav class="navbar navbar-expand-lg center-nav navbar-light navbar-bg-light">
            <div class="container flex-lg-row flex-nowrap align-items-center">
                <div class="navbar-brand w-100">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}" srcset="{{ asset('img/logo@2x.png 2x') }}" alt="">
                    </a>
                </div>
                <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                    <div class="offcanvas-header d-lg-none">
                        <h3 class="text-white fs-30 mb-0">Sandbox</h3>
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
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="#">DashBoard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="#">B</a>
                                    </li>
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
                        <form class="search-form">
                            <div class="form-floating mb-0">
                                <input id="search-form" type="text" class="form-control" placeholder="Search">
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
            <div class="row gy-6 gy-lg-0">
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <img class="mb-4" src="{{ asset('img/logo-light.png') }}"
                            srcset="{{ asset('img/logo-light@2x.png 2x') }}" alt="" />
                        <p class="mb-4">© 2021 Sandbox. <br class="d-none d-lg-block" />All rights reserved.
                        </p>
                        <nav class="nav social social-white">
                            <a href="#"><i class="uil uil-twitter"></i></a>
                            <a href="#"><i class="uil uil-facebook-f"></i></a>
                            <a href="#"><i class="uil uil-dribbble"></i></a>
                            <a href="#"><i class="uil uil-instagram"></i></a>
                            <a href="#"><i class="uil uil-youtube"></i></a>
                        </nav>
                        <!-- /.social -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Get in Touch</h4>
                        <address class="pe-xl-15 pe-xxl-17">Moonshine St. 14/05 Light City, London, United Kingdom
                        </address>
                        <a href="mailto:#">info@email.com</a><br /> 00 (123) 456 78 90
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Learn More</h4>
                        <ul class="list-unstyled  mb-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Our Story</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-12 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Our Newsletter</h4>
                        <p class="mb-5">Subscribe to our newsletter to get our news & deals delivered to you.
                        </p>
                        <div class="newsletter-wrapper">
                            <!-- Begin Mailchimp Signup Form -->
                            <div id="mc_embed_signup2">
                                <form
                                    action="https://elemisfreebies.us20.list-manage.com/subscribe/post?u=aa4947f70a475ce162057838d&amp;id=b49ef47a9a"
                                    method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form"
                                    class="validate dark-fields" target="_blank" novalidate>
                                    <div id="mc_embed_signup_scroll2">
                                        <div class="mc-field-group input-group form-floating">
                                            <input type="email" value="" name="EMAIL"
                                                class="required email form-control" placeholder="Email Address"
                                                id="mce-EMAIL2">
                                            <label for="mce-EMAIL2">Email Address</label>
                                            <input type="submit" value="Join" name="subscribe"
                                                id="mc-embedded-subscribe2" class="btn btn-primary ">
                                        </div>
                                        <div id="mce-responses2" class="clear">
                                            <div class="response" id="mce-error-response2" style="display:none">
                                            </div>
                                            <div class="response" id="mce-success-response2" style="display:none">
                                            </div>
                                        </div>
                                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input
                                                type="text" name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc" tabindex="-1"
                                                value=""></div>
                                        <div class="clear"></div>
                                    </div>
                                </form>
                            </div>
                            <!--End mc_embed_signup-->
                        </div>
                        <!-- /.newsletter-wrapper -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    @yield('custom-js')
</body>

</html>
