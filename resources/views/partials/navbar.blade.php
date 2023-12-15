{{-- <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"
></script> --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar order-last order-lg-0">
    <a class="navbar-brand"
        href="{{ route('info') }}"><img
            src="{{ asset('uploads/logo.png') }}" height="60px" width="60px"></a>
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('guest.login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.register') }}">Register</a>
                </li>
            @endguest

            @auth
                @can('customer')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('staff.dashboard') }}">Dashboard</a>
                    </li>
                @endcan

                @can('staff')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('staff.laundries.index') }}">Laundry
                            Management</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('customer.laundries.index') }}">My
                            Laundries</a>
                    </li>
                @endcan

                @can('staff')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('staff.bookings.index') }}">Bookings</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('customer.bookings.index') }}">My
                            Bookings</a>
                    </li>
                @endcan

                @can('staff')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('staff.transaction-logs') }}">Transaction
                            Logs</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page"
                            href="{{ route('customer.transaction-logs', auth()->user()->id) }}">My
                            Transaction
                            Logs</a>
                    </li>
                @endcan

                @can('staff')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('staff.viewOrder') }}">Orders</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('customer.viewOrder', auth()->user()->id) }}">My
                            Orders</a>
                    </li>
                @endcan

                @can('staff')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('staff.report-view') }}">
                            Reports</a>
                    </li>
                @endcan


                @can('staff')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('staff.viewPayment') }}">
                            Payments</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('customer.viewPayment') }}">
                            My Payments</a>
                    </li>
                @endcan

                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome, {{ Str::upper(auth()->user()->name) }}
                        </a>
                        <ul class="dropdown-menu">
                            @can('customer')
                                <li><a class="dropdown-item" href="{{ route('customer.profile') }}">My Profile</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('staff.profile') }}">My Profile</a></li>
                            @endcan
                            {{-- <li>
                                <a class="dropdown-item" href="#">Role:
                                    @foreach (auth()->user()->roles as $role)
                                        {{ Str::upper($role->role_name) }}
                                    @endforeach
                                </a>
                            </li> --}}
                            <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
    </div>
</nav>
