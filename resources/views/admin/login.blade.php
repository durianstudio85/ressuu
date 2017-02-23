@extends('layouts.app')

@section('title')
   - Login
@endsection

@section('body-class')
signup ressuuhome
@endsection


@section('content')
<content class="row ">

    <center><a href="{{ url('/') }}"><img src="images/logo.png" class="signuplogo" /></a></center>
    <section class="container">

        <center>
        
        <div class="clearfix"></div>
            <h4>Welcome to Admin Login</h4>


        <form method="POST" accept-charset="UTF-8" action="{{ url('/admin/fetchadmin') }}">
        {!! csrf_field() !!}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input required="required" class="" placeholder="Email Address" name="email" type="email">

                 @if ($errors->has('email')) 
                  <p class="label label-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <input required="required" class="" placeholder="Password" name="password" type="password">
                 @if ($errors->has('password'))
                   <p class="label label-danger">{{ $errors->first('password') }}</p>             
                 @endif
            </div>
            <div class="form-group">
               <input class="signin" type="submit" value="Sign In!">
            </div>

             <input type="hidden" value="{{ csrf_token() }}" name="_token" >

        </form>
            <div class="signupfooter">
                <p><a href="{{ url('/password/reset') }}">Forgot you Password?</a></p>
                <p><a href="{{ url('/register') }}">Create Account</a></p>
            </div>  
        </center>

    </section>

</content>


<footer class="ressuufooter">
        
        <div class="container">
            <div class="col-md-6">
                <p>You can Sign In with popular Social Networks</p>
            </div>
            <div class="col-md-6 btn-group btnwrap">
                <center>
                    <a class="btn btn-success btn1"><i class="fa fa-twitter"></i>&nbsp;Sign In with Twitter</a>
                    <a href="auth/facebook" class="btn btn-success btn2"><i class="fa fa-facebook"></i>&nbsp;Sign In with Facebook</a>
                </center>
            </div>
        </div>

</footer>
@endsection