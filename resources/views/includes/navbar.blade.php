    <nav
      class="
        navbar navbar-expand-lg navbar-light navbar-store
        fixed-top
        navbar-fixed-top
      "
      data-aos="fade-down"
    >
      <div class="container">
        <a href="/" class="navbar-brand">
          <img src="/images/logo.svg" alt="" />
        </a>
        <form
          class="searchbox d-none d-lg-flex"
          onsubmit="event.preventDefault();"
          role="search"
         >
          <label for="search">Cari Barang Favoritmu</label>
          <input
            id="search"
            type="search"
            placeholder="Cari Barang Favoritmu"
            autofocus
            required
          />
          <button type="submit">Find</button>
        </form>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
              <a href="{{ route('home') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories') }}" class="nav-link {{ (request()->is('categories')) ? 'active' : '' }}">Categories</a>
            </li>
           
            
            @guest
            <li class="nav-item">
              <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            </li>
            <li class="nav-item">
              <a
                href="{{ route('login') }}"
                class="btn btn-success nav-link px-4 text-white"
                >Sign In</a
              >
            </li> 
            @endguest
           
          </ul>

           
          @auth
              <!-- Desktop Menu -->
              
              <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item dropdown">
                  <a
                    href="#"
                    class="nav-link"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                  >
                    <img
                      src="/images/user_pc.png"
                      alt="User"
                      class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{ Auth::user()->name }}
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
          @endauth
        </div>
      </div>
    </nav>