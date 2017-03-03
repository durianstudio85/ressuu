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
                  <li><i class="glyphicon glyphicon-user"></i></li>
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
                   <!---->
                  <li><i class="glyphicon glyphicon-briefcase"></i></li>
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
                        <a href="{{ url('/home') }}"><li  class="menuactive"><span class="glyphicon glyphicon-inbox">&nbsp;</span>Dashboard</li></a>

                         <?php if ($if_exist_settings == 1) { ?>

                             <a href="https://ressuu.me/cv/<?php echo $userSettings->permalink; ?>" target="_blank" ><li><span class="glyphicon glyphicon-list-alt">&nbsp;</span>My CV</li></a>
                             
                         <?php } ?> 
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
<?php if ($if_exist == 1) { ?><!-- if -->

<?php  foreach ($timeline as $value) { ?><!-- foreach -->


<?php  if($value->category == "Job"){ ?><!-- if -->

<?php  $jobInfo = DB::table('job')->where('id',$value->category_id)->first(); ?>    
  
<div class="col-xs-12 col-md-12 content-panel-header">
            
            <div class="col-md-10" >
                      <div class="content-panel-status col-xs-12 col-md-12">   
                            <div class="col-sm-2 div">
                                <img class="img-responsive profile-pic" src="joblogo/<?php echo $jobInfo->company_picture; ?>">
                            </div>
                            <div class="col-sm-10 div">
                                  <h4><?php echo $jobInfo->company_name ?></h4>
                                  <p><?php echo $value->activity; ?> <a href="" data-toggle="modal" data-target="#newsfeed_{{ $value->id }}"><span>check it here.</span></a></p>
                                  <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
                            </div>       
                      </div>
            </div>
             <div class="col-xs-12 col-md-2 content-panel-lc">      
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
    
  <!-- Modal for newsFeed -->
          <!-- Modal for viewJobs -->
                                      <section>

                                                 <div class="modal fade" id="newsfeed_{{ $value->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="jobs/addJob" class="theme1">
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
                                                                              <p>Company Details: </p>
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
                                                                   <button type="" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for viewJobs -->
 <!-- Modal for newsFeed -->         


  
<?php }else{ ?>

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
                              <!--<img src="images/like.png"><span>12</span>
                              <img src="images/comment.jpg"><span>12</span>-->       
            </div>

  </div>
<!-- Modal for newsFeed -->
                                      <section>

                                                 <div class="modal fade" id="newsfeed_{{ $value->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="resume/deleteSkill/{{ $value->id }}" class="theme1">
                                                               <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4>Title</h4>
                                                              </div>
                                                                        
                                                              <div class="col-md-12 content-panel-header">
                                                                    <h3>Are you sure you want to delete your skills in ?</h3>

                                                              </div>

                                                              <div class="modal-footer">
                                                                   <button type="submit"  data-dismiss="modal">Close</button>   
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
<!-- Modal for newsFeed -->



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
                                             <button type="" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#replymessage_{{ $message_value->id }}">Replay</button>  
                                             <button type="" class="btn btn-default" data-dismiss="modal">Delete</button>
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

                            <form method="POST" action="message/sendtoClient" class="theme1">
                                      {{ csrf_field() }}  
                                       <div class="modal-header col-md-12 content-panel-header">
                                            <h3>Replay message of {{ $message_value->name }}</h3>
                                       </div>
                                          <input class="form-control" name="id" type="hidden" value="<?php echo $message_value->user_id; ?>">
                                          
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


<!-- Modal -->   







<?php } ?>
   
</div>
@endsection