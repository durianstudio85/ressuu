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
                        <a href="{{ url('/admin/users') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Users</li></a>
                        <a href="{{ url('/admin/ads') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Ads</li></a>
                        <a href="{{ url('/admin/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
                        <a href="{{ url('/admin/settings') }}"><li class="menuactive"><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
                        <a href="{{ url('/admin/logout') }}"><li><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li></a>
                  </ul>
              </nav>

</sidebar>

<content class="col-md-9"> 
 <?php  if(empty($AdminDashboard_Ads)){ ?>

  <a href="#" target="_blank"> 
    <section class="col-xs-12 col-md-12 content-header ads-bg" style="background:url('../ads/default-ads.png')">
      <div class="col-xs-12 col-md-12 content-people-wrap "></div>
    </section>
  </a>

<?php }else{ ?> 

  <a href="<?php echo $AdminDashboard_Ads->link; ?>" target="_blank"> 
    <section class="col-xs-12 col-md-12 content-header ads-bg" style="background:url('../ads/<?php echo $AdminDashboard_Ads->photo; ?>')">
      <div class="col-xs-12 col-md-12 content-people-wrap "> </div>
    </section>
  </a>

<?php } ?> 

<section>
          
          <div class="col-xs-12  col-md-12 content-panel-header"><h3>Settings</h3></div>

         <div class="col-xs-12 col-md-12 content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Picture</p>
                     </div>
                     <div class="col-xs-4 col-md-4">&nbsp;      
                              <img  class="setting-admin-pic"  src="../profilepic/<?php echo $adminProfile->profile_pic; ?>">            
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Name</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                                 <p><?php echo $adminProfile->name; ?></p>
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title" >Email</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                        <p><?php echo $adminProfile->email; ?></p>            
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Password</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                        <?php $password = str_repeat("*", strlen($adminProfile->password));  ?>
                        <p><?php echo $password; ?></p>             
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>        
                                
</section>
                  
<section class="setting-foot">
             <div class="col-xs-12 col-md-12  content-panel">
                    <div class="content-profile">
                        <center><button data-toggle="modal" data-target="#editSettings">Update</button></center>
                    </div>
            </div>   
</section>
</content> 

  <!-- Modal for editSettings -->
                   <section class="upeducation_modal">

                                                 <div class="modal fade" id="editSettings" role="dialog">

                                                      <div class="modal-dialog">
                                                      
                                                        <!-- Modal content-->
                                                        <div class="modal-content">

                                                        <form method="POST" action="/settings/editSettings" class="theme1"  enctype="multipart/form-data">
                                                            {{ csrf_field() }}  
                                                                            
                                                                            <div class="col-md-12 content-panel-header">
                                                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                               <h3>Update Admin </h3>

                                                                            </div>
                                                                            <section>
                                                                                       

                                                                                 <div class="form-group form-group">

                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="admin_name" type="text" value="<?php echo $adminProfile->name;?>">

                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="admin_email" type="text" value="<?php echo $adminProfile->email;?>">
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="admin_password" type="password" value="<?php echo $adminProfile->password;?>">
                                                                                  </div>
                                                                                </div>



                                                                                   <div class="form-group form-group">
                                                                                    <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                       <p>Picture</p>
                                                                                      </div>
                                                                                     <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                        <input class="form-control jobfile" name="logo" type="file" placeholder="Logo">
                                                                                        
                                                                                      </div>
                                                                                      
                                                                                    </div>




                                                                           </section>

                                                                          <div class="modal-footer">
                                                                               <button type="submit" class="btn btn-default">Update</button>  
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                                          </div>
                                                                <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                                                                       
                                                        </form>

                                                        </div>
                                                
                                                      </div>

                                                </div>

                   </section>

<!-- Modal for editSettings -->
                
</div>
@endsection


<?php } ?>



