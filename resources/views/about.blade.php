@extends('main_layout.master')

@section('tittle', 'Blogpost | About')

@section('content')
    <div class="content-wrapper">
        <section class="wrapper angled upper-end lower-end">
            <div class="py-md-4">
                <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-17 align-items-center">
                    <div class="col-lg-6 position-relative order-lg-2">
                        <div class="shape bg-dot primary rellax w-16 h-20" data-rellax-speed="1"
                            style="top: 3rem; left: 5.5rem; transform: translate3d(0px, 51px, 0px);"></div>
                        <div class="overlap-grid overlap-grid-2">
                            <div class="item">
                                <figure class="rounded shadow"><img
                                        src="{{ asset($settings->where('key', 'about_image')->first()->value) }}" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-start">
                        <h2 class="display-4 mb-3">{{ $settings->where('key', 'about_tittle')->first()->value }}</h2>
                        {!! $settings->where('key', 'about_description')->first()->value !!}
                    </div>
                </div>
                <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                    <div class="col align-self-start">
                        <h2 class="display-6 mb-3">{{ $settings->where('key', 'about_sub_tittle')->first()->value }}</h2>
                        {!! $settings->where('key', 'about_sub_description')->first()->value !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="wrapper bg-soft-primary">
            <div class="py-8 py-md-12">
                <div class="row mb-10">
                    <div class="col-xl-10 mx-auto">
                        <div class="row align-items-center counter-wrapper gy-6 text-center">
                            <div class="col-md-4">
                                <img src="{{ asset('img/profile.png') }}" class="icon-svg icon-svg-lg text-primary mb-3"
                                    alt="">
                                <h3 class="counter" style="visibility: visible;">{{ $user_count }}</h3>
                                <p>Users</p>
                            </div>
                            <!--/column -->
                            <div class="col-md-4">
                                <img src="{{ asset('img/post.png') }}" class="icon-svg icon-svg-lg text-primary mb-3"
                                    alt="">
                                <h3 class="counter" style="visibility: visible;">{{ $post_count }}</h3>
                                <p>Posts</p>
                            </div>
                            <!--/column -->
                            <div class="col-md-4">
                                <img src="{{ asset('img/view.png') }}" class="icon-svg icon-svg-lg text-primary mb-3"
                                    alt="">
                                <h3 class="counter" style="visibility: visible;">{{ $post_views }}</h3>
                                <p>Views</p>
                            </div>
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->
        <section class="wrapper angled upper-end lower-end">
            <div class="pt-4 pb-4 pt-md-4 pb-md-4">
                <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center">
                    <div class="col">
                        <h2 class="display-4 mb-8">Convinced yet? Let's make something great together.</h2>
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-location-pin-alt"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1">Address</h5>
                                <address>{{ $settings->where('key', 'address')->first()->value }}</address>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-phone-volume"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1">Phone</h5>
                                <p>{{ $settings->where('key', 'phone')->first()->value }}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-envelope"></i> </div>
                            </div>
                            <div>
                                <h5 class="mb-1">E-mail</h5>
                                <p class="mb-0"><a
                                        href="mailto:{{ $settings->where('key', 'email')->first()->value }}"
                                        class="link-body">{{ $settings->where('key', 'email')->first()->value }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->
    </div>
@endsection
