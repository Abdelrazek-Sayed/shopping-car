<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('product.index') }}">Store</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('get.register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('get.login') }}">Login</a>
                    </li>
                @endguest
            </ul>


            @auth
                <a class="nav-link active mb=-30" aria-current="page" href="{{ route('cart.show') }}"><i
                        class="fas fa-shopping-cart"></i>
                    Shopping Cart :&nbsp;({{ session()->has('cart') ? session()->get('cart')->totalQty : 0 }})</a>


                <ul>
                    <li class="nav-item dropdown" style="list-style-type: none">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            <i class="fas fa-user"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Your Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>
