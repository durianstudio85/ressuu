@extends('layouts.app')

@section('title')
   | Dashboard
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

                      <?php if($user_notification > 5){ ?>
                              <ul class="dropdown-menu drop-message" style="overflow-y:scroll;height:333px;">
                      <?php }else{ ?>
                              <ul class="dropdown-menu drop-message">
                      <?php } ?>

                      <?php foreach ($user_list_notification as $user_value) { ?>
                          <?php $checkProfile = DB::table('profiles')->where('user_id',$user_value->user_id)->count(); ?> 
                          <?php $profileInfo = DB::table('profiles')->where('user_id',$user_value->user_id)->first(); ?>
                          <?php $userInfo = DB::table('users')->where('id',$user_value->user_id)->first(); ?>
                        
                            <li>
                              <a href="" data-toggle="modal" data-target="#checkusernotification_{{ $user_value->id }}">
                                 <?php if($checkProfile == 0 or empty($profileInfo->profile_picture) or $profileInfo->profile_picture == " "){ ?>
                                       <img class="img-responsive notification-img" src="profilepic/default_avatar.jpg">
                                 <?php }else{ ?> 
                                        <img class="img-responsive notification-img" src="profilepic/{{ $profileInfo->profile_picture }}">
                                 <?php } ?>
                                <?php if($checkProfile == 0){ ?>
                                     <span class="title"><b><?php echo $userInfo->name; ?></b> followed you</span><br>
                                <?php }else{ ?> 
                                     <span class="title"><b><?php echo $profileInfo->name; ?></b> followed you</span><br>
                                <?php } ?> 
                                 
                                  <span class="glyphicon glyphicon-time calendar-icon"></span>
                                  <span class="date">
                                  <?php
                                        if(!empty($user_value->date)){
                                         
                                           $value_date = date("Y-m-d", strtotime( $user_value->date ) );
                                           $from=date_create(date('Y-m-d'));
                                           $to=date_create($value_date);
                                           $diff=date_diff($to,$from);
                                           $days_diff = $diff->format('%a');

                                           if($days_diff == "0"){
                                            echo "Just now";
                                           }else{
                                            echo $diff->format('%a Days Ago');
                                           }
                                        }

                                 ?>
                                 
                               </span>

                              </a>
                            </li>

                      <?php } ?>
                       <div class="see_all">
                          <a href="{{ url('/all/usernotification/') }}">See All</a>
                      </div>
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

                      <?php if($no_message > 5){ ?>
                              <ul class="dropdown-menu drop-message" style="overflow-y:scroll;height:333px;">
                      <?php }else{ ?>
                                <ul class="dropdown-menu drop-message">
                      <?php } ?>

                        <?php foreach ($list_message as $message_value) { ?>
                            <li>
                                <a href="" data-toggle="modal" data-target="#checkmessage_{{ $message_value->id }}">
                                   <img class="img-responsive notification-img" src="images/messenger_icon.png">
                                   <span class="title">Message from {{ $message_value->name }}</span><br>
                                   <span class="glyphicon glyphicon-time calendar-icon"></span>
                                   <span class="date">
                                      <?php
                                            if(!empty($message_value->date)){
                                             
                                               $value_date = date("Y-m-d", strtotime( $message_value->date ) );
                                               $from=date_create(date('Y-m-d'));
                                               $to=date_create($value_date);
                                               $diff=date_diff($to,$from);
                                               $days_diff = $diff->format('%a');

                                               if($days_diff == "0"){
                                                echo "Just now";
                                               }else{
                                                echo $diff->format('%a Days Ago');
                                               }
                                            }

                                     ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <div class="see_all">
                            <a href="{{ url('/message') }}">See All</a> 
                        </div>
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

                    <?php if($job_notification > 5){ ?>

                          <ul class="dropdown-menu drop-message" style="width: 400px;overflow:hidden;text-overflow: ellipsis ellipsis; text-align: left;word-wrap: break-word !important; ">
                              
                    <?php }else{ ?>

                          <ul class="dropdown-menu drop-message">

                    <?php } ?>

                        <?php foreach ($job_list_notification as $job_value) { ?>

                          <?php  $jobInfo = DB::table('job')->where('id',$job_value->category_id)->first();    ?>
                             <li>
                                <a href="" data-toggle="modal" data-target="#checkjobnotification_{{ $job_value->category_id }}">
                                   <img class="img-responsive notification-img" src="images/jobicon.png">
                                   <div class="title">Hiring overflow:hidden;text-overflow: ellipsis ellipsis; text-align: left;word-wrap: break-word <b><?php echo $jobInfo->company_job; ?></b> from <?php echo $jobInfo->company_name; ?></div><br>
                                   <span class="glyphicon glyphicon-time calendar-icon"></span>
                                   <span class="date">
                                      <?php
                                            if(!empty($job_value->date)){
                                             
                                               $value_date = date("Y-m-d", strtotime( $job_value->date ) );
                                               $from=date_create(date('Y-m-d'));
                                               $to=date_create($value_date);
                                               $diff=date_diff($to,$from);
                                               $days_diff = $diff->format('%a');

                                               if($days_diff == "0"){
                                                echo "Just now";
                                               }else{
                                                echo $diff->format('%a Days Ago');
                                               }
                                            }
                                     ?>
                                    </span>
                                </a>
                            </li>
                           
                        <?php } ?>
                               <div class="see_all">
                                <a href="{{ url('/all/jobNotification/') }}">See All</a> 
                              </div>

                          </ul>

                    <?php } ?>
                    <!---->
                  </li> 

              </ul>
        </nav>
         <div class="col-md-4 col-sm-12">
            <div class="inner-addon left-addon">
                <span class="glyphicon glyphicon-search"></span>
                <input class="form-control input-md searchbox" type="text" placeholder="Search">
            </div>
        </div>
        <nav class="col-md-2 col-sm-12 navicon right-navigation" style="">
            <ul>
                <a href="{{ url('/setting') }}"><li><span class="glyphicon glyphicon-cog"></span></li></a> 
                <a href="{{ url('/logout') }}"><li><span class="glyphicon glyphicon-off"></span></li></a>   
            </ul>
        </nav>
        <div class="row hiddenmenu ">
              <ul>
                  <li><a href="{{ url('/home') }}">Dashboard</a></li>
                  <li><a href="{{ url('/profile') }}">My CV</a></li>
                  <li><a href="{{ url('/profile') }}">Profile</a></li>
                  <li><a href="{{ url('/message') }}">Messages</a></li>
                  <li><a href="{{ url('/connection') }}">Connections</a></li>
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
                <div class="col-md-12 col-xs-12 user">
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
                 <div class="col-md-12 col-xs-12 name-panel">
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

              <div class="row panel-status">
                        <div class="col-md-4 col-sm-4 panel-status-1">
                            <span class="glyphicon glyphicon-heart"></span>
                            <p><?php echo $count_like; ?></p>  
                        </div>                                     
                        <div class="col-md-4 col-sm-4 panel-status-2">
                           <span class="glyphicon glyphicon-user"></span>
                            <p><?php echo $count_connection; ?></p>  
                        </div>
                        <div class="col-md-4 col-sm-4 panel-status-3">
                            <span class="glyphicon glyphicon-eye-open"></span>
                            <p><?php echo $count_view; ?></p>  
                        </div>
              </div>

             <nav class="row sidebar-menus">
                  <ul>
                    <a href="{{ url('/home') }}"><li  class="menuactive"><span class="glyphicon glyphicon-inbox">&nbsp;</span>Dashboard</li></a>

                     <?php if ($if_exist_settings == 1) { ?>

                         <a href="https://ressuu.me/cv/<?php echo $userSettings->permalink; ?>" target="_blank" ><li><span class="glyphicon glyphicon-list-alt">&nbsp;</span>My CV</li></a>
                         
                     <?php } ?> 
                    <!----> 
                    <?php if($no_message == 0){ ?>
                      <a href="{{ url('/message') }}"><li class=""><span class="glyphicon glyphicon-envelope">&nbsp;</span>Messages</li></a>                           
                    <?php }else { ?> 
                      <a href="{{ url('/message') }}"><li class=""><span class="glyphicon glyphicon-envelope">&nbsp;</span>Messages</li><span class="jobbagde"><?php echo $no_message;?></a>   
                    <?php } ?>
                    <!---->
                    <a href="{{ url('/connection') }}"><li><span class="glyphicon glyphicon-globe">&nbsp;</span>Connnections</li></a>
                    <a href="{{ url('/profile') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Profile</li></a>
                    <a href="{{ url('/resume') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                    <a href="{{ url('/portfolio') }}"><li><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                    <a href="{{ url('/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde"><?php echo $count_job; ?></span></a>    
                  </ul>
              </nav>

</sidebar>
 
<content class="col-sm-12 col-md-9 hpage"> 

 <?php // if(empty($userAds)){ ?>

  <!-- <a href="#" target="_blank"> 
    <section class="col-xs-12 col-md-12 content-header ads-bg" style="background:url('../ads/default-ads.png')">
      <div class="col-xs-12 col-md-12 content-people-wrap "></div>
    </section>
  </a> -->

<?php //}else{ ?> 

  <!-- <a href="<?php //echo $userAds->link; ?>" target="_blank"> 
    <section class="col-xs-12 col-md-12 content-header ads-bg" style="background:url('../ads/<?php //echo $userAds->photo; ?>')">
      <div class="col-xs-12 col-md-12 content-people-wrap "> </div>
    </section>
  </a> -->

<?php //} ?> 


<section class="col-md-12 content-header">
  
    <div class="col-md-12">
      <h3>People You May Know</h3>     
    </div>
    <?php $userId = Auth::id(); ?>
    <div class="col-md-12">

    <?php foreach ($follow_list as $value) { ?>

     



        <?php if($value->id != $userId){ ?>  

        <?php  $check_followed_user = DB::table('connection_requests')->where(['from_user_id'=>$userId,'to_user_id'=>$value->id,'status'=>"ACCEPT"])->count(); ?>
        <?php  $check_followed_user_pending = DB::table('connection_requests')->where(['from_user_id'=>$userId,'to_user_id'=>$value->id,'status'=>"PENDING"])->count(); ?>
        
        <?php 
              $followed_profile_exists = DB::table('profiles')->where('user_id',$value->id)->count(); 
              $check_followed_profile = DB::table('profiles')->where('user_id',$value->id)->first();
         ?>

            <?php if($check_followed_user == 0 AND $check_followed_user_pending == 0){ ?>

                        <div class="col-md-4 col-xs-12 content-profile-people"> 
                                <div class="col-md-5 col-xs-2 people-img">
                                  <?php if($followed_profile_exists == 0 or empty($check_followed_profile->profile_picture) or $check_followed_profile->profile_picture == " " ){ ?>
                                            <img class="profile-pic" src="profilepic/default_avatar.jpg"/> 
                                      <?php }else{ ?>
                                            <img class="profile-pic" src="profilepic/<?php echo $check_followed_profile->profile_picture; ?>"/> 
                                  <?php } ?>
                                </div>
                                <div class="col-md-7 col-xs-10 people-status">
                                 
                                    <?php if($followed_profile_exists == 0 ){ ?>
                                           <p class="people-name">{{ $value->name }}</p>
                                      <?php }else{ ?>
                                           <p class="people-name">{{ $check_followed_profile->name }}</p> 
                                    <?php } ?>
                                     
                                    <?php if($followed_profile_exists == 0 ){ ?>
                                           <p class="people-subname">Not Set</p>
                                      <?php }else{ ?>
                                           <p class="people-subname">{{ $check_followed_profile->position }}</p> 
                                    <?php } ?>
                                  
                                 
                                      <a href="/follow/users/{{ $value->id }}" class="follow" style="text-transform:none;text-decoration:none;color:#fff;">Follow</a>
                                
                                </div>   
                                      
                              
                                                         
                          </div>
             <?php } ?>

         <?php } ?> 

     <?php } ?>
                </div>

</section>



<section class="cph-wrapper">
<div class="col-xs-12 col-md-12 post-panel content-panel-header">
            
            <div class="col-md-12" >
              <form method="POST" action="/user/post" class="theme1">
              {{ csrf_field() }}  
                    
                           <div class="form-group form-group">
                            <div class="col-md-12">
                             <textarea  name="post_content" class="form-control"  rows="4" cols="45" name="bio">What's on your mind?</textarea>  
                            </div>
                          </div>
                  
                     <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                  <div class="modal-footer">
                       <button type="submit" class="btn btn-default">Post</button>
                  </div>
              </form>
            </div>
         
</div>

<div class="col-xs-12 col-md-12 job-panel content-panel-header">
    <div class="row header-title">
        <h4>Jobs recommended for you</h4>
    </div>
   

    <?php foreach ($recommended_job as $job_recommend_info) { ?>

     
        <?php if($job_recommend_info->status != "DELETE"){ ?> 

              <?php  $if_apply = DB::table('applicant')->where(['user_id' => Auth::id(),'job_id'=>$job_recommend_info->id])->count(); ?> 
              
                    <?php if($if_apply == 0){ ?>  

                        <div class="col-md-12 job-recommended" >

                                   <div class="col-md-2">
                                      <img class="img-responsive job-logo" src="images/jobicon.png">
                                   </div> 
                                    <div class="col-md-10 job-details">
                                        <p class="job-title"><b>{{ $job_recommend_info->company_job }}</b></p>
                                        <p class="job-address">{{ $job_recommend_info->company_name }}, {{ $job_recommend_info->company_address }}</p>
                                   </div>
                       

                        </div>
              <?php } ?>

        <?php } ?>
      



    <?php } ?>
    

     <div class="col-md-12 footer-title">
              <a href="{{ url('/all/jobNotification/') }}">See All</a> 
    </div> 

</div>

<?php if ($if_exist == 1) { ?><!-- if -->

<?php  foreach ($timeline as $value) { ?><!-- foreach -->

<?php  if($value->category == "Job"){ ?><!-- if -->

<?php  $jobInfo = DB::table('job')->where('id',$value->category_id)->first(); ?> 

<?php  $alreay_apply = DB::table('applicant')->where(['user_id'=>Auth::id(),'job_id'=>$value->category_id])->count(); ?>

<?php  if($jobInfo->status != "DELETE"){ ?> 
  
<div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                <img class="img-responsive job-logo" src="images/jobicon.png">
                            </div>
                            <div class="col-sm-10 div">
                                  <h4><?php echo $jobInfo->company_name ?></h4>
                                  <p><?php echo $value->activity; ?> <a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc"> 
               <span class="glyphicon glyphicon-time dashboard-icon"></span>
                              <p>
                              <?php
                              
                              if(!empty($value->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $value->date ) );
                                 $from=date_create(date('Y-m-d'));
                                 $to=date_create($value_date);
                                 $diff=date_diff($to,$from);
                                 $days_diff = $diff->format('%a');

                                 if($days_diff == "0"){
                                  echo "Just now";
                                 }else{
                                  echo $diff->format('%a Days Ago');
                                 }


                              }

                               ?>
                               </p>
                                
            </div>

  </div>
    
  <!-- Modal for newsFeed -->
          <!-- Modal for viewJobs -->
                                      <section>

                                                 <div class="modal fade" id="newsfeed_{{ $value->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                    <?php if($alreay_apply == 0){ ?>
                                                        <form method="POST" action="/jobs/applyJobs" class="theme1">
                                                    <?php }else{ ?>
                                                        <form method="" action="" class="theme1">
                                                    <?php } ?>
                                                  
                                                      {{ csrf_field() }}
                                                               <input type="hidden" name="job_id" value="<?php echo $jobInfo->id; ?>">
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
                                                              <?php if($alreay_apply == 0){ ?>
                                                                  <button type="" class="btn btn-default">Apply</button> 
                                                              <?php }else{ ?>
                                                                  <button type="" class="btn btn-default" data-dismiss="modal">Already Apply</button> 
                                                              <?php } ?>
                                                                   
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for viewJobs -->
 <!-- Modal for newsFeed -->   
<?php } ?>  


<?php }if($value->category == "Send Message"){ ?> 


<?php  $messageInfo = DB::table('message')->where('id',$value->category_id)->count(); ?>   


 <div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                <?php if ($if_exist == 1) { ?>
      
                                <?php if(!empty($userProfile->profile_picture)  AND $userProfile->profile_picture != " " ){ ?>
                                  
                                   <img class="img-responsive profile-pic" src="images/messenger_icon.png">
                                <?php  }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg">
                                <?php } ?>

                                <?php }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg" >
                              <?php } ?> 
                            </div>
                            <div class="col-sm-10 div">
                                  <h4>
                                    <?php if ($messageInfo == 0) { ?>
                                         <?php echo$userProfile->name; ?>
                                    <?php } else { ?>  
                                         <?php echo$userProfile->name; ?>
                                    <?php } ?>
                                        
                                  </h4>
                                  <p><?php echo $value->activity; ?> <!--<a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a>--></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc">
             <span class="glyphicon glyphicon-time dashboard-icon"></span>      
                              <p><?php
                              
                              if(!empty($value->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $value->date ) );
                                 $from=date_create(date('Y-m-d'));
                                 $to=date_create($value_date);
                                 $diff=date_diff($to,$from);
                                 $days_diff = $diff->format('%a');

                                 if($days_diff == "0"){
                                  echo "Just now";
                                 }else{
                                  echo $diff->format('%a Days Ago');
                                 }


                              }

                               ?>
                               </p>
                                
            </div>

  </div>
<?php }if($value->category == "Accept Follower"){ ?> 

<?php  $connetion_info = DB::table('connection_requests')->where('id',$value->category_id)->first(); ?>

<?php  $followed_info = DB::table('profiles')->where('user_id',$connetion_info->from_user_id)->first(); ?>
<?php  $followed_user_info = DB::table('users')->where('id',$connetion_info->from_user_id)->first(); ?>
<?php  $check_followed = DB::table('profiles')->where('user_id',$connetion_info->from_user_id)->count(); ?>   

 <div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                              <?php if($check_followed == 0){ ?>
                                        <img src="profilepic/default_avatar.jpg" class="img-responsive profile-pic">
                                <?php }else{ ?> 
                                     <?php if(empty($followed_info->profile_picture) or $followed_info->profile_picture == " " ){ ?>
                                         <img src="profilepic/default_avatar.jpg" class="img-responsive profile-pic">
                                      <?php  }else{ ?>
                                          <img src="profilepic/{{ $followed_info->profile_picture }}" class="img-responsive profile-pic">  
                                      <?php } ?>
                                      
                                <?php } ?> 
                            </div>
                            <div class="col-sm-10 div">
                                  <h4>
                                    <?php if ($check_followed == 0) { ?>
                                         <?php echo$followed_user_info->name; ?>
                                    <?php } else { ?>  
                                         <?php echo$followed_info->name; ?>
                                    <?php } ?>
                                        
                                  </h4>
                                  <p><?php echo $value->activity; ?> <!--<a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a>--></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc"> 
             <span class="glyphicon glyphicon-time dashboard-icon"></span>     
                              <p><?php
                              
                              if(!empty($value->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $value->date ) );
                                 $from=date_create(date('Y-m-d'));
                                 $to=date_create($value_date);
                                 $diff=date_diff($to,$from);
                                 $days_diff = $diff->format('%a');

                                 if($days_diff == "0"){
                                  echo "Just now";
                                 }else{
                                  echo $diff->format('%a Days Ago');
                                 }


                              }

                               ?>
                               </p>
                                
            </div>

  </div>


