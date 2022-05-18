@extends('main_layout.master')

@section('tittle', 'Blogpost | Contact')


@section('content')
    <div class="content-wrapper">
        <section class="wrapper bg-light angled upper-end">
            <div class="container py-14 py-md-4">
                <div class="row gy-10 gx-lg-8 gx-xl-12 mb-16 align-items-center">
                    <div class="col-lg-7 position-relative">
                        <div class="shape bg-dot primary rellax w-18 h-18" data-rellax-speed="1"
                            style="top: 0px; left: -1.4rem; z-index: 0; transform: translate3d(0px, 18px, 0px);"></div>
                        <div class="row gx-md-5 gy-5">
                            <div class="col-md-6">
                                <figure class="rounded mt-md-10 position-relative"><img
                                        src="{{ asset('template/assets/img/photos/g5.jpg') }}"
                                        srcset="{{ asset('template/assets/img/photos/g5@2x.jpg 2x') }}" alt=""></figure>
                            </div>
                            <!--/column -->
                            <div class="col-md-6">
                                <div class="row gx-md-5 gy-5">
                                    <div class="col-md-12 order-md-2">
                                        <figure class="rounded"><img
                                                src="{{ asset('template/assets/img/photos/g6.jpg') }}"
                                                srcset="{{ asset('template/assets/img/photos/g6@2x.jpg 2x') }}" alt="">
                                        </figure>
                                    </div>
                                    <!--/column -->
                                    <div class="col-md-10">
                                        <div class="card bg-pale-primary text-center counter-wrapper">
                                            <div class="card-body py-11">
                                                <h3 class="counter text-nowrap" style="visibility: visible;">5000+</h3>
                                                <p class="mb-0">Satisfied Customers</p>
                                            </div>
                                            <!--/.card-body -->
                                        </div>
                                        <!--/.card -->
                                    </div>
                                    <!--/column -->
                                </div>
                                <!--/.row -->
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!--/column -->
                    <div class="col-lg-5">
                        <h2 class="display-4 mb-8">Convinced yet? Let's make something great together.</h2>
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-location-pin-alt"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1">Address</h5>
                                <address>Moonshine St. 14/05 Light City, <br class="d-none d-md-block">London, United
                                    Kingdom</address>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                            </div>
                            <div>
                                <h5 class="mb-1">Phone</h5>
                                <p>00 (123) 456 78 90</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-envelope"></i> </div>
                            </div>
                            <div>
                                <h5 class="mb-1">E-mail</h5>
                                <p class="mb-0"><a href="mailto:sandbox@email.com"
                                        class="link-body">sandbox@email.com</a></p>
                            </div>
                        </div>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                        <h2 class="display-4 mb-3 text-center">Drop Us a Line</h2>
                        <p class="lead text-center mb-10">Reach out to us from our contact form and we will get back to you
                            shortly.</p>
                        <div class="alert alert-info global-success global-alert d-none"></div>
                        <div>
                            <form onsubmit="return false;" class="contact-form needs-validation" method="POST">
                                @csrf
                                <div class="messages"></div>
                                <div class="row gx-4">
                                    <div class="col-md-6">
                                        <x-contact-input name="first_name" placeholder="First Name"
                                            val="{{ old('first_name') }}" />
                                    </div>
                                    <!-- /column -->
                                    <div class="col-md-6">
                                        <x-contact-input name="last_name" placeholder="Last Name"
                                            val="{{ old('last_name') }}" />
                                    </div>
                                    <!-- /column -->
                                    <div class="col-md-12">
                                        <x-contact-input name="email" placeholder="Email" type="email"
                                            val="{{ old('email') }}" />
                                    </div>
                                    <!-- /column -->
                                    <div class="col-md-12">
                                        <x-contact-input value="{{ old('subject') }}" name="subject"
                                            placeholder="Subject" />
                                    </div>
                                    <!-- /column -->
                                    <div class="col-12">
                                        <x-contact-textarea name="message" placeholder="Message" />
                                    </div>
                                    <div class="col-12 text-center">
                                        <input type="submit" class="btn btn-primary rounded-pill btn-send mb-3"
                                            id="send-message-button" value="Send message">
                                        <p class="text-muted"><strong>*</strong> These fields are required.</p>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </form>
                            <!-- /form -->
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
        </section>
        <!-- /section -->
    </div>
@endsection

@section('custom-js')
    <script>
        $(document).on('click', '#send-message-button', (e) => {
            e.preventDefault();
            let $this = e.target;
            let csrf_token = $($this).parents('form').find('input[name="_token"]').val();
            let first_name = $($this).parents('form').find('input[name="first_name"]').val();
            let last_name = $($this).parents('form').find('input[name="last_name"]').val();
            let email = $($this).parents('form').find('input[name="email"]').val();
            let subject = $($this).parents('form').find('input[name="subject"]').val();
            let message = $($this).parents('form').find('textarea[name="message"]').val();
            let formData = new FormData();
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('email', email);
            formData.append('subject', subject);
            formData.append('message', message);
            formData.append('_token', csrf_token);

            $.ajax({
                url: "{{ route('contact.store') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            button: false,
                            timer: 1500
                        });
                        $($this).parents('form').trigger('reset');
                    } else {
                        swal({
                            position: 'top-end',
                            icon: 'error',
                            title: data.message,
                            text: data.error.join('\n'),
                            button: false,
                            timer: 1500
                        })
                    }
                }
            })
        })
    </script>
@endsection
