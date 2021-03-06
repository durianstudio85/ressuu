@extends('layouts.app')

@section('title')
   | Browse CV
@endsection

@section('body-class')

@endsection

@section('content')

<header class="">
   <nav class="navbar navbar-default navbar-static-top navs">
      <div class="container">
        <div class=" navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>  
         <div class="col-md-3 col-sm-12 logo"><a href="{{ url('/home') }}"><img src="images/logo.png"></a></div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <!-- <div id="navbar" class=""> -->
        <nav class="col-md-3 col-sm-12 navicon">
              <ul>
                  <li class="dropdown">
                   <!----> 
                    <?php if($user_notification == 0){ ?>
                       <span class="glyphicon glyphicon-user dropdown-toggle"></span>                         
                    <?php }else { ?> 
                        <span class="glyphicon glyphicon-user naviconactive dropdown-toggle" data-toggle="dropdown"><span class="badge">
                    <?php  echo $user_notification;?></span></span>
                        <ul class="dropdown-menu drop-message">
                        <?php foreach ($user_list_notification as $user_value) { ?>
                            <?php $checkProfile = DB::table('profiles')->where('user_id',$user_value->user_id)->count(); ?> 
                            <?php $profileInfo = DB::table('profiles')->where('user_id',$user_value->user_id)->first(); ?>
                            <?php $userInfo = DB::table('users')->where('id',$user_value->user_id)->first(); ?>
                            <?php if($checkProfile == 0){ ?> 
                              <li><a href="" data-toggle="modal" data-target="#checkusernotification_{{ $user_value->id }}"><span><?php echo $userInfo->name; ?> followed you</span></a></li>
                            <?php }else{ ?> 
                              <li><a href="" data-toggle="modal" data-target="#checkusernotification_{{ $user_value->id }}"><span><?php echo $profileInfo->name; ?> followed you</span></a></li>
                            <?php } ?>
                            
                        <?php } ?>
                       </ul>
                    <?php } ?>
                    <!---->
                  </li>
                  <li class="dropdown">
                   <!----> 
                    <?php if($no_message == 0){ ?>
                       <span class="glyphicon glyphicon-comment dropdown-toggle"></span>                         
                    <?php }else { ?> 
                        <span class="glyphicon glyphicon-comment naviconactive dropdown-toggle" data-toggle="dropdown"><span class="badge">
                      <?php  echo $no_message;?></span></span>
                        <ul class="dropdown-menu drop-message">
                        <?php foreach ($list_message as $message_value) { ?>
                            <li><a href="" data-toggle="modal" data-target="#checkmessage_{{ $message_value->id }}"><span>Message from {{ $message_value->name }}</span></a></li>
                        <?php } ?>
                       </ul>
                    <?php } ?>
                    <!---->
                  </li>
                  <li class="dropdown">
                   <!----> 
                    <?php if($job_notification == 0){ ?>
                       <span class="glyphicon glyphicon-briefcase dropdown-toggle"></span>                         
                    <?php }else { ?> 
                        <span class="glyphicon glyphicon-briefcase naviconactive dropdown-toggle" data-toggle="dropdown"><span class="badge">
                    <?php  echo $job_notification;?></span></span>
                        <ul class="dropdown-menu drop-message">
                        <?php foreach ($job_list_notification as $job_value) { ?>
                          <?php  $jobInfo = DB::table('job')->where('id',$job_value->category_id)->first();    ?>
                            <li><a href="" data-toggle="modal" data-target="#checkjobnotification_{{ $job_value->category_id }}"><span>New job post from <?php echo $jobInfo->company_name; ?></span></a></li>
                        <?php } ?>
                       </ul>
                    <?php } ?>
                    <!---->
                  </li>  
              </ul>
        </nav>
    
       


          <div class="col-md-6 col-sm-12 ">
               <div class="inner-addon left-addon">
                <span class="glyphicon glyphicon-search"></span>
                <input class="form-control input-lg searchbox " type="text" placeholder="Search">
                </div>
        </div>
         <div class="row hiddenmenu ">
              <ul>
                  <li><a href="{{ url('/home') }}">Dashboard</a></li>
                  <li><a href="{{ url('/profile') }}">My CV</a></li>
                  <li><a href="{{ url('/profile') }}">Profile</a></li>
                  <li><a href="{{ url('/resume') }}">Resume</a></li>
                  <li><a href="{{ url('/portfolio') }}">Portfolio</a></li>
                  <li><a href="{{ url('/jobs') }}">Jobs</a></li>
                  <li><a href="{{ url('/setting') }}">Settings</a></li>
                  <li><a href="{{ url('/logout') }}">Logout</a></li>
              </ul>
         </div>  
        



        </div>
      </div>
    </nav>
    
