@extends('layouts.app')

@section('title')
      Reset Password
@endsection

@section('body-class')
signup ressuuhome
@endsection

@section('content')
<content class="row">

    <center><a href="{{ url('/') }}"><img src="/../images/logo.png" class="signuplogo" /></a></center>
    <section class="container">

        <center>
        
        <div class="clearfix"></div>
            <h4>Reset Password</h4>


                       <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ $email or old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                          
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" placeholder="Password" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                          
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">   
                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif      
                        </div>

                        <div class="form-group">
                             <input class="signin" type="submit" value="Reset Password">
                        </div>


                      
                    </form>


            <div class="signupfooter">
             
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
