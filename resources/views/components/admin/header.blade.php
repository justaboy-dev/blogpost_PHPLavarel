@props(['title' => 'Dashboard'])
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#messagesCollapse" role="button" data-bs-toggle="collapse"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter">{{ $contact->count() }}</span>
            </a>
            <div class="dropdown-list collapse dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesCollapse" id="messagesCollapse">
                <h6 class="dropdown-header">
                    Contact Center
                </h6>
                @foreach ($contact as $item)
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            {{-- <img class="rounded-circle" src="{{ asset($item->user()->images->path) }}" alt="..."> --}}
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">{{ $item->subject }}</div>
                            <div class="small text-gray-500">{{ $item->created_at->diffForHumans() }}</div>
                            <div class="small text-gray-500">{{ $item->first_name . ' ' . $item->last_name }}</div>
                        </div>
                    </a>
                @endforeach
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                    Messages</a>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#userCollapse" data-bs-toggle="collapse">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset(auth()->user()->images->path) }}">
            </a>
            <div class="dropdown-menu collapse shadow animated--grow-in" id="userCollapse"
                aria-labelledby="userCollapse">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
                <a class="dropdown-item" href="#" id="logoutBtn">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