<?php }if($value->category == "Accept Invitation"){ ?> 


<?php  $connetion_info = DB::table('connection_requests')->where('id',$value->category_id)->first(); ?>

<?php  $followed_info = DB::table('profiles')->where('user_id',$connetion_info->to_user_id)->first(); ?>
<?php  $followed_user_info = DB::table('users')->where('id',$connetion_info->to_user_id)->first(); ?>
<?php  $check_followed = DB::table('profiles')->where('user_id',$connetion_info->to_user_id)->count(); ?>   

 <div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                 <?php if($check_followed == 0){ ?>
                                        <img src="profilepic/default_avatar.jpg" class="img-responsive" >
                                <?php }else{ ?> 
                                     <?php if(empty($followed_info->profile_picture) or $followed_info->profile_picture == " " ){ ?>
                                         <img src="profilepic/default_avatar.jpg" class="img-responsive profile-pic" >
                                      <?php  }else{ ?>
                                          <img src="profilepic/{{ $followed_info->profile_picture }}" class="img-responsive profile-pic">  
                                      <?php } ?>
                                      
                                <?php } ?> 

                            </div>
                            <div class="col-sm-10 div">
                                  <h4>
                                    <?php if ($check_followed == 0) { ?>
                                         <?php echo$followed_user_info->name; ?>
                                    <?php } else { ?>  
                                         <?php echo$followed_info->name; ?>
                                    <?php } ?>
                                        
                                  </h4>
                                  <p><?php echo $value->activity; ?> <!--<a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a>--></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc"> 
             <span class="glyphicon glyphicon-time dashboard-icon"></span>     
                              <p><?php
                              
                              if(!empty($value->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $value->date ) );
                                 $from=date_create(date('Y-m-d'));
                                 $to=date_create($value_date);
                                 $diff=date_diff($to,$from);
                                 $days_diff = $diff->format('%a');

                                 if($days_diff == "0"){
                                  echo "Just now";
                                 }else{
                                  echo $diff->format('%a Days Ago');
                                 }


                              }

                               ?>
                               </p>
                                
            </div>

  </div>
