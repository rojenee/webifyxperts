<!doctype html>
<html lang="en">

<head>
    <title>Sidebar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/style_sidebar.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />

</head>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: linear-gradient(to bottom, white 50%, rgb(5, 131, 210) 50%);
    }

    html,
    body {
        min-height: 100%;
        background-color: rgb(5, 131, 210);
    }

    nav.sidebar {
        position: fixed;
    }

    .nav-item {
        margin-left: 1200px;
        list-style: none;
    }
</style>

<body>
    <section clas="logout-content">
        <li class="nav-item"><br>
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
                    <li>
                        <a class="dropdown-item" href="#">Role:
                            @foreach (auth()->user()->roles as $role)
                                {{ Str::upper($role->role_name) }}
                            @endforeach
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                </ul>
            </div>
        </li>
    </section>

    <nav class="sidebar mt-3 ">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/uploads/logo.png" style="width:40px">
                </span>
                <div class="text header-text">
                    <span class="name"> Laundry Hub</span>
                </div>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">

                    <i class='bx bx-search icon'></i>
                    <input type="search" placeholder="Search...">

                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dashboard">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text"> Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="laundries">
                            <i class='bx bx-clipboard icon'></i>

                            <span class="text nav-text"> Laundry List</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="bookings">
                            <i class='bx bx-calendar icon'></i>
                            <span class="text nav-text"> Bookings</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="view-order">
                            <i class='bx bx-shopping-bag icon'></i>
                            <span class="text nav-text"> Orders</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('staff.viewPayment') }}">
                            <i class='bx bx-dollar icon'></i>
                            <span class="text nav-text"> Payment</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="transaction-logs">
                            <i class='bx bx-history icon'></i>

                            <span class="text nav-text"> Transaction Logs</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="reports-view">
                            <i class='bx bxs-report icon'></i>

                            <span class="text nav-text"> Reports</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="profile">
                            <i class='bx bx-user icon'></i>

                            <span class="text nav-text"> Profile</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="footer">
                            <i class='bx bx-store icon'></i>

                            <span class="text nav-text"> Store Details</span>
                        </a>
                    </li>
                </ul>

                {{-- <li class="mode">
                        <div class="moon-sun">
                            <i class="bx bx-moon icon moon"></i>
                            <i class="bx bx-sun icon sun"></i>
                        </div>
                        <span class="mode-text text">Dark Mode </span>
                        <div class="toggle-switch">
                            <span class="switch">

                            </span>
                        </div>
                    </li> --}}

            </div>
        </div>
    </nav>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var searchInput = document.querySelector('.search-box input');
            var menuLinks = document.querySelectorAll('.menu-links .nav-link');
    
            searchInput.addEventListener('input', function() {
                var searchQuery = searchInput.value.toLowerCase();
    
                menuLinks.forEach(function(link) {
                    var linkText = link.textContent.toLowerCase();
    
                    if (linkText.includes(searchQuery)) {
                        link.style.display = 'block';
                    } else {
                        link.style.display = 'none';
                    }
                });
            });
        });
    </script>
   
</body>

</html>
