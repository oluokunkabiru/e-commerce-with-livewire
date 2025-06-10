<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title') - {{ settings()->name }}</title>
    @stack('meta')
    <!-- fabicon -->
    <link rel="shortcut icon" href="{{ @settings()->getMedia('favicon')->first()->getFullUrl() }}" type="image/x-icon" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />


    {{-- other icon --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css" integrity="sha512-vIgFb4o1CL8iMGoIF7cYiEVFrel13k/BkTGvs0hGfVnlbV6XjAA0M0oEHdWqGdAVRTDID3vIZPOHmKdrMAUChA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Material Design for Bootstrap -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" /> --}}
    {{-- <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css"
    rel="stylesheet" 
  /> --}}
  {{-- <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css"
        rel="stylesheet"
        />
    <!-- Font face -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />

    <!-- Responsive Design -->
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}




    <!-- Material Design for Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />

    <!-- Font face -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />

    <!-- Responsive Design -->
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles
    @yield('extra-css')
    @stack("extra-css")
</head>

<body class="">
    <script src="{{ asset('front/js/preloader.js') }}"></script>
    <div class="body-overlay z-6"></div>
    <div class="scroll-top z-5">
        <button class="btn btn-floating btn-lg btn-dark"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
    </div>

    <div class="search-form bg-white z-10">
        @livewire('child.search-form')
    </div>
    <!--Main Navigation-->
    <header class="z-7 bg-body">
        <div class="container py-2 shadow-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <button id="sidebarToggle" class="mr-2 z-9 btn btn-floating btn-light">
                        <i class="fa fa-bars m-0" aria-hidden="true"></i>
                    </button>
                    <div class="logo-container">
                        <img style="width: 50px" src="{{ @settings()->getMedia('logo_primary')->first()!=null?@settings()->getMedia('logo_primary')->first()->getFullUrl():null }}" class="img-fluid" alt="{{ settings()->name }}">
                    </div>
                </div>
                <div class="link-container z-8 bg-body">
                    <ul class="mb-0 list-unstyled d-md-initial d-lg-flex">
                        <li><a class="btn btn-white my-md-2 shadow-0 mx-lg-1 @yield('home')" href="{{ route('home') }}">Home</a>
                        </li>
                        <li><a class="btn btn-white my-md-2 shadow-0 mx-lg-1 @yield('about-us')" href="{{ route('aboutUs') }}">About
                            Us</a></li>

                        @livewire('child.shop-menu')


                        <li><a class="btn btn-white my-md-2 shadow-0 mx-lg-1 @yield('contact-us')" href=" {{ route('contactUs') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="ml-auto px-sm-1 px-2">
                    <button id="searchToggle" class="btn btn-white btn-floating d-none d-sm-inline" data-mdb-toggle="tooltip" title="Search">
                        <i class="fas fa-search"></i>
                    </button>
                    
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-white  btn-sm" >
                        Login
                       </a>
                       {{-- data-mdb-toggle="tooltip" title="Login"  data-mdb-toggle="tooltip" title="Register"--}}
                       <a href="{{ route('register') }}" class="btn btn-white  btn-sm">
                           Signup
                          </a>
                    @endguest
                    @auth
                    <button type="button" class="btn btn-floating btn-white" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-alt"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 bg-white">
                        <div class="px-3 py-2 bg-dark text-light">
                            <p class="small-font f-500 m-0">{{ auth()->user()->name }}</p>
                            <p class="smaller-font f-400 m-0">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-2">
                            <li><a href="{{ route('profile') }}" class="dropdown-item f-500">
                                    <i class="fas fa-user-alt mr-3"></i>Profile</a></li>
                            <li>
                                <a href="{{ route('wishlist') }}" class="dropdown-item f-500">
                                    <i class="fas fa-heart mr-3"></i>wishlist</a>
                            </li>
                            <li>
                                <a href="{{ route('order') }}" class="dropdown-item f-500">
                                    <i class="fas fa-history mr-3"></i>Enquiries</a>
                            </li>
                            @if (auth()->user()->getPermissionsViaRoles()->count())
                            <li>
                                <a href="{{ route('dashboard.home') }}" class="dropdown-item f-500">
                                    <i class="fa fa-tachometer-alt mr-3"></i>Dashboard</a>
                            </li>
                            @endif

                            <li><a href="{{ route('logout') }}" class="dropdown-item f-500" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>

                        </div>
                    </ul>
                    @endauth
                    @livewire('child.total-cart')
                </div>
            </div>
            <div class="container">

            </div>
        </div>

    </header>
    <!--Main Navigation-->

  

    <!--Main layout-->
    <main class="z-1 bg-container">
        <div class="container py-4">
            @yield('contents')
        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->

    @livewire('child.footer')

  


    <div class="p-4 text-center bg-black w-100">
        <h4 class="small-font text-light p-4 f-300">Copyright&copy; <a href="{{ route('home') }}" class="text__primary">{{ config('app.name') }}</a> {{ date('Y') }}. All
            Right
            Reserved.</h4>
    </div>
    <!--Footer-->

    <script async="async" data-cfasync="false" src="//pl22413347.toprevenuegate.com/05c35568f419bebde28efae27a682954/invoke.js"></script>
    <div id="container-05c35568f419bebde28efae27a682954"></div>
    
    


<script defer src="{{ mix('js/app.js') }}"></script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Custom scripts -->
<script type="text/javascript" src="{{ asset('front/js/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  @yield('extra-js')
    @stack('extra-js')
 @livewireScripts
    
  
   
</body>

</html>
