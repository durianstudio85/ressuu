@extends('layouts.app')

@section('title')

@endsection

@section('body-class')
ressuuhome
@endsection


@section('content')
 <section class="contentarea container padtop30">
        
        <a href="{{ url('/') }}"><img src="images/logo.png" /></a>

        <div class="clearfix"></div>

        <div class="col-md-9 padtop70">
                
            <h1>We revolutionize <br>your <span>Resume!</span></h1>

            <br>

            <h6>Access your resume anytime and anywhere.</h6>

            <br>

            <center><a href="{{ url('/login') }}"><button class="login-btn">Login Now!</button></a> <a href="{{ url('/register') }}"><button class="btn btn-danger">Join us now!</button></a> </center>

        </div>

        <div class="col-md-3">
            
            <center><img src="images/phone.png" class="phoneimg"/></center>

        </div>

        <br>
        <br>
    </section>

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
