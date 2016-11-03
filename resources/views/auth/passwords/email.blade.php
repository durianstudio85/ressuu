@extends('layouts.app')

@section('title')
    Reset Password
@endsection

@section('body-class')
signup ressuuhome
@endsection

@section('content')
<content class="row ">

    <center><a href="{{ url('/') }}"><img src="../images/logo.png" class="signuplogo" /></a></center>
    <section class="container">

        <center>
        
        <div class="clearfix"></div>
            <h4>Reset Password</h4>

             @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
             @endif

                <form method="POST" accept-charset="UTF-8" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                        <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}">

                         @if ($errors->has('email')) 
                          <p class="label label-danger">{{ $errors->first('email') }}</p>
                        @endif

                    </div>

                    <div class="form-group">
                       <input class="signin" type="submit" value="Send Password Reset Link">
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