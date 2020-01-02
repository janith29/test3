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
                <img src="img/artificial.png" alt="">
            </div>
            <div class="formarea">
             
                    {{ Form::open(['route' => 'login']) }}
                    <div class="loginput">
                        <label for="username">Username:</label>
                        <input type="text"  id="email" type="email" name="email" value="{{ old('email') }}"
                         placeholder="{{ __('views.auth.login.input_0') }}" required autofocus>
                    </div>
                    <div class="loginput">
                        <label for="password">Password:</label>
                        <input id="password" type="password" class="form-control" name="password"
                        placeholder="{{ __('views.auth.login.input_1') }}" required>
                    </div>
                    <div class="loginlower">
                        <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}><label for="checkbox">Keep me </label>
                        <input type="submit" value="Login">
                    
                    </div>     <div class="lowerlogfor">
                            <div class="onefor">
                                    <input type="checkbox" onclick="myFunction()">Show Password
                    
                            </div>
                            <div class="onefor">
                                    <a style="background-color: yellow; " href="{{ route('password.request') }}">
                                            forgot password
                                        </a>
                            </div>
                           

                          
                        </div>

                    {{ Form::close() }}
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