<?php }if($value->category == "Like CV"){ ?> 

<?php  $likeCV_info = DB::table('like_view')->where('id',$value->category_id)->first(); ?>
<?php  $checklike = DB::table('like_view')->where('id',$value->category_id)->count(); ?>

<?php  $liked_info = DB::table('profiles')->where('user_id',$likeCV_info->from_user_id)->first(); ?>
<?php  $liked_user_info = DB::table('users')->where('id',$likeCV_info->from_user_id)->first(); ?>
<?php  $check_liked = DB::table('profiles')->where('user_id',$likeCV_info->from_user_id)->count(); ?>   



 <div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                 <?php if($check_liked == 0){ ?>
                                        <img src="profilepic/default_avatar.jpg" class="img-responsive profile-pic">
                                <?php }else{ ?> 
                                     <?php if(empty($liked_info->profile_picture) or $liked_info->profile_picture == " " ){ ?>
                                         <img src="profilepic/default_avatar.jpg" class="img-responsive" style="border-radius:85px;">
                                      <?php  }else{ ?>
                                          <img src="profilepic/{{ $liked_info->profile_picture }}" class="img-responsive profile-pic">  
                                      <?php } ?>
                                      
                                <?php } ?> 

                            </div>
                            <div class="col-sm-10 div">
                                  <h4>
                                    <?php if ($check_liked == 0) { ?>
                                         <?php echo$liked_user_info->name; ?>
                                    <?php } else { ?>  
                                         <?php echo$liked_info->name; ?>
                                    <?php } ?>
                                        
                                  </h4>
                                  <p><?php echo $value->activity; ?> <!--<a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a>--></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc"> 
             <span class="glyphicon glyphicon-time dashboard-icon"></span>     
                              <p><?php
                              
                              if(!empty($value->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $value->date ) );
                                 $from=date_create(date('Y-m-d'));
                                 $to=date_create($value_date);
                                 $diff=date_diff($to,$from);
                                 $days_diff = $diff->format('%a');

                                 if($days_diff == "0"){
                                  echo "Just now";
                                 }else{
                                  echo $diff->format('%a Days Ago');
                                 }


                              }

                               ?>
                               </p>
                                
            </div>

  </div>