</header> 


<div class="container wrap">
<sidebar class="col-md-3 col-sm-12">
               <div class="row user-tabs">
                <div class="user">
                  <?php if ($if_exist == 1) { ?>
      
                    <?php if(!empty($userProfile->profile_picture) AND $userProfile->profile_picture != " " ){ ?>
                       <a href="#" data-toggle="modal" data-target="#profilepic" ><img class="img-reponsive profile-pic" src="profilepic/<?php echo $userProfile->profile_picture; ?>"></a> 
                    <?php  }else{ ?>
                       <a href="#" data-toggle="modal" data-target="#profilepic" ><img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg"></a> 
                    <?php } ?>

                    <?php }else{ ?>
                       <a href="#" data-toggle="modal" data-target="#profilepic" ><img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg" ></a>
                  <?php } ?>     
                <!-- Modal for profilepic -->
                      <section class="profilepic">

                          <div class="modal fade" id="profilepic" role="dialog">
                              <div class="modal-dialog modal-sm">
                                                  
                                                    <!-- Modal content-->
                                  <div class="modal-content">

                                  <form method="POST" action="apply/upload" enctype="multipart/form-data" files="true">
                              {{ csrf_field() }}
                                         <div class="modal-header">
                                            <h5>Change Profile Pic</h5>
                                          </div>
                                                                        
                                          <div class="col-md-12 content-panel-header profile_wrap">
                                              
                                              <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                                  <input class="form-control" name="image" type="file" id="icondemo" style="height:20px;">
                                              </div>
                                                
                                           </div>


                                          </div>

                                          
                                          <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                                        <div class="modal-footer">
                                             <button type="submit" class="btn btn-default">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>    
                                        </div>
                                  </form>
                                  </div>
                                            
                              </div>
                           </div>

                        </section>
                  <!-- Modal for profilepic -->
                </div>
                 <div class="name-panel">
                   <div class="name-panel">
                   <p class="name">
                   <?php if ($if_exist == 1) { ?>
                         <?php echo $userProfile->name; ?>   
                    <?php }else{ ?>
                        {{ $name }}
                    <?php } ?> 
                   </p>
                   <p class="subname">
                    <?php if ($if_exist == 1) { ?>
                         <?php echo $userProfile->position; ?>   
                    <?php }else{ ?>
                       Not Set!
                    <?php } ?>
                    </p>
                 </div>
                 </div>
              </div>

              <div class="row panel-status">
                        <div class="col-md-4 col-sm-4 panel-status-1">
                            <img src="images/heart.png"> 
                            <p>2,718</p>
                        </div>                                     
                        <div class="col-md-4 col-sm-4 panel-status-2">
                            <img src="images/users.png">
                            <p>5,718</p>  
                        </div>
                        <div class="col-md-4 col-sm-4 panel-status-3">
                            <img src="images/eye.png">
                            <p>6,718</p>  
                        </div>
              </div>



             <nav class="row sidebar-menus">
                  <ul>
                        <a href="{{ url('/home') }}"><li><span class="glyphicon glyphicon-inbox">&nbsp;</span>Dashboard</li></a>

                        <?php if ($if_exist_settings == 1) { ?>
                        <a href="https://ressuu.me/cv/<?php echo $userSettings->permalink; ?>" target="_blank" ><li><span class="glyphicon glyphicon-list-alt">&nbsp;</span>My CV</li></a>  
                        <?php } ?> 
                        <!----> 
                        <?php if($no_message == 0){ ?>
                          <a href="{{ url('/message') }}"><li class=""><span class="glyphicon glyphicon-envelope">&nbsp;</span>Message</li></a>                           
                        <?php }else { ?> 
                          <a href="{{ url('/message') }}"><li class=""><span class="glyphicon glyphicon-envelope">&nbsp;</span>Message</li><span class="jobbagde"><?php echo $no_message;?></a>   
                        <?php } ?>
                        <!---->
                        <a href="{{ url('/connection') }}"><li><span class="glyphicon glyphicon-globe">&nbsp;</span>Connnection</li></a>
                        <a href="{{ url('/cvlist') }}"><li  class="menuactive"><span class="glyphicon glyphicon-folder-open">&nbsp;</span>Browse CV</li></a>
                        <a href="{{ url('/profile') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Profile</li></a>
                        <a href="{{ url('/resume') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                        <a href="{{ url('/portfolio') }}"><li><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                        <a href="{{ url('/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde"><?php echo $count_job; ?></span></a>    
                        <a href="{{ url('/setting') }}"><li><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
                        <a href="{{ url('/logout') }}"><li><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li></a>
                  </ul>
              </nav>

</sidebar>
 
<content class="col-sm-12 col-md-9 hpage"> 

 <?php  if(empty($userAds)){ ?>

  <a href="#" target="_blank"> 
    <section class="col-xs-12 col-md-12 content-header ads-bg" style="background:url('../ads/default-ads.png')">
      <div class="col-xs-12 col-md-12 content-people-wrap "></div>
    </section>
  </a>

<?php }else{ ?> 

  <a href="<?php echo $userAds->link; ?>" target="_blank"> 
    <section class="col-xs-12 col-md-12 content-header ads-bg" style="background:url('../ads/<?php echo $userAds->photo; ?>')">
      <div class="col-xs-12 col-md-12 content-people-wrap "> </div>
    </section>
  </a>

<?php } ?> 





<section class="cph-wrapper">
       <?php foreach ($user_list as $user_info) { ?>
        <?php $userId = Auth::id(); ?>
       <?php  $if_profile_exist = DB::table('profiles')->where('user_id',$user_info->id)->count(); ?>
       <?php  $profile_info = DB::table('profiles')->where('user_id',$user_info->id)->first(); ?>
       <?php  $setting_info = DB::table('settings')->where('user_id',$user_info->id)->first(); ?>


         <?php if($user_info->id != $userId){ ?> 

           <?php  $checkCV = DB::table('settings')->where('user_id',$user_info->id)->count(); ?>

               <?php if($checkCV == 1){ ?> 

                   <div class="col-xs-12 col-md-12 content-panel-header">
                      <div class="col-xs-12 col-md-2 img">
                          <?php if($if_profile_exist == 0 or empty($profile_info->profile_picture) or $profile_info->profile_picture == " " ){ ?>
                            <img src="profilepic/default_avatar.jpg" class="img-responsive"> 
                          <?php }else{ ?>
                            <img class="img-responsive" src="profilepic/<?php echo $profile_info->profile_picture; ?>" > 
                          <?php } ?>  
                      </div>
                      <div class="col-xs-8 col-md-8 content-panel-jobs">
                           <?php if($if_profile_exist == 0){ ?>
                            <h4><?php  echo $user_info->name; ?></h4>
                          <?php }else{ ?>
                            <h4><?php echo $profile_info->name; ?></h4>
                          <?php } ?> 
                          
                          <?php if($if_profile_exist == 0 or empty($profile_info->position)){ ?>
                              <p>Not Set</p>
                          <?php }else{ ?>
                             <p><?php echo $profile_info->position; ?></p>
                          <?php } ?>  
                     </div>
                     <div class="col-xs-4 col-md-2"> 
                      <p>&nbsp;</p><br><br>
                          <div class="btn-group btn-group-xs" role="group" aria-label="...">
                            <?php if(empty($setting_info->permalink)){ ?> 
                              <a href="#" data-toggle="modal" type="button" class="btn btn-info">CV Link</a>
                            <?php }else{ ?> 
                              <a  target="_target" href="https://ressuu.me/cv/<?php echo $setting_info->permalink;  ?>" data-toggle="modal" type="button" class="btn btn-info">CV Link </a>
                            <?php } ?>
                          </div>       
                     </div>
                  </div>

              <?php } ?>

        <?php } ?>

      <?php } ?>  

</section>  













</content>        
<?php foreach ($list_message as $message_value) { ?>
 <!-- Modal -->
 <!-- Modal for viewMessage -->
              <section>
                         <div class="modal fade" id="checkmessage_{{ $message_value->id }}" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">

                            <form method="" action="jobs/addJob" class="theme1">
                                       <div class="modal-header col-md-12 content-panel-header">
                                            <h3>Message From {{ $message_value->name }}</h3>
                                       </div>
                                                
                                       <div class="col-md-12  content-panel">
                                            <div class="col-md-12">
                                                      <p>Name:&nbsp; {{ $message_value->name }} </p>
                                            </div>
                                       </div>      

                                       <div class="col-md-12  content-panel">
                                            <div class="col-md-12">
                                                      <p>Email:&nbsp; {{ $message_value->email }} </p>
                                            </div>                                                    
                                       </div> 
                                       <div class="col-md-12  content-panel">
                                            <div class="col-md-12">
                                                      <p>Message </p>
                                            </div>
                                            <div class="col-md-12">
                                                      <p>{{ $message_value->message }}</p>
                                            </div>
                                                          
                                       </div>

                                      <div class="modal-footer">
                                         <div class="btn-group">
                                             <button type="" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#replymessage_{{ $message_value->id }}">Reply</button>  
                                             <button type="" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#deletemessage_{{ $message_value->id }}">Delete</button>
                                             <button type="" class="btn btn-default" data-dismiss="modal">Close</button> 
                                         </div>
                                      </div>
                            </form>
                            </div>
                  </div>
                </div>
              </section>
<!-- Modal for viewMessage -->

<!-- Modal for viewMessage -->
              <section>
                         <div class="modal fade" id="replymessage_{{ $message_value->id }}" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">

                            <form method="POST" action="/message/sendtoClient" class="theme1">
                                      {{ csrf_field() }}  
                                       <div class="modal-header col-md-12 content-panel-header">
                                            <h3>Replay message of {{ $message_value->name }}</h3>
                                       </div>
                                          <input class="form-control" name="id" type="hidden" value="<?php echo $message_value->id; ?>">
                                          <input class="form-control" name="client_email" type="hidden" value="<?php echo $message_value->email; ?>">
                                        <div class="form-group form-group">
                                          <div class="col-md-offset-1 col-sm-10">
                                            <input class="form-control" name="sender_subject" type="text" placeholder="Subject">
                                          </div>
                                        </div>    

                                         <div class="form-group form-group">
                                            <div class="col-md-offset-1 col-md-10">
                                              <textarea class="form-control" name="sender_message" rows="5" cols="10">Message</textarea>
                                            </div>
                                           
                                          </div>
                                     <input type="hidden" value="{{ csrf_token() }}" name="_token" >

                                      <div class="modal-footer">
                                         <div class="btn-group">
                                             <button type="submit" class="btn btn-default">Send</button>  
                                             <button type="" class="btn btn-default" data-dismiss="modal">Close</button> 
                                         </div>
                                      </div>
                            </form>
                            </div>
                    
                  </div>
                </div>
              </section>
<!-- Modal for viewMessage -->

<!-- Modal for viewMessage -->
              <section>
                         <div class="modal fade" id="deletemessage_{{ $message_value->id }}" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">

                            <form method="POST" action="/message/delete" class="theme1">
                                      {{ csrf_field() }}  
                                       <div class="modal-header col-md-12 content-panel-header">
                                            <h3>Delete message of {{ $message_value->name }}</h3>
                                       </div>
                                          <input class="form-control" name="id" type="hidden" value="<?php echo $message_value->id; ?>">
                                          <input class="form-control" name="client_email" type="hidden" value="<?php echo $message_value->email; ?>">
                                          
                                          <div class="col-md-12 content-panel-header">
                                             <h3>Are you sure you want to delete this message?</h3>
                                          </div> 

                                     <input type="hidden" value="{{ csrf_token() }}" name="_token" >

                                      <div class="modal-footer">
                                         <div class="btn-group">
                                             <button type="submit" class="btn btn-default">Delete</button>  
                                             <button type="" class="btn btn-default" data-dismiss="modal">Close</button> 
                                         </div>
                                      </div>
                            </form>
                            </div>
                    
                  </div>
                </div>
              </section>
<!-- Modal for viewMessage -->

<!-- Modal -->   
<?php } ?>



<?php foreach ($job_list_notification as $job_value) { ?>


<?php $jobInfo = DB::table('job')->where('id',$job_value->category_id)->first();    ?>

<!-- Modal for viewMessage -->
  <section>
             <div class="modal fade" id="checkjobnotification_{{ $jobInfo->id }}" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content--> 
                <div class="modal-content">

                <form method="POST" action="/jobs/deleteJobNotification" class="theme1">
                  {{ csrf_field() }}  
                           <input type="hidden" name="id" value="<?php echo $job_value->id; ?>" >

                           <div class="modal-header col-md-12 content-panel-header">
                                <h3> {{ $jobInfo->company_job }}</h3>
                           </div>
                                    
                           <div class="col-md-12  content-panel">
                                <div class="col-md-4">
                                          <p>Company Name: </p>
                                </div>
                                <div class="col-md-7">
                                          <p>{{ $jobInfo->company_name }}</p>
                                </div>
                                      
                           </div>      

                           <div class="col-md-12  content-panel">
                                <div class="col-md-4">
                                          <p>Company Address: </p>
                                </div>
                                <div class="col-md-7">
                                          <p>{{ $jobInfo->company_address }}</p>
                                </div>
                                 
                           </div> 

                           <div class="col-md-12  content-panel">
                                <div class="col-md-4">
                                          <p>Salary Rate </p>
                                </div>  
                                <div class="col-md-7">
                                          <p class="job_salary">{{ $jobInfo->company_rate }}</p>
                                </div>
                                              
                           </div>

                           <div class="col-md-12  content-panel">
                                <div class="col-md-12">
                                          <p>About Company: </p>
                                </div>
                                <div class="col-md-12">
                                          <p>{{ $jobInfo->company_details }}</p>
                                </div>
                                              
                           </div>

                           <div class="col-md-12  content-panel">
                                <div class="col-md-12">
                                          <p>Job Description: </p>
                                </div>
                                <div class="col-md-12">
                                          <p>{!! nl2br( $jobInfo->company_status) !!}</p>
                                </div>
                                              
                           </div>
                           <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                          <div class="modal-footer">
                               <button type="submit" class="btn btn-default">Delete</button>
                               <button type="" class="btn btn-default" data-dismiss="modal">Close</button> 
                          </div>

                </form>

                </div>
      </div>
    </div>
  </section>
<!-- Modal for viewMessage -->
  
                           
<?php } ?> 


<?php foreach ($user_list_notification as $user_value) { ?>


<?php $profileInfo = DB::table('profiles')->where('user_id',$user_value->user_id)->first(); ?>
<?php $userInfo = DB::table('users')->where('id',$user_value->user_id)->first(); ?>
<?php $settingInfo = DB::table('settings')->where('user_id',$user_value->user_id)->first(); ?>

<?php $checkprofile = DB::table('profiles')->where('user_id',$user_value->user_id)->count(); ?>

<?php $checksettings = DB::table('settings')->where('user_id',$user_value->user_id)->count(); ?>


<!-- Modal for viewMessage -->
  <section>
             <div class="modal fade" id="checkusernotification_{{ $user_value->id }}" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content--> 
                <div class="modal-content">

                <form method="POST" action="/follow/deleteUserNotification" class="theme1">
                  {{ csrf_field() }}  
                           <input type="hidden" name="id" value="<?php echo $user_value->id; ?>" >
                           <div class="modal-header col-md-12 content-panel-header">
                            <h3>User Information</h3>      
                           </div>        

                           <div class="col-md-12 content-panel"><div class="col-md-12">&nbsp;</div></div>
                           <div class="content-panel">
                               <div class="col-md-4">
                                 <?php if($checkprofile == 0){ ?>
                                        <img src="profilepic/default_avatar.jpg" class="img-responsive" style="border-radius:85px;">
                                <?php }else{ ?> 
                                     <?php if(empty($profileInfo->profile_picture) or $profileInfo->profile_picture == " " ){ ?>
                                         <img src="profilepic/default_avatar.jpg" class="img-responsive" style="border-radius:85px;">
                                      <?php  }else{ ?>
                                          <img src="profilepic/{{ $profileInfo->profile_picture }}" class="img-responsive" style="border-radius:85px;">  
                                      <?php } ?>
                                      
                                <?php } ?>  
                               </div> 
                               <div class="col-md-8">
                                <!-- Name -->
                                <?php if($checkprofile == 0){ ?>
                                       <h2>{{ $userInfo->name }}</h2>
                                <?php }else{ ?> 
                                       <h2>{{ $profileInfo->name }}</h2>
                                <?php }?> 

                                <!-- Position -->
                                <?php if($checkprofile == 0){ ?>
                                       <h5><i>Not Set</i></h5>
                                <?php }else{ ?> 
                                       <h5><i>Position:&nbsp;&nbsp;{{ $profileInfo->position }}</i></h5>
                                <?php }?> 

                                <!-- Email -->
                                <?php if($checkprofile == 0){ ?>
                                       <h5><i>Not Set</i></h5>
                                <?php }else{ ?> 
                                      <h5><i>Email:&nbsp;&nbsp;{{ $profileInfo->email }}</i></h5>
                                <?php }?>

                                <!-- Bio -->
                                <?php if($checkprofile == 0){ ?>
                                       <p><i>Not Set</i></p>
                                <?php }else{ ?> 
                                      <p><i>{{ $profileInfo->bio }}</i></p>
                                <?php }?> 

                                <!-- Cv Link -->
                                <?php if($checksettings == 0){ ?>
                                      <h5><i>CV Link:&nbsp;&nbsp; Not Set</i></h5>
                                <?php }else{ ?> 
                                      <h5><i>CV Link:&nbsp;&nbsp;<a href="#">https://ressuu.me/cv/{{ $settingInfo->permalink }}</a></i></h5>
                                <?php }?>
                               </div> 


                           </div>

                          <div class="modal-footer">
                               <button type="submit" class="btn btn-default">Delete</button>
                               <button type="" class="btn btn-default" data-dismiss="modal">Close</button> 
                          </div>

                </form>

                </div>
      </div>
    </div>
  </section>
<!-- Modal for viewMessage -->
  
                           
<?php } ?>                         
           


</div>
@endsection
