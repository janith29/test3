@extends('layouts.welcome')
@section('content')
<section class="vmscard">
    <div class="container">
        <div class="row">
            <div class="head">
                <h2>Contact us</h2>
            </div>
        </div>
    </div>
</section>
<section class="contactus">
    <div class="container">
        <div class="row">
            <div >
                    <iframe class="mapcon" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3960.2181645027135!2d79.93071423278809!3d6.983561059294592!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5f571d56e0a767bc!2sArtificial%20limb%20care%20(Pvt)%20Ltd.!5e0!3m2!1sen!2slk!4v1567416356713!5m2!1sen!2slk"  allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<section id="app-feature">
        <div class="container">
            <div class="row">
                <div class="col-4-app">
                    <img src="/img/open.png">
                    <h3 class="app-features">Open hours</h3>
                    <P>Friday close...</P>
                    <P>Other days 9am - 5pm</P>
                </div>
                <div class="col-4-app">
                    <img src="/img/cont.png">
                    <h3 class="app-features">Contact us</h3>
                    <P>info@artificiallimbcare.lk</P>
                    <P> 071 345 0257</P>
                </div>
                <div class="col-4-app">
                    <img src="/img/location.png">
                    <h3 class="app-features">Location</h3>
                    <P>No 4, Mithrananda Mawatha,</P>
                    <P> Kiribathgoda.</P>
                </div>
            </div>
        </div>
    </section>
@endsection
