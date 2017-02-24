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
                        <a href="{{ url('/admin/ads') }}"><li class="menuactive"><span class="glyphicon glyphicon-flag">&nbsp;</span>Ads</li></a>
                        <a href="{{ url('/admin/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
                        <a href="{{ url('/admin/settings') }}"><li><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
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
          
          <div class="col-xs-12  col-md-12 content-panel-header"><h3>Users Area</h3></div>

         <div class="col-xs-12 col-md-12 content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Dashboard</p>
                        <button class="admin-ads-button" data-toggle="modal" data-target="#userDashboardAds">UPDATE</button>
                     </div>
                     <div class="col-xs-4 col-md-9">&nbsp;
                               <?php  if(empty($UserDashboard_Ads)){ ?>
                                <img  class="img-responsive ads-image" src="../ads/default-ads.png" >            
                               <?php }else{ ?> 
                                <img  class="img-responsive ads-image" src="../ads/<?php echo $UserDashboard_Ads->photo; ?>" >  
                                <span><?php echo $UserDashboard_Ads->title; ?></span> <span class="float-right"><i><a href="<?php echo $UserDashboard_Ads->link; ?>"><?php echo $UserDashboard_Ads->link; ?></a></i></span>          
                               <?php } ?>   
                     </div>

                     <div class="col-md-12 line"></div>                
         </div>

          <div class="col-xs-12 col-md-12 content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Profile</p>
                        <button class="admin-ads-button"  data-toggle="modal" data-target="#userProfileAds">UPDATE</button>
                     </div>
                     <div class="col-xs-4 col-md-9">&nbsp;      
                            <?php  if(empty($UserProfile_Ads)){ ?>
                                <img  class="img-responsive ads-image" src="../ads/default-ads.png" >            
                            <?php }else{ ?> 
                             <img  class="img-responsive ads-image" src="../ads/<?php echo $UserProfile_Ads->photo; ?>" >  
                             <span><?php echo $UserProfile_Ads->title; ?></span> <span class="float-right"><i><a href="<?php echo $UserProfile_Ads->link; ?>"><?php echo $UserProfile_Ads->link; ?></a></i></span>          
                            <?php } ?>        
                     </div>

                     <div class="col-md-12 line"></div>                
         </div>

          <div class="col-xs-12 col-md-12 content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Settings</p>
                        <button class="admin-ads-button"  data-toggle="modal" data-target="#userSettingsAds">UPDATE</button>
                     </div>
                     <div class="col-xs-4 col-md-9">&nbsp;      
                            <?php  if(empty($UserSettings_Ads)){ ?>
                                <img  class="img-responsive ads-image" src="../ads/default-ads.png" >            
                            <?php }else{ ?> 
                                <img  class="img-responsive ads-image" src="../ads/<?php echo $UserSettings_Ads->photo; ?>" >  
                                <span><?php echo $UserSettings_Ads->title; ?></span> <span class="float-right"><i><a href="<?php echo $UserSettings_Ads->link; ?>"><?php echo $UserSettings_Ads->link; ?></a></i></span>          
                            <?php } ?>         
                     </div>

                     <div class="col-md-12 line"></div>                
         </div>
        
                                
</section>
<section>
          
          <div class="col-xs-12  col-md-12 content-panel-header"><h3>Admin Area</h3></div>

        <div class="col-xs-12 col-md-12 content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title"></p>
                         <button class="admin-ads-button"  data-toggle="modal" data-target="#AdminAds">UPDATE</button>
                     </div>
                     <div class="col-xs-4 col-md-9">&nbsp;      
                             <?php  if(empty($AdminDashboard_Ads)){ ?>
                                <img  class="img-responsive ads-image" src="../ads/default-ads.png" >            
                               <?php }else{ ?> 
                                <img  class="img-responsive ads-image" src="../ads/<?php echo $AdminDashboard_Ads->photo; ?>" >  
                                <span><?php echo $AdminDashboard_Ads->title; ?></span> <span class="float-right"><i><a href="<?php echo $AdminDashboard_Ads->link; ?>"><?php echo $AdminDashboard_Ads->link; ?></a></i></span>          
                               <?php } ?>           
                     </div>

                     <div class="col-md-12 line"></div>                
         </div>

            
                                
</section>
                  
<section class="setting-foot">
             <div class="col-xs-12 col-md-12  content-panel">
                    <div class="content-profile">
                        <center>&nbsp;</center>
                    </div>
            </div>   
</section>  

