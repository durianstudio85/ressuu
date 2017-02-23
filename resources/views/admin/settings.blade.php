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
                        <a href="{{ url('/admin/ads') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Ads</li></a>
                        <a href="{{ url('/admin/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
                        <a href="{{ url('/admin/settings') }}"><li class="menuactive"><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
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

<section>
          
          <div class="col-xs-12  col-md-12 content-panel-header"><h3>Settings</h3></div>


         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Name</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                  
                               <p>Not Set</p>
                   
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title" >Email</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                        <p>Not Set</p>            
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title" >Username</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                    
                               <p>Not Set</p>
       
                  
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Password</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                   
                  
                            <p>Not Set</p>
                           
                                   
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>        
                                
</section>
                  
<section class="setting-foot">
             <div class="col-xs-12 col-md-12  content-panel">
                    <div class="content-profile">
                        <center><button data-toggle="modal" data-target="#myModal">Update</button></center>
                    </div>
            </div>   
</section>
</content> 

                
</div>
@endsection


<?php } ?>