<?php }if($value->category == "User Post"){ ?> 

<?php  $check_profile = DB::table('profiles')->where('user_id',$value->category_id)->count(); ?>   
<?php  $get_profile_info = DB::table('profiles')->where('user_id',$value->category_id)->first(); ?>
<?php  $get_user_info = DB::table('users')->where('id',$value->category_id)->first(); ?>


<div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                <?php if ($check_profile == 1) { ?>
      
                                <?php if(!empty($get_profile_info->profile_picture)  AND $get_profile_info->profile_picture != " " ){ ?>
                                  
                                   <img class="img-reponsive profile-pic" src="profilepic/<?php echo $get_profile_info->profile_picture; ?>">
                                <?php  }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg">
                                <?php } ?>

                                <?php }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg" >
                              <?php } ?> 
                            </div>
                            <div class="col-sm-10 div">
                                  <h4><?php echo$get_profile_info->name; ?></h4>
                                  <p><?php echo $value->activity; ?> <!--<a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a>--></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc">  
             <span class="glyphicon glyphicon-time dashboard-icon"></span>    
                              <p><?php
                              
                              if(!empty($value->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $value->date ) );
                                 $from=date_create(date('Y-m-d'));
                                 $to=date_create($value_date);
                                 $diff=date_diff($to,$from);
                                 $days_diff = $diff->format('%a');

                                 if($days_diff == "0"){
                                  echo "Just now";
                                 }else{
                                  echo $diff->format('%a Days Ago');
                                 }


                              }

                               ?>
                               </p>
                                
            </div>

  </div>








