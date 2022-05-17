<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('tittle')</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-toggle/css/bootstrap-toggle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-tags-input/bootstrap-tagsinput.css') }}">
    @yield('custom-css')

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Blogpost</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapePost"
                    aria-expanded="true" aria-controls="collapePost">
                    <i class="fas fa-clipboard"></i>
                    <span>Post</span>
                </a>
                <div id="collapePost" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.post.index') }}">All Post</a>
                        <a class="collapse-item" href="{{ route('admin.post.create') }}">Add Post</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory"
                    aria-expanded="true" aria-controls="collapseCategory">
                    <i class="fas fa-bars"></i>
                    <span>Category</span>
                </a>
                <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.category.index') }}">All
                            Category</a>
                        <a class="collapse-item" href="{{ route('admin.category.create') }}">Add
                            Category</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTag"
                    aria-expanded="true" aria-controls="collapseTag">
                    <i class="fas fa-tag"></i>
                    <span>Tag</span>
                </a>
                <div id="collapseTag" class="collapse" aria-labelledby="headingTag"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.tag.index') }}">All
                            Tag</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapeComment"
                    aria-expanded="true" aria-controls="collapeComment">
                    <i class="fas fa-comment fa-lg"></i>
                    <span>Comment</span>
                </a>
                <div id="collapeComment" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.comment.index') }}">All Comment</a>
                        <a class="collapse-item" href="{{ route('admin.comment.create') }}">Add Comment</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRole"
                    aria-expanded="true" aria-controls="collapseRole">
                    <i class="fas fa-key"></i>
                    <span>Role</span>
                </a>
                <div id="collapseRole" class="collapse" aria-labelledby="headingRole"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.role.index') }}">All Role</a>
                        <a class="collapse-item" href="{{ route('admin.role.create') }}">Add Role</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser"
                    aria-expanded="true" aria-controls="collapseUser">
                    <i class="fas fa-users"></i>
                    <span>User</span>
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingUser"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.user.index') }}">All User</a>
                        <a class="collapse-item" href="{{ route('admin.user.create') }}">Add
                            User</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block mb-4">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <x-admin.header />
                <div class="alert alert-info global-success global-alert d-none"></div>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('tittle')</h1>
                    </div>
                    @yield('content')
                </div>
            </div>
            <div class="container p-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright text-center p-3">
                                Copyright &copy; 2022, made with <i class="fas fa-heart"></i> by <a
                                    href="https://github.com/jusaboy-dev" target="_blank">Just A Boy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-tags-input/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-toggle/js/bootstrap-toggle.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('custom-js')
</body>

</html>
