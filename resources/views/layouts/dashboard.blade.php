<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
   
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <a href="/" >
              <img  src="/images/dashboard-store-logo.svg" class="my-4 mt-5" alt="" />
            </a>
          </div>

          <div class="list-group list-group-flush">
            <a
              href="{{ route('dashboard') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard')) ? 'active' : '' }}"
            >
              Dashboard
            </a>
            <a
              href="{{ route('dashboard-product') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/product*')) ? 'active' : '' }}"
            >
              My Product
            </a>
            <a
              href="{{ route('dashboard-transaction') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/transactions*')) ? 'active' : '' }}"
            >
              Transactions
            </a>
            <a
              href="{{ route('dashboard-setting-store') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/setting*')) ? 'active' : '' }}"
            >
              Store Setting
            </a>
            <a
              href="{{ route('dashboard-setting-account') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/account*')) ? 'active' : '' }}"
            >
              My Account
            </a>
            <a
              href="{{ route('logout') }}"
              class="list-group-item list-group-item-action"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"
            >
              Sign Out
            </a>
          </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                      @csrf
        </form>
        <!-- Page Content -->
        <div id="page-content-wrapper">
          <!-- Nav -->
        <nav
            class="navbar navbar-expand-lg navbar-light navbar-store fixed-top"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <button
                class="btn btn-secondary d-md-none mr-auto mr-2"
                id="menu-toggle"
              >
                &laquo;Menu
              </button>
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex ml-auto">
                  <li class="nav-item dropdown">
                    <a
                      href="#"
                      class="nav-link"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                    >
                      <img
                        src="/images/icon-user.png"
                        alt="User"
                        class="rounded-circle mr-2 profile-picture"
                      />
                      Hi,  {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                      <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                      <a href="{{ route('dashboard-setting-account') }}" class="dropdown-item"
                        >Settings</a
                      >
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                      </form>
                  </div>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block ">
                      @php
                        $carts = \App\Models\Cart::where('users_id',Auth::user()->id)->count();
                      @endphp
                      @if ($carts > 0)
                        <img src="/images/icon-cart-filled.svg" alt="Cart" />
                        <div class="cart-badge">{{ $carts }}</div>
                      @else
                        <img src="/images/icon-cart-empty.svg" alt="Cart" />
                      @endif
                      
                    </a>
                </li>
                </ul>

                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                  <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link"> Hi, {{ Auth::user()->name }} </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block"> Cart </a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

       {{-- Content --}}
        @yield('content')
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    @include('includes.script')
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')
   
  </body>
</html>
