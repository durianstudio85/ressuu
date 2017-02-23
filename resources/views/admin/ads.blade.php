<?php if (!Session::has('id')){ ?>
<script>window.location.replace("http://localhost:8000/admin");</script>
<?php }else{ ?>




@extends('layouts.adminapp')


@section('title')
    | Admin Dashboard
@endsection

@section('body-class')

@endsection


@section('content')
<div class="container wrap">
<sidebar class="col-md-3 ">

               <div class="row">
                <div class="user">
                  <img src="../images/user.png">     
                </div>
                 <div class="name-panel">
                   <div class="name-panel">
                   <p class="name">
                 	Hellow Admin
                   </p>
                   <p class="subname">
                  Administrator
                    </p>
                 </div>
                 </div>
              </div>
      
             <nav class="row sidebar-menus">
                  <ul>
                        <a href="{{ url('/admin/home') }}"><li><span class="glyphicon glyphicon-inbox">&nbsp;</span>Dashboard</li></a>
                        <a href="{{ url('/admin/users') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Users</li></a>
                        <a href="{{ url('/admin/ads') }}"><li class="menuactive"><span class="glyphicon glyphicon-flag">&nbsp;</span>Ads</li></a>
                        <a href="{{ url('/admin/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
                        <a href="{{ url('/admin/settings') }}"><li><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
                        <a href="{{ url('/admin/logout') }}"><li><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li></a>
                  </ul>
              </nav>

</sidebar>

<content class="col-md-9"> 
<a href="https://duriangraphics.com/" target="_blank"> 
<section class="col-xs-12 col-md-12 content-header ads-bg">
  

                    <div class="col-xs-12 col-md-12 content-people-wrap ">
                       
                    
                    </div>

</section>
</a>
<section class="cph-wrapper">
  <div class="col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-md-12">
                             
                            <div class="col-sm-2 div">
                               <img src="../images/user.png">
                            </div>
                            <div class="col-sm-10 div">
                                  <h4>Hellow Admin </h4>
                                  <p>Lorem Ipsum <a href="" data-toggle="modal" data-target="#newsfeed"><span>check it here.</span></a></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                                 
                            </div>       
                      </div>
            </div>
             <div class="col-md-2 content-panel-lc">      
                                   
            </div>

  </div>

               
</section>  

</content> 

                
</div>
@endsection


<?php } ?>



