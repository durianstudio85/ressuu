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
                    <?php if(!empty($adminProfile->profile_pic) AND $adminProfile->profile_pic != " " ){ ?>
                           <a href="#" data-toggle="modal" data-target="#profilepic" ><img class="img-reponsive profile-pic" src="../profilepic/<?php echo $adminProfile->profile_pic; ?>"></a> 
                    <?php }else{ ?>
                           <a href="#" data-toggle="modal" data-target="#profilepic" ><img class="img-responsive profile-pic" src="../profilepic/default_avatar.jpg"></a> 
                    <?php } ?>    
                </div>
                 <div class="name-panel">
                   <div class="name-panel">
                   <p class="name">
                     <?php echo $adminProfile->name; ?>
                   </p>
                   <p class="subname">
                   <?php echo $adminProfile->position; ?>
                    </p>
                 </div>
                 </div>
              </div>
      
             <nav class="row sidebar-menus">
                  <ul>
                        <a href="{{ url('/admin/home') }}"><li><span class="glyphicon glyphicon-inbox">&nbsp;</span>Dashboard</li></a>
                        <a href="{{ url('/admin/users') }}"><li class="menuactive"><span class="glyphicon glyphicon-star">&nbsp;</span>Users</li></a>
                        <a href="{{ url('/admin/ads') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Ads</li></a>
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
            
           <div class="col-xs-12 col-md-12 content-people-wrap ">
                       
                     <h4>Users List</h4>
             </div>


  </div>
  <div class="col-md-12 content-panel-header">
            
          <table class="table display" id="example" width="100%" cellspacing="0">
              <thead>
               <tr>
                <th>#</th> 
                <th></th> 
                <th>Name</th> 
                <th>Email</th> 
                <th>Position</th> 
              </tr> 
              </thead> 
              <tbody> 
              <?php $n =0; ?>
               <?php foreach ($userList as $user) { ?>
                  <?php $n++; ?>
                  <tr> 
                  <?php  $userProfile = DB::table('profiles')->where('user_id',$user->id )->first(); ?>

                  <?php if(empty($userProfile)){ ?>

                    <th scope="row"><?php echo$n; ?></th>

                     <?php if(!empty($user->profile_picture) AND $user->profile_picture != " " ){ ?>
                       <td><img class="img-responsive" style="width:50px;height:50px;border-radius:50px;" src="../profilepic/<?php echo $user->profile_picture; ?>"></td> 

                    <?php  }else{ ?>
                       <td><img class="img-responsive" style="width:50px;height:50px;border-radius:50px;" src="../profilepic/default_avatar.jpg"></td> 
                    <?php } ?>

                    
                    <td><?php echo $user->name; ?></td> 
                    <td><?php echo $user->email; ?></td> 
                    <td>Not Set</td> 

                        
                  <?php }else{ ?> 

                      <th scope="row"><?php echo$n; ?></th>
                     <?php if(!empty($userProfile->profile_picture) AND $userProfile->profile_picture != " " ){ ?>
                       <td><img class="img-responsive" style="width:50px;height:50px;border-radius:50px;" src="../profilepic/<?php echo $userProfile->profile_picture; ?>"></td> 

                    <?php  }else{ ?>
                       <td><img class="img-responsive" style="width:50px;height:50px;border-radius:50px;" src="../profilepic/default_avatar.jpg"></td> 
                    <?php } ?>

                    
                    <td><?php echo $userProfile->name; ?></td> 
                    <td><?php echo $userProfile->email; ?></td> 
                    <td><?php echo $userProfile->position; ?></td> 
                        
                  <?php } ?>

                  

                  </tr> 

                <?php } ?>
                
                </tbody> 
              </table>       

  </div>
               
</section>  

</content> 

                
</div>
@endsection


<?php } ?>



