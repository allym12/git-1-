<header class="header-nav menu_style_home_one style2 menu_boxshadow navbar-scrolltofixed stricky main-menu">
    <div class="container">
        <!-- Ace Responsive Menu -->
        <nav>
            <!-- Menu Toggle btn-->
            <div class="menu-toggle">
                <img class="nav_logo_img img-fluid" src="{{asset('images/header-logo.svg')}}" alt="header-logo.svg">
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <a href="{{route('home')}}" class="navbar_brand float-left dn-md">
                <img class="logo1 img-fluid" src="{{asset('images/logo-dark.png')}}" alt="header-logo.svg">
                <img class="logo2 img-fluid" src="{{asset('images/logo-dark.png')}}" alt="header-logo2.svg">
{{--                <span>World Market Connect</span>--}}
            </a>
            <!-- Responsive Menu Structure-->
            <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
                <li><a href="{{route('home')}}">Home</a></li>

                <li><a href="{{route('houses.index')}}">Properties</a></li>
                <li><a href="{{route('cars.index')}}">Cars</a></li>
                <li><a href="{{route('lands.index')}}">Lands</a></li>
                <li><a href="{{route('hotels.index')}}">Hotels</a></li>
                <li><a href="{{route('fashions.index')}}">Fashions</a></li>

                <li><a href="">Contact</a></li>
                <li class="list-inline-item list_c"><a href=tel:250789723974#"><span class="flaticon-phone mr7"></span> +250789723974</a>
                </li>
                <li class="list-inline-item list_s"><a href="#" class="btn" data-toggle="modal"
                                                       data-target="#logInModal"><span class="flaticon-user"></span></a>
                </li>
                <li class="list-inline-item add_listing"><a target="__blank" href="{{route('register')}}"><span
                                class="icon flaticon-button"></span><span class="dn-lg"> Post an advert</span></a></li>
            </ul>
        </nav>
    </div>
</header>
