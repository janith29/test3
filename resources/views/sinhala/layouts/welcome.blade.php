<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Requird meta tages -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>Artificial limb care (pvt) LTD.</title> 
    <meta name = "keywords" content="orthopaedic, artificial limbs, Sri Lanka,ක්‍රතිම අත්,ක්‍රතිම පාද" /> 
    <meta name = "description" 
    content="Our vision is to undertake new technology, development of skills, seeking of new principles, innovation and understanding of the patient’s needs in Prosthetics & Orthotics that can serve the human kind with passion." /> 
 

    <!-- Font -->

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script> -->
</head>
    </head>
    <body>
    <main class="home">
            <div id="navbar">
                    <div class="logo">
                        <a class="alightLeft  " href="/"> <img class="logo" src="/img/artificial.png" alt=""></a>
                    </div>
                    <div class="aliment">
                        <a class="alightLeft @if (Request::is('sinhala') ) active @endif" href="/sinhala">මුල් පිටුව</a>
                        {{-- <a class="alightLeft  @if (Request::is('sinhala/aboutus') ) active @endif" href="/sinhala/aboutus">අප ගැන</a>
                        <a class="alightLeft @if (Request::is('/sinhalaservices/*')|| Request::is('/sinhala/services') ) active @endif" href="/sinhala/services">සේවාවන්</a>
                        <a class="alightLeft @if (Request::is('contact') ) active @endif" href="/sinhala/contact">විමසීම්</a> --}}
                        <a class="alightRight" href="/">English</a>
                        
          @if (Route::has('login'))
          @if (!Auth::check())
                        <a class="alightRight @if (Request::is('login') ) active @endif" href="/login">Login</a>
                        @else
                        @if(auth()->user()->usertype == 'administrator')
                        <a class="alightRight" href="{{ url('/admin') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Receptionist')
                        <a class="alightRight" href="{{ url('/receptionist') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'PNO')
                        <a class="alightRight" href="{{ url('/pno') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Director')
                        <a class="alightRight" href="{{ url('/director') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Patient')
                        <a class="alightRight" href="{{ url('/patient') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Doctor')
                        <a class="alightRight" href="{{ url('/doctor') }}">{{ __('views.welcome.admin') }}</a>
                        @endif
                        <a class="alightRight" href="{{ url('/admin') }}">{{ __('views.welcome.logout') }}</a>
                        @endif
                        @endif
                    </div>
        
                </div>
                <div class="topnav">
                    <div class="logomoile">
                        <a class="alightLeft  cricale" href="/">
                            <img class="logo" src="/img/artificial.png" alt=""></a>
                    </div>
                    <div id="myLinks">
        
                        <a class="@if (Request::is('/') ) active @endif" href="/">මුල් පිටුව</a>
                        {{-- <a class="@if (Request::is('aboutus') ) active @endif" href="/aboutus">About us</a>
                        <a class="@if (Request::is('services/*')|| Request::is('services') ) active @endif" href="/services">Services</a>
                        <a class="@if (Request::is('contact') ) active @endif" href="/contact">Contact us</a> --}}
                        <a href="/">English</a>
          @if (Route::has('login'))
          @if (!Auth::check())

          <a class="@if (Request::is('login') ) active @endif" href="/login">පිවිසේන්න</a>
                        @else
                        @if(auth()->user()->usertype == 'administrator')
                        <a  href="{{ url('/admin') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Receptionist')
                        <a  href="{{ url('/receptionist') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'PNO')
                        <a  href="{{ url('/pno') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Director')
                        <a href="{{ url('/director') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Patient')
                        <a href="{{ url('/patient') }}">{{ __('views.welcome.admin') }}</a>
                        @elseif(auth()->user()->usertype == 'Doctor')
                        <a href="{{ url('/doctor') }}">{{ __('views.welcome.admin') }}</a>
                        @endif
                        <a  href="{{ url('/logout') }}">{{ __('views.welcome.logout') }}</a>
                        @endif
                        @endif
                    </div>
                    <a href="javascript:void(0);" class="icon" onclick="moblilenav()">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
                 @yield('content')
                 <footer>
                        <div class="container">
                            <div class="row">
                                <div class="col-4-foot foot-image">
            
                                    <a href="/">
                                        <img src="/img/art.png" class="footer-logo">
                                    </a>
                                </div>
                                <div class="col-4-foot quick-foot sm-col-4-foot">
                                    <h3>Quick Links</h3>
                                    <p>
                                        <ul>
                                            <li>
                                                <a href="/">Home</a>
                                            </li>
                                            <li>
                                                <a href="aboutus">About us</a>
                                            </li>
                                            <li>
                                                <a href="services">Service</a>
                                            </li>
                                            <li>
                                                <a href="contact">Contact</a>
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="col-4-foot sm-col-4-foot ">
            
                                    <h3>Follow us on</h3>
            
                                    <div id="social-media-footer">
                                        <ul>
                                            <li>
                                                <a href="https://www.facebook.com/artificiallimbcareSL/" target="_blank">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.youtube.com/channel/UCVUmHjfhaKNupmanL1xrgCw" target="_blank">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
            
                    <section class="copyright">
                        <div class="container">
                            <div class="row">
                                <div class="col-8-copy">
                                    <div class="copy">
                                        <p>|| Copyright ©2019 All rights reserved by ALC(pvt) Ltd.</p>
                                    </div>
                                </div>
                                <div class="col-4-copy">
                                    <div class="design">
                                        Web Design by <a href="https://pjtechnologyzone.com" target="_blank">PJtechnology zone</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
    </main>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/main.js"></script>

</body>

</html>