<?php }if($value->category != "Send Message" AND $value->category != "Job" AND $value->category != "Accept Invitation" AND $value->category != "Accept Follower" AND $value->category != "Like CV" AND $value->category != "User Post" ){ ?>

 <div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                <?php if ($if_exist == 1) { ?>
      
                                <?php if(!empty($userProfile->profile_picture)  AND $userProfile->profile_picture != " " ){ ?>
                                  
                                   <img class="img-reponsive profile-pic" src="profilepic/<?php echo $userProfile->profile_picture; ?>">
                                <?php  }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg">
                                <?php } ?>

                                <?php }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg" >
                              <?php } ?> 
                            </div>
                            <div class="col-sm-10 div">
                                  <h4><?php echo$userProfile->name; ?></h4>
                                  <p><?php echo $value->activity; ?> <!--<a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a>--></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc">  
             <span class="glyphicon glyphicon-time dashboard-icon"></span>    
                              <p><?php
                              
                              if(!empty($value->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $value->date ) );
                                 $from=date_create(date('Y-m-d'));
                                 $to=date_create($value_date);
                                 $diff=date_diff($to,$from);
                                 $days_diff = $diff->format('%a');

                                 if($days_diff == "0"){
                                  echo "Just now";
                                 }else{
                                  echo $diff->format('%a Days Ago');
                                 }


                              }

                               ?>
                               </p>
                                
            </div>

  </div>




