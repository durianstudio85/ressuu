@extends('layouts.app')

@section('title')
    Sign Up
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
            <h4>Signup</h4>


        <form method="POST" accept-charset="UTF-8" action="{{ url('/register') }}">
        {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                <input placeholder="Name" name="name" type="text" value="{{ old('name') }}">

                 @if ($errors->has('email'))
                  <p class="label label-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input placeholder="Email" name="email" type="email" value="{{ old('email') }}">
                 @if ($errors->has('email'))
                        <p class="label label-danger">{{ $errors->first('email') }}</p>
                 @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input placeholder="Password" name="password" type="password">

                 @if ($errors->has('password'))
                     <p class="label label-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input placeholder="Re-Type Password" name="password_confirmation" type="password">
                 @if ($errors->has('password'))
                     <p class="label label-danger">{{ $errors->first('password_confirmation') }}</p>
                 @endif
            </div>


            <div class="form-group">
               <input class="signin" type="submit" value="Sign Up!">
            </div>

            

        </form> 
        
         <div class="signupfooter">
                <p><a href="{{ url('/login') }}">Back</a></p>
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