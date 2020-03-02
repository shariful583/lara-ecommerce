<header>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-hover">
        <a class="navbar-brand" href="{{route('frontend.home')}}">Lara-Ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHover" aria-controls="navbarDD" aria-expanded="false" aria-label="Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHover">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bars" aria-hidden="true"></i>Category</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li><a class="dropdown-item{{}}" href="{{$category->slug}}">{{$category->name}}</a></li>

                        @endforeach
                        <li><a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Submenu link</a></li>
                                <li><a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Subsubmenu 1</a></li>
                                        <li><a class="dropdown-item" href="#">Subsubmenu 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('frontend.home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cart.show')}}">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontend.home')}}">Product</a>
                </li>

                @auth()

                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.profile')}}">{{auth()->user()->name}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                </li>

                    @endauth

            </ul>
            @guest()
            <ul class="navbar-nav right">

                <li class="nav-item"><a class="nav-link" href="{{route('user.signup')}}"> Sign Up</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.login')}}"> Login</a></li>
            </ul>
                @endguest
        </div>
    </nav>
</header>