<?php } ?><!-- if -->
 
<?php } ?><!-- foreach -->

<?php } ?><!-- if -->
 


<div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                <?php if ($if_exist == 1) { ?>
      
                                <?php if(!empty($userProfile->profile_picture)  AND $userProfile->profile_picture != " " ){ ?>
                                  <img class="img-reponsive profile-pic" src="profilepic/<?php echo $userProfile->profile_picture; ?>">
                                <?php  }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg">
                                <?php } ?>

                                <?php }else{ ?>
                                  <img class="img-responsive profile-pic" src="profilepic/default_avatar.jpg" >
                              <?php } ?> 
                            </div>
                            <div class="col-sm-10 div">
                                  <h4><?php echo$name; ?></h4>
                                  <p>Created New Account <a><span></span></a></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc">      
                              <p></p>
                              <!--<img src="images/like.png"><span>12</span>
                              <img src="images/comment.jpg"><span>12</span>  -->         
            </div>

</div>



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

<!-- Modal for JobNotification -->
  <section>
             <div class="modal fade" id="checkjobnotification_{{ $jobInfo->id }}" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content--> 
                <div class="modal-content">

                <form method="" action="" class="theme1">
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

                          <div class="modal-footer">
                              <button  class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#jobs_{{ $jobInfo->id }}">Apply</button> 
                              <a class="btn btn-default readJobNoti" href="/jobs/deleteJobNotification/<?php echo $job_value->id; ?>">Read</a>
                          </div>

                </form>

                </div>
      </div>
    </div>
  </section>
