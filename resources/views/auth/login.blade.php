@extends('layouts.app')

@section('title')
    Login
@endsection

@section('body-class')
signup ressuuhome
@endsection


@section('content')
<content class="row ">

    <center><img src="images/logo.png" class="signuplogo" /></center>
    <section class="container">

        <center>
        
        <div class="clearfix"></div>
            <h4>Welcome!</h4>


        <form method="POST" accept-charset="UTF-8" action="{{ url('/login') }}">
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
                    <button class="btn btn-success btn1"><i class="fa fa-facebook"></i>&nbsp;Sign In with Twitter</button>
                
                    <button class="btn btn-success btn2"><i class="fa fa-twitter"></i>&nbsp;Sign In with Facebook</button>
                </center>
            </div>
        </div>

</footer>
@endsection