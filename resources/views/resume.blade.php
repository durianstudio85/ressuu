@extends('layouts.app')


@section('title')
   | Resume
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
                                  <?php $string = "Hiring ".ucwords(strtolower($jobInfo->company_job))." from ".ucwords(strtolower($jobInfo->company_name));  ?>
                                   <?php $strlen = strlen($string);?>
                                 
                                          <span class="title"><?php echo substr($string,0,50); ?>...</span><br>
                                  
                                   
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

<sidebar class="col-md-3 ">

              <div class="row user-tabs">
                <div class="col-md-12 user">
                  <?php if ($if_exist == 1) { ?>
      
                    <?php if(!empty($userProfile->profile_picture) AND $userProfile->profile_picture != " "   ){ ?>
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
                 <div class="col-md-12 name-panel">
                   
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
                   <a href="{{ url('/home') }}"><li><span class="glyphicon glyphicon-inbox">&nbsp;</span>Dashboard</li></a>
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
                    <a href="{{ url('/resume') }}"><li class="menuactive"><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                    <a href="{{ url('/portfolio') }}"><li><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                    <a href="{{ url('/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde"><?php echo $count_job; ?></span></a>
                  </ul>
              </nav>

</sidebar>
<content class="col-xs-12 col-md-9">
 
 <?php  if(empty($userAds)){ ?>

  <a href="#" target="_blank"> 
    <section class="col-xs-12 col-md-12 content-header ads-bg" style="background:url('../ads/default-ads.png')">
      <div class="col-xs-12 col-md-12 content-people-wrap "></div>
    </section>
  </a>

<?php }else{ ?> 

  <a href="<?php echo $userAds->link; ?>" target="_blank"> 
    <section class="col-xs-12 col-md-12 rpage content-header ads-bg" style="background:url('../ads/<?php echo $userAds->photo; ?>')">
      
    </section>

  </a>
<?php } ?> 
<section class="col-xs-12 resume-title-header  tab-content">

   
        <div class="col-md-6">
          <h1>Resume</h1>
        </div>
     



</section>

<nav class="col-xs-12 content-nav-menu resume-nav " role="tablist">
            <ul class="">
              <li role="presentation" class="active"><a href="#tab1" role="tab" data-toggle="tab">Experience</a></li>
              <li role="presentation"><a href="#tab2" role="tab" data-toggle="tab">Education</a></li>
              <li role="presentation"><a href="#tab3" role="tab" data-toggle="tab">Skill</a></li>
              <li role="presentation"><a href="#tab4" role="tab" data-toggle="tab">Certification</a></li>
            </ul>
</nav>


<section  class="resume tab-content">

         <section role="tabpanel" class="tab-pane fade in active" id="tab1">

             <button class="resume-button" data-toggle="modal" data-target="#myModal1">Add Experience</button>

             @foreach ($userResume_Experience as $userExperience)
              
            <div class="col-xs-12 col-md-12 content-panel-header">
              <div class="col-xs-8 col-md-9">
                <h3>{{ $userExperience->job_title }}</h3>
              </div>
              <div class="col-xs-4 col-md-2 content-panel-pc">
                  <span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#exp_{{ $userExperience->id }}"></span>
                  <span class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#delexp_{{ $userExperience->id }}"></span>            
              </div>
            </div>
           
                  <div class="col-xs-12 col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p class="title">Company</p>
                             </div>
                             <div class="col-xs-8 col-md-9">                   
                                  <p>{{ $userExperience->company_name }}</p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>
                    <div class="col-xs-12 col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p class="title">Years</p>
                             </div>
                             <div class="col-xs-8 col-md-9">                   
                                  <p>{{ $userExperience->start_date }} - {{ $userExperience->end_date }}</p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>
                   <div class="col-xs-12 col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p class="title"><b>Description</b></p>
                             </div>
                             <div class="col-xs-8 col-md-9">                   
                                  <p>{{ $userExperience->description }}</p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>

                   <!-- Modal for updateExperience -->
                                      <section class="upexperience_modal">

                                                 <div class="modal fade" id="exp_{{ $userExperience->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="resume/updateExperience/{{ $userExperience->id }}" class="theme1">

                                                                        
                                                                        <div class="col-md-12 content-panel-header">
                                                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                           <h3>Update Experience</h3>

                                                                        </div>
                                                                        <section>

                                                                             <div class="form-group form-group">
                                                                              <div class="col-md-offset-1 col-sm-10">
                                                                                <input class="form-control" name="update_job_title" type="text" value="{{ $userExperience->job_title }}">
                                                                              </div>
                                                                            </div>

                                                                            <div class="form-group form-group">
                                                                              <div class="col-md-offset-1 col-sm-10">
                                                                                <input class="form-control" name="update_company" type="text" value="{{ $userExperience->company_name }}">
                                                                              </div>
                                                                            </div>

                                                                            <div class="form-group form-group">
                                                                              <div class="col-md-offset-1 col-md-5">
                                                                                <input class="form-control" name="update_start_date" type="text" value="{{ $userExperience->start_date }}">
                                                                              </div>
                                                                              <div class="col-md-5">
                                                                                <input class="form-control" name="update_end_date" type="text" value="{{ $userExperience->end_date }}">
                                                                              </div>
                                                                            </div>

                                                                           

                                                                            <div class="form-group form-group">
                                                                              <div class="col-md-offset-1 col-md-10">
                                                                                <textarea class="form-control" name="update_description" rows="5" cols="10">{{ $userExperience->description }}</textarea>
                                                                              </div>
                                                                             
                                                                            </div>

                                                                       </section>
                                                              <div class="modal-footer">
                                                                   <button type="submit" class="btn btn-default">Update</button> 
                                                                   <button type="button" data-dismiss="modal" class="btn btn-default">Close</button> 
                                                              </div>
                                                    </form>
                                            </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for updateExperience -->
                  <!-- Modal for deleteExperience -->
                                      <section class="delexperience_modal">

                                                 <div class="modal fade" id="delexp_{{ $userExperience->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="resume/deleteExperience/<?php echo $userExperience->id; ?>" class="theme1">
                                                               <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4>Delete this Experience?</h4>
                                                              </div>
                                                                        
                                                              <div class="col-md-12 content-panel-header">
                                                                    <h3>Are you sure you want to delete the experience about   {{ $userExperience->job_title }} ?</h3>

                                                              </div>

                                                              <div class="modal-footer">
                                                                   <button type="submit" class="btn btn-default">Delete</button>   
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for deleteExperience -->




            @endforeach

                  <section>
                              <div class="col-md-12 content-panel">
                                      <div class="content-experience">
                                          <center><button data-toggle="modal" data-target="#myModal1">Add Experience</button></center>
                                      </div>
                              </div>   
                  </section>



         </section>


         <section role="tabpanel" class="tab-pane  fade in" id="tab2">

            <button class="resume-button" data-toggle="modal" data-target="#myModal2">Add Education</button>

          @foreach ($userResume_Education as $userEducation)

            <div class="col-xs-12 col-md-12 content-panel-header">
              <div class="col-xs-8 col-md-9">
                <h3>{{  $userEducation->course }}</h3>
              </div>
              <div class="col-xs-4 col-md-2 content-panel-pc">
                  <span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#edu_{{ $userEducation->id }}"></span>
                  <span class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#deledu_{{ $userEducation->id }}"></span>             
              </div>
         

            </div>

                  <div class="col-xs-12 col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p  class="title">University/College</p>
                             </div>
                             <div class="col-xs-8 col-md-9">                   
                                <p>{{  $userEducation->school }}</p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>
                    <div class="col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p  class="title">Years</p>
                             </div>
                             <div class="col-xs-8 col-md-9">                   
                                  <p>{{  $userEducation->date_start }} - {{  $userEducation->date_end }} </p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>
                   <div class="col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p  class="title"><b>Award</b></p>
                             </div>
                             <div class="col-xs-8 col-md-9">                   
                                  <p>{{  $userEducation->awards_rec }}</p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>


                    <!-- Modal for updateEducation -->
                                      <section class="upeducation_modal">

                                                 <div class="modal fade" id="edu_{{ $userEducation->id }}" role="dialog">

                                                      <div class="modal-dialog">
                                                      
                                                        <!-- Modal content-->
                                                        <div class="modal-content">

                                                        <form method="" action="resume/updateEducation/{{ $userEducation->id }}" class="theme1">

                                                                            
                                                                            <div class="col-md-12 content-panel-header">
                                                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                               <h3>Update Education</h3>

                                                                            </div>
                                                                            <section>

                                                                                 <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control" name="update_course" type="text" value="{{ $userEducation->course }}">
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-sm-10">
                                                                                    <input class="form-control" name="update_school" type="text" value="{{ $userEducation->school }}">
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-md-5">
                                                                                    <input class="form-control" name="update_start_date" type="text" value="{{ $userEducation->date_start }}">
                                                                                  </div>
                                                                                  <div class="col-md-5">
                                                                                    <input class="form-control" name="update_end_date" type="text" value="{{ $userEducation->date_end }}">
                                                                                  </div>
                                                                                </div>

                                                                               

                                                                                <div class="form-group form-group">
                                                                                  <div class="col-md-offset-1 col-md-10">
                                                                                    <textarea class="form-control" name="update_award" rows="5" cols="10">{{ $userEducation->awards_rec }}</textarea>
                                                                                  </div>
                                                                                 
                                                                                </div>

                                                                           </section>

                                                                          <div class="modal-footer">
                                                                               <button type="submit" class="btn btn-default">Update</button>  
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                                          </div>
                                                        </form>

                                                        </div>
                                                
                                                      </div>

                                                </div>

                                      </section>
                  <!-- Modal for updateEducation -->
                  <!-- Modal for deleteEducation -->
                                      <section  class="upeducation_modal">

                                                 <div class="modal fade" id="deledu_{{ $userEducation->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="resume/deleteEducation/<?php echo $userEducation->id; ?>" class="theme1">
                                                               <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4>Delete Educational Background?</h4>
                                                              </div>
                                                                        
                                                              <div class="col-md-12 content-panel-header">
                                                                    <h3>Are you sure you want to delete your educational background about {{ $userEducation->course }}  in {{ $userEducation->school }} ?</h3>

                                                              </div>

                                                              <div class="modal-footer">
                                                                   <button type="submit" class="btn btn-default">Delete</button>   
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for deleteEducation -->

          @endforeach 
               
                  <section>
                              <div class="col-md-12 content-panel">
                                      <div class="content-experience">
                                          <center><button data-toggle="modal" data-target="#myModal2">Add Education</button></center>
                                      </div>
                              </div>   
                  </section>


        </section>



         <section role="tabpanel" class="tab-pane fade in" id="tab3">

         <button class="resume-button" data-toggle="modal" data-target="#myModal3">Add Skill</button>

          @foreach ($userResume_Skills as $userSkill)

            <div class="col-xs-12 col-md-12 content-panel-header skills-xs">
              <div class="col-xs-4 col-md-4">
                <h3>{{ $userSkill->skillname }}</h3>
              </div>
              <div class="col-xs-4 col-md-6">
                <input id="" value="{{ $userSkill->rate }}" type="number" class="rating" min=0 max=5 step=0.2 data-size="xs">
              </div>
              <div class="col-xs-4 col-md-2 content-panel-pc">
                  <span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#ski_{{ $userSkill->id }}"></span>
                  <span class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#delski_{{ $userSkill->id }}"></span>                     
              </div>
            </div> 

                    <!-- Modal for updateSkills -->
                    <section class="upskills_modal">

                               <div class="modal fade" id="ski_{{ $userSkill->id }}" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">

                                    <form method="" action="resume/updateSkill/{{ $userSkill->id}}" class="theme1">

                                                        <div class="col-md-12 content-panel-header">
                                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                           <h3>Update Skill</h3>

                                                        </div>

                                                        <section>

                                                             <div class="form-group form-group">
                                                              <div class="col-md-offset-1 col-sm-10">
                                                                <input class="form-control" name="skills" type="text" value="{{ $userSkill->skillname }}">
                                                              </div>
                                                            </div>

                                                            <div class="form-group form-group">
                                                              <div class="col-md-offset-1 col-sm-10">
                                                                <input type="number" value="{{ $userSkill->rate }}" class="form-control" name="rate" min=1 max=5 placeholder="Rate">
                                                              </div>
                                                            </div>

                                                            <div class="form-group form-group">
                                                              <div class="col-md-offset-1 col-md-10">
                                                                <textarea class="form-control" name="description" rows="5" cols="10">{{ $userSkill->description }}</textarea>
                                                              </div>
                                                             
                                                            </div>

                                                       </section>

                                              <div class="modal-footer">

                                                   <button type="submit" class="btn btn-default">Update</button>
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 

                                              </div>
                                          </form>
                                </div>
                                
                              </div>
                      </div>

                    </section>
                    <!-- Modal for updateSkills -->
                  <!-- Modal for deleteSkills -->
                                      <section class="delskills_modal">

                                                 <div class="modal fade" id="delski_{{ $userSkill->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="resume/deleteSkill/<?php echo $userSkill->id; ?>" class="theme1">
                                                               <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4>Delete Skills</h4>
                                                              </div>
                                                                        
                                                              <div class="col-md-12 content-panel-header">
                                                                    <h3>Are you sure you want to delete your skills in {{ $userSkill->skillname }}?</h3>
                                                              </div>

                                                              <div class="modal-footer">
                                                                   <button type="submit" class="btn btn-default">Delete</button>   
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for deleteSkills -->


          @endforeach 
               
                  <section>
                              <div class="col-md-12 content-panel">
                                      <div class="content-experience">
                                          <center><button data-toggle="modal" data-target="#myModal3">Add Skill</button></center>
                                      </div>
                              </div>   
                  </section>


        </section>



         <section role="tabpanel" class="tab-pane fade in" id="tab4">

          <button class="resume-button" data-toggle="modal" data-target="#myModal4">Add Certification</button>

          @foreach ($userResume_Certification as $userCertification)

            <div class="col-xs-12 col-md-12 content-panel-header">
              <div class="col-xs-8 col-md-9">
                <h3>{{  $userCertification->certificate_title }}</h3>
              </div>
              <div class="col-xs-4 col-md-2 content-panel-pc">       
                  <a href="#" data-toggle="modal" data-target="#cer_{{  $userCertification->id }}"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a href="#"  data-toggle="modal" data-target="#delcer_{{  $userCertification->id }}"><span class="glyphicon glyphicon-remove"></span></a>             
              </div>
         

            </div>

                  <div class="col-xs-12 col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p class="title">Awarded By:</p>
                             </div>
                             <div class="col-xs-8 col-md-9">                   
                                  <p>{{  $userCertification->certificate_company }}</p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>
                    <div class="col-xs-6 col-md-12  content-panel">
                             <div class="col-xs-4 col-md-3">
                                <p class="title">Years</p>
                             </div>
                             <div class="col-xs-8 col-xs-6 col-md-9">                   
                                  <p>{{  $userCertification->certificate_receive }} </p>            
                             </div>
                             <div class="col-md-12 line"></div>                
                   </div>

                  <!-- Modal for updateCertification -->
                    <section class="upcertification_modal">

                               <div class="modal fade" id="cer_{{ $userCertification->id }}" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">

                                <form method="" action="resume/updateCertification/{{ $userCertification->id }}" class="theme1">

                                                    <div class="col-md-12 content-panel-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h3>Update Certificate</h3>

                                                    </div>

                                                    <section>

                                                         <div class="form-group form-group">
                                                          <div class="col-md-offset-1 col-sm-10">
                                                            <input class="form-control" name="title" type="text" value="{{ $userCertification->certificate_title }}">
                                                          </div>
                                                        </div>

                                                         <div class="form-group form-group">
                                                          <div class="col-md-offset-1 col-sm-10">
                                                            <input class="form-control" name="company" type="text" value="{{ $userCertification->certificate_company }}">
                                                          </div>
                                                        </div>

                                                         <div class="form-group form-group">
                                                          <div class="col-md-offset-1 col-sm-10">
                                                            <input class="form-control" name="title" type="text" value="{{ $userCertification->certificate_receive }}">
                                                          </div>
                                                        </div>

                                                       

                                                   </section>

                                          <div class="modal-footer">

                                               <button type="submit" class="btn btn-default">Update</button>
                                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 

                                          </div>
                                </form>
                          </div>
                          
                        </div>
                      </div>

                    </section>
                    <!-- Modal for updateCertification -->
                    <!-- Modal for deleteCertification -->
                                      <section class="delcertification_modal">

                                                 <div class="modal fade" id="delcer_{{$userCertification->id}}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="/resume/deleteCertification/<?php echo $userCertification->id; ?>" class="theme1">
                                                              <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4>Delete Certification</h4>
                                                              </div>
                                                                        
                                                              <div class="col-md-12 content-panel-header">
                                                                    <h3>Are you sure you want to delete your certification in {{ $userCertification->certificate_title }}?</h3>
                                                              </div>

                                                              <div class="modal-footer">
                                                                   <button type="submit" class="btn btn-default">Delete</button>   
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for deleteCertification -->
 



          @endforeach 
               
                  <section>
                              <div class="col-md-12 content-panel">
                                      <div class="content-experience">
                                          <center><button data-toggle="modal" data-target="#myModal4">Add Certification</button></center>
                                      </div>
                              </div>   
                  </section>


        </section>





</section>

<!-- Modal for Experience -->
<section class="experience_modal">

           <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

                  <form method="" action="resume/addExperience" class="theme1">

                                      
                                      <div class="col-md-12 content-panel-header">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         <h3>Add Experience</h3>

                                      </div>
                                      <section>

                                           <div class="form-group form-group">
                                            <div class="col-xs-12 col-sm-10 col-md-offset-1 ">
                                              <input class="form-control" name="job_title" type="text" placeholder="Job Title">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                            <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="company" type="text" placeholder="Company Name">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                            <div class="col-xs-12 col-md-offset-1 col-md-5">
                                              <input class="form-control" name="start_date" type="text" placeholder="Start Date">
                                            </div>
                                            <div class="col-xs-12 col-md-5">
                                              <input class="form-control" name="end_date" type="text" placeholder="End Date">
                                            </div>
                                          </div>

                                         

                                          <div class="form-group form-group">
                                            <div class="col-xs-12 col-md-offset-1 col-md-10">
                                              <textarea class="form-control" name="description" rows="5" cols="10">Description</textarea>
                                            </div>
                                           
                                          </div>

                                     </section>
                            <div class="modal-footer">

                                 <button type="submit" class="btn btn-default">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                  </form>
              </div>
      
            </div>
          </div>

</section>
<!-- Modal for Experience -->




<!-- Modal for Education -->

<section class="education_modal">

           <div class="modal fade" id="myModal2" role="dialog">

            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

                <form method="" action="resume/addEducation" class="theme1">

                                    
                                    <div class="col-md-12 content-panel-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h3>Add Education</h3>

                                    </div>

                                    <section>

                                         <div class="form-group form-group">
                                          <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                            <input class="form-control" name="course" type="text" placeholder="Course">
                                          </div>
                                        </div>

                                        <div class="form-group form-group">
                                          <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                            <input class="form-control" name="school" type="text" placeholder="School">
                                          </div>
                                        </div>

                                        <div class="form-group form-group">
                                          <div class="col-xs-12 col-md-offset-1 col-md-5">
                                            <input class="form-control" name="start_date" type="text" placeholder="Start Date">
                                          </div>
                                          <div class="col-xs-12 col-md-5">
                                            <input class="form-control" name="end_date" type="text" placeholder="End Date">
                                          </div>
                                        </div>

                                       

                                        <div class="form-group form-group">
                                          <div class="col-xs-12 col-md-offset-1 col-md-10">
                                            <textarea class="form-control" name="award" rows="5" cols="10">Award</textarea>
                                          </div>
                                         
                                        </div>

                                   </section>

                                  <div class="modal-footer">

                                       <button type="submit" class="btn btn-default">Save</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                  </div>
                </form>

              </div>
      
             </div>

          </div>

</section>
<!-- Modal for Education -->


<!-- Modal for Skills -->
<section class="skills_modal">

           <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

                  <form method="" action="resume/addSkill" class="theme1">

                                      
                                      <div class="col-md-12 content-panel-header">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         <h3>Add Skill</h3>

                                      </div>

                                      <section>

                                           <div class="form-group form-group">
                                            <div class="col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="skills" type="text" placeholder="Skill">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                            <div class="col-md-offset-1 col-sm-10">
                                              <input type="number" class="form-control" name="rate" min=1 max=5 placeholder="Rate">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                            <div class="col-md-offset-1 col-md-10">
                                              <textarea class="form-control" name="description" rows="5" cols="10">Description</textarea>
                                            </div>
                                           
                                          </div>

                                     </section>

                            <div class="modal-footer">

                                 <button type="submit" class="btn btn-default">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                  </form>
              </div>
              
            </div>
          </div>

</section>
<!-- Modal for Skills -->









<!-- Modal for Certification -->
<section class="certification_modal">

           <div class="modal fade" id="myModal4" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

                  <form method="" action="resume/addCertification" class="theme1">

                                      
                                      <div class="col-md-12 content-panel-header">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         <h3>Add Certification</h3>

                                      </div>

                                      <section>

                                           <div class="form-group form-group">
                                            <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="title" type="text" placeholder="Certificate Title">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                            <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="company" type="text" placeholder="Awarded At">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                           <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="receive" type="text" placeholder="Date Receive">
                                            </div>
                                            
                                          </div>
                                         
                                     </section>

                            <div class="modal-footer">

                                 <button type="submit" class="btn btn-default">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                  </form>
                </div>
                
              </div>
            </div>

</section>
<!-- Modal for Certification -->

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

  <div class="modal fade bs-example-modal-lg" id="checkjobnotification_{{ $jobInfo->id }}" role="dialog">
      <div class="modal-dialog modal-lg" style="width:1200px;">
      
         <!-- Modal content-->
              <div class="modal-content">

              <form method="POST" action="" class="theme1">
                       {{ csrf_field() }}  
                         <input type="hidden" name="job_id" value="<?php echo $jobInfo->id; ?>">

                  <div class="modal-header col-md-12 content-panel-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h3>Applying {{ $jobInfo->company_job }} </h3>
                  </div>

                  <div class="modal-body" style="height: 100%;background: #fff;float: left;width: 100%;">
                  
                          <div class="col-sm-12">
                              <input type="hidden" value="{{ $jobInfo->id }}" name="id">

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <center><h4>Job Information</h4></center>
                                  <hr></hr>
                                </div>
                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-4">
                                  <p>Job Title</p>
                                  <?php if(empty($jobInfo->company_job OR $jobInfo->company_job == " ")){ ?> 
                                    <p class="form-control job_input">Empty</p>
                                  <?php }else{ ?> 
                                    <p class="form-control job_input">{{ $jobInfo->company_job }}</p>
                                  <?php } ?>
                                </div>
                              </div>

                              <div class="form-group form-group" style="margin-top:-15px;">
                                <div class="col-sm-4">
                                  <p>Salary Rate</p>
                                  <?php if(empty($jobInfo->company_rate OR $jobInfo->company_rate == " ")){ ?>
                                    <p class="form-control job_input">Empty</p>
                                  <?php }else{ ?> 
                                    <p class="form-control job_input">{{ $jobInfo->company_rate }}</p>
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group" style="margin-top:-15px;">
                                <div class="col-sm-4">
                                  <p>Working Hours</p>
                                  <?php if(empty($jobInfo->company_workinghours OR $jobInfo->company_workinghours == " ")){ ?> 
                                    <p class="form-control job_input">Empty</p>
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_workinghours }}</p> 
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                   <p>Job Description</p>
                                   <p class="form-control job_input" style="height:100%;">{!! nl2br($jobInfo->company_status) !!}</p>   
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <center><h4>Company Information</h4></center>
                                  <hr></hr>
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-4">
                                  <p>Name</p>
                                  <?php if(empty($jobInfo->company_name OR $jobInfo->company_name == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_name }}</p> 
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-8">
                                  <p>Address</p>
                                  <?php if(empty($jobInfo->company_address OR $jobInfo->company_address == " ")){ ?>
                                    <p class="form-control job_input">Empty</p>  
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_address }}</p>
                                  <?php } ?>

                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <p>About the Company</p>
                                  <p class="form-control job_input" style="height:100%;">{!! nl2br($jobInfo->company_details) !!}</p>
                                </div>
                               
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Email</p>
                                  <?php if(empty($jobInfo->email OR $jobInfo->email == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->email }}</p> 
                                  <?php } ?>
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Website</p>
                                  <?php if(empty($jobInfo->company_website OR $jobInfo->company_website == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input"><a href="{{ $jobInfo->company_website }}">Website Link</a></p> 
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Telephone Number</p>                     
                                  <?php if(empty($jobInfo->company_telephone OR $jobInfo->company_telephone == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_telephone }}</p> 
                                  <?php } ?>

                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Company Size</p>
                                  <?php if(empty($jobInfo->company_companysize OR $jobInfo->company_companysize == " ")){ ?>
                                    <p class="form-control job_input">Empty</p>  
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_companysize }}</p>
                                  <?php } ?>

                               </div>

                              </div>

                               <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <center><h4>Other Information</h4></center>
                                  <hr></hr>
                                </div>
                              </div>

                               <div class="form-group form-group">
                                <div class="col-sm-6">
                                  <p>Language Spoken</p>
                                  <?php if(empty($jobInfo->company_spokenlanguage OR $jobInfo->company_spokenlanguage == " ")){ ?>
                                    <p class="form-control job_input">Empty</p>  
                                    
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_spokenlanguage }}</p>
                                    
                                  <?php } ?>

                               </div>

                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-6">
                                  <p>Industry</p>
                                  <?php if(empty($jobInfo->company_industry OR $jobInfo->company_industry == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                    
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_industry }}</p>
                                    
                                  <?php } ?>
                               </div>

                              </div>


                               <div class="form-group form-group">
                                <div class="col-sm-6">
                                  <p>Process Time</p>
                                  <?php if(empty($jobInfo->company_processtime OR $jobInfo->company_processtime == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobInfo->company_processtime }}</p>
                                  <?php } ?>
                               </div>

                              </div>



                              <div class="form-group form-group">
                                <div class="col-sm-6">
                                  <p>Facebook Page</p>
                                  <?php if(empty($jobInfo->company_facebook OR $jobInfo->company_facebook == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input"><a href="{{ $jobInfo->company_facebook }}">Facebook Page</a></p>
                                  <?php } ?>
                               </div>

                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <p>Benefits</p>
                                  <?php if(empty($jobInfo->company_benefits OR $jobInfo->company_benefits == " ")){ ?>
                                    <p class="form-control job_input">Empty</p> 
                                     
                                  <?php }else{ ?>
                                   
                                    <p class="form-control job_input" style="height:100%;">{!! nl2br($jobInfo->company_benefits) !!}</p>                  
                                  <?php } ?>
                                </div>
                               
                              </div>


                          </div>   
           
                  </div>

                  <div class="modal-footer content-panel-header" style="width:100%;">
                      <button  class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#jobs_{{ $jobInfo->id }}">Apply</button> 
                      <a class="btn btn-default readJobNoti" href="/jobs/deleteJobNotification/<?php echo $job_value->id; ?>">Read</a>
                  </div>

              </form>

              </div>
              <!-- Modal content--> 
        
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