<!-- Modal for JobNotification -->
  
<!-- Modal for apply Job -->
  <section>

             <div class="modal fade" id="jobs_{{ $jobInfo->id }}" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">

                <form method="POST" action="/jobs/applyJobsinNotificaton" class="theme1">
                         {{ csrf_field() }}  
                            <input type="hidden" name="job_id" value="<?php echo $jobInfo->id; ?>" >
                            <input type="hidden" name="notification_id" value="<?php echo $job_value->id; ?>">

                           <div class="modal-header col-md-12 content-panel-header">
                                <h3>Applying for {{ $jobInfo->company_job }}</h3>
                           </div>
                                    
                           <div class="col-md-12  content-panel">
                                <div class="col-md-12">
                                    <h4>Do you want to apply as {{ $jobInfo->company_job }} in {{ $jobInfo->company_name }}? </h4>
                                </div>
                                
                           </div>      
                          
                             <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                          <div class="modal-footer">
                               <button type="submit" class="btn btn-default">Confirm</button> 
                          </div>
                </form>
                </div>
        
      </div>
    </div>

  </section>
<!-- Modal for apply Job -->

                           
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
                                      <?php if(empty($profile_info->profile_picture) or $profile_info->profile_picture == " " ){ ?>
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

                                <!-- Cv Link -->
                                <?php if($checksettings == 0){ ?>
                                      <h5><i>Not Set</i></h5>
                                <?php }else{ ?> 
                                      <h5><i><a href="#">https://ressuu.me/cv/{{ $settingInfo->permalink }}</a></i></h5>
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