</content> 

                
</div>
@endsection

  <!-- Modal for userDashboard -->
                   <section class="upeducation_modal">

                                                 <div class="modal fade" id="userDashboardAds" role="dialog">

                                                      <div class="modal-dialog">
                                                      
                                                        <!-- Modal content-->
                                                        <div class="modal-content">


                                                         <?php  if(empty($UserDashboard_Ads)){ ?>
                                                                  <form method="POST" action="/ads/addAds/dashboard" class="theme1"  enctype="multipart/form-data">
                                                         <?php }else{ ?> 
                                                                    <form method="POST" action="/ads/updateAds/dashboard/" class="theme1"  enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?php echo $UserDashboard_Ads->id; ?>" >

                                                         <?php } ?>     
                                                      
                                                            {{ csrf_field() }}  
                                                                            
                                                                            <div class="col-md-12 content-panel-header">
                                                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                               <h3>Update Ads in Users Dashboard </h3>

                                                                            </div>
                                                                            <section>
                                                                                    

                                                                                 <div class="form-group form-group">

                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Title" type="text" placeholder="Title">

                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Link" type="text" placeholder="Link">
                                                                                  </div>
                                                                                </div>


                                                                                   <div class="form-group form-group">
                                                                                    <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                    &nbsp;
                                                                                       <p>Image</p>
                                                                                      </div>
                                                                                     <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                        <input class="form-control adsfile" name="image" type="file" placeholder="image">
                                                                                    
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

<!-- Modal for userDashboard -->


<!-- Modal for userProfile -->
                   <section class="upeducation_modal">

                                                 <div class="modal fade" id="userProfileAds" role="dialog">

                                                      <div class="modal-dialog">
                                                      
                                                        <!-- Modal content-->
                                                        <div class="modal-content">


                                                         <?php  if(empty($UserProfile_Ads)){ ?>
                                                                  <form method="POST" action="/ads/addAds/profile" class="theme1"  enctype="multipart/form-data">
                                                         <?php }else{ ?> 
                                                                    <form method="POST" action="/ads/updateAds/profile/" class="theme1"  enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?php echo $UserProfile_Ads->id; ?>" >

                                                         <?php } ?>     
                                                      
                                                            {{ csrf_field() }}  
                                                                            
                                                                            <div class="col-md-12 content-panel-header">
                                                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                               <h3>Update Ads in Users Profile </h3>

                                                                            </div>
                                                                            <section>
                                                                                    

                                                                                 <div class="form-group form-group">

                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Title" type="text" placeholder="Title">

                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Link" type="text" placeholder="Link">
                                                                                  </div>
                                                                                </div>


                                                                                   <div class="form-group form-group">
                                                                                    <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                    &nbsp;
                                                                                       <p>Image</p>
                                                                                      </div>
                                                                                     <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                        <input class="form-control adsfile" name="image" type="file" placeholder="image">
                                                                                    
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

  <!-- Modal for userProfile -->



<!-- Modal for userSettings -->
                   <section class="upeducation_modal">

                                                 <div class="modal fade" id="userSettingsAds" role="dialog">

                                                      <div class="modal-dialog">
                                                      
                                                        <!-- Modal content-->
                                                        <div class="modal-content">


                                                         <?php  if(empty($UserSettings_Ads)){ ?>
                                                                  <form method="POST" action="/ads/addAds/settings" class="theme1"  enctype="multipart/form-data">
                                                         <?php }else{ ?> 
                                                                    <form method="POST" action="/ads/updateAds/settings/" class="theme1"  enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?php echo $UserSettings_Ads->id; ?>" >

                                                         <?php } ?>     
                                                      
                                                            {{ csrf_field() }}  
                                                                            
                                                                            <div class="col-md-12 content-panel-header">
                                                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                               <h3>Update Ads in Users Settings </h3>

                                                                            </div>
                                                                            <section>
                                                                                    

                                                                                 <div class="form-group form-group">

                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Title" type="text" placeholder="Title">

                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Link" type="text" placeholder="Link">
                                                                                  </div>
                                                                                </div>


                                                                                   <div class="form-group form-group">
                                                                                    <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                    &nbsp;
                                                                                       <p>Image</p>
                                                                                      </div>
                                                                                     <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                        <input class="form-control adsfile" name="image" type="file" placeholder="image">
                                                                                    
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

  <!-- Modal for userSettings -->


<!-- Modal for AdminAds -->
                   <section class="upeducation_modal">

                                                 <div class="modal fade" id="AdminAds" role="dialog">

                                                      <div class="modal-dialog">
                                                      
                                                        <!-- Modal content-->
                                                        <div class="modal-content">


                                                         <?php  if(empty($AdminDashboard_Ads)){ ?>
                                                                  <form method="POST" action="/ads/addAds/adminAds" class="theme1"  enctype="multipart/form-data">
                                                         <?php }else{ ?> 
                                                                    <form method="POST" action="/ads/updateAds/adminAds/" class="theme1"  enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?php echo $AdminDashboard_Ads->id; ?>" >

                                                         <?php } ?>     
                                                      
                                                            {{ csrf_field() }}  
                                                                            
                                                                            <div class="col-md-12 content-panel-header">
                                                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                               <h3>Update Ads in Admin </h3>

                                                                            </div>
                                                                            <section>
                                                                                    

                                                                                 <div class="form-group form-group">

                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Title" type="text" placeholder="Title">

                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control job_input" name="ads_Link" type="text" placeholder="Link">
                                                                                  </div>
                                                                                </div>


                                                                                   <div class="form-group form-group">
                                                                                    <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                    &nbsp;
                                                                                       <p>Image</p>
                                                                                      </div>
                                                                                     <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                                        <input class="form-control adsfile" name="image" type="file" placeholder="image">
                                                                                    
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

  <!-- Modal for AdminAds -->


























<?php } ?>



