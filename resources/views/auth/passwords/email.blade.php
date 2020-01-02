@extends('layouts.welcome')
@section('content')
   
<section class="vmscard">
    <div class="container">
        <div class="row">
            <div class="head">
                <h2>Login</h2>
            </div>
        </div>
    </div>
</section>
<section class="login">
    <div class="container">
        <div class="row">
            <div class="logologin">
                <img src="/img/artificial.png" alt="">
            </div>
            <div class="formarea">
             
                @if(!empty($message))
                <div class="panel panel-danger">
        
                        {{-- <div class="panel-body"><p style="text-align:center;"><img src="img/core-img/artificial.png" class="center" width="800" height="420"></p></div> --}}
                        <div class="panel-heading"> <div class="col-12 col-lg-5">{{ $message}}</div>
                        <div  align="right"> .</a></div>
                    </div>
                    </div>
                    @endif
                    {{ Form::open(['route' => 'resetpass']) }}
                    <div class="loginput">
                        <label for="email">Email:</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="{{ __('views.auth.login.input_0') }}" required autofocus>
                    </div>
                    <div class="loginlower">
                      
                        <input type="submit" value="submit">
                    
                    </div>     
                    {{ Form::close() }}
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

        </div>
    </div>

</section>
<script>
        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
</script>
@endsection
