<header class="header-section" style="background-color: #ede837">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 text-center text-lg-left">
                    <!-- logo -->
                    <a href="/" class="site-logo">
                        <img src="/webAssets/img/logo.png" alt="" width="100%">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-5">
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="user-panel">
                        @if (Auth::check())
                        <div class="up-item">
                            <div class="shopping-card">
                                <i class="flaticon-bag"></i>
                                <span>0</span>
                            </div>
                            <a href="#">Shopping Cart</a>
                        </div>
                        @endif
                        <div class="up-item">
                            <i class="flaticon-profile"></i>
                            @if (!Auth::check())
                            <a href="{{route('auth.login.index')}}">Sign In</a> or <a
                                href="{{route('auth.register.index')}}">Create Account</a>
                            @else
                            <a href="#" onclick="document.getElementById('logoutForm').submit();">Logout</a>
                            <form action="{{route('auth.logout')}}" method="POST" style="display: none" id="logoutForm">
                                @csrf
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <!-- menu -->
            <ul class="main-menu">
                <li><a href="/">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="{{route('public.products.index')}}">Our Products</a></li>
            </ul>
        </div>
    </nav>
</header>