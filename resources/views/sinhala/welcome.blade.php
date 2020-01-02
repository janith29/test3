@extends('sinhala.layouts.welcome')
@section('content')        
<div class="container">
    <div class="welcome">
        <h1>
            Welcome to Artificial Limb Care (pvt) LTD.
        </h1>
    </div>
    <div class="slider" id="main-slider">
        <div class="slider-wrapper">
            <img src="img/bg-img/bg1.jpg" alt="First" class="slide" />
            <img src="img/bg-img/bg2.jpg" alt="Second" class="slide" />
            <img src="img/bg-img/bg4.jpg" alt="Third" class="slide" />

        </div>
    </div>

</div>
<section id="app-feature">
    <div class="container">
        <div class="row">
            <div class="col-4-app">
                <img src="/img/open.png">
                <h3 class="app-features">විවෘතව</h3>
                <P>සිකුරාදා වසා ඇත...</P>
                <P>අනෙකුත් දින වල උදැසන 9 සිට සවස 5 දක්වා</P>
            </div>
            <div class="col-4-app">
                <img src="/img/cont.png">
                <h3 class="app-features">අමතන අපව</h3>
                <P>info@artificiallimbcare.lk</P>
                <a href="tel:+94-71-345-0257" style="text-decoration: none ;"><P> 071 345 0257</P></a>
                <a href="tel:+94-11-581-0059" style="text-decoration: none ;"><P> 011 581 0059</P></a>
            </div>
            <div class="col-4-app">
                <a href="https://goo.gl/maps/iM2m3LKjAFJnbXs9A" style="text-decoration: none ;"><img src="/img/location.png">
                <h3 class="app-features">ස්ථානය</h3>
                <P>නො 4, මිත්‍රනන්ද මාවත,</P>
                <P> කිරිබත්ගොඩ.</P></a>
            </div>
        </div>
    </div>

</section>
<section class="service">
    <div class="container">
        <h2>අප සේවාවන්</h2>
        <div class="row">
            <a href="/services/orthosishome">
                <div class="col-6-service">
                    {{-- <img src="https://previews.123rf.com/images/ylivdesign/ylivdesign1702/ylivdesign170206829/72502064-prosthesis-hand-icon-simple-style.jpg"> --}}
                    
                    <h3 class="service-name">ශල්‍ය උපකරණ</h3>
                </div>
            </a>

            <a href="/services/childrenhome">
                <div class="col-6-service">
                    {{-- <img src="https://previews.123rf.com/images/ylivdesign/ylivdesign1702/ylivdesign170206829/72502064-prosthesis-hand-icon-simple-style.jpg"> --}}
                    <h3 class="service-name">ලමුන් සඳහා අධාරක උපකරණ </h3>
                </div>
            </a>

            <a href="/services/prosthesishome ">
                <div class="col-6-service">
                    {{-- <img src="https://previews.123rf.com/images/ylivdesign/ylivdesign1702/ylivdesign170206829/72502064-prosthesis-hand-icon-simple-style.jpg"> --}}
                    <h3 class="service-name">කෘතිම පාද සහ කෘතිම අත්</h3>
                </div>
            </a>

            <a href="/services/cosmetichome ">
                <div class="col-6-service">
                    {{-- <img src="https://previews.123rf.com/images/ylivdesign/ylivdesign1702/ylivdesign170206829/72502064-prosthesis-hand-icon-simple-style.jpg"> --}}
                    <h3 class="service-name">Cosmetic care</h3>
                </div>
            </a>
        </div>
    </div>
</section>
     
  @endsection
