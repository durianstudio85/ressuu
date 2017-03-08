@extends('layouts.app')

@section('title')
   | Jobs
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
                  </li>
                   <!---->
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

<sidebar class="col-md-3 ">

             <div class="row user-tabs">
                <div class="user">
                    <?php if ($if_exist == 1) { ?>
      
                    <?php if(!empty($userProfile->profile_picture) AND $userProfile->profile_picture != " "  ){ ?>
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
                        <div class="col-md-4 panel-status-1">
                            <img src="images/heart.png"> 
                            <p>2,718</p>
                        </div>
                        <div class="col-md-4 panel-status-2">
                            <img src="images/users.png">
                            <p>5,718</p>  
                        </div>
                        <div class="col-md-4 panel-status-3">
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
                        <a href="{{ url('/users') }}"><li><span class="glyphicon glyphicon-user">&nbsp;</span>Users</li></a>  
                        <a href="{{ url('/profile') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Profile</li></a>
                        <a href="{{ url('/resume') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                        <a href="{{ url('/portfolio') }}"><li><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                        <a href="{{ url('/jobs') }}"><li   class="menuactive"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li></a>    
                        <a href="{{ url('/setting') }}"><li><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
                        <a href="{{ url('/logout') }}"><li><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li></a>
                  </ul>
              </nav>

</sidebar>
<content class="col-xs-12 col-md-9"> 
<section class="col-xs-12 col-md-12 jpage content-header">
  
                    <div class="col-xs-12 col-md-10">
                      <h3>Jobs</h3>     
                    </div>

                    <div class="col-md-2">
                      <img src="images/cancel.png"  class="cancel-button">
                    </div>

                    <div class="col-xs-12 col-md-12">
                          <?php  $your_application = DB::table('applicant')->where('user_id',Auth::id())->count(); ?>
                        <div class="col-xs-4 col-md-4 content-header-tabs">                        
                           <div class="jobs">
                           <?php $available_job =  $count_job - $your_application ; ?>
                             <h4><?php echo $available_job; ?></h4>
                             <p>Jobs Available</p>
                             <button class="view" data-toggle="modal" data-target="#viewAvailable">View</button>
                           </div>

                        </div>
                        <div class="col-xs-4 col-md-4 content-header-tabs">
                        <div class="jobs">
                             <h4>0</h4>
                             <p>In your location</p>
                             <button class="views">View</button>
                           </div>                        
                           

                        </div>
                        <div class="col-xs-4 col-md-4 content-header-tabs">   
                        <div class="jobs">
                           
                             <h4><?php echo $your_application; ?></h4>
                             <p>Your Application</p>
                             <button class="views" data-toggle="modal" data-target="#viewApplication" >View</button>
                          </div>                     
                           

                        </div>
                    </div>

</section>

<section class="jobs-wrap">   


<?php foreach ($userJobs as $jobs) { ?>



          <div class="col-xs-12 col-md-12 content-panel-header">
              
            <div class="col-xs-12 col-md-2 img">
                    <img src="joblogo/{{ $jobs->company_picture }}" class="img-responsive"> 
            </div>
            <div class="col-xs-8 col-md-8 content-panel-jobs">
                       <h4>{{ $jobs->company_job }}</h4>
                       <p>{{ $jobs->company_address }}</p>
                       <div><!--<a href="#">Link</a> | <a href="#">Comment</a>--></div>
            </div>
             <div class="col-xs-4 col-md-2 apply">      
                        <p>
                          <?php
                              
                              if(!empty($jobs->date)){
                               
                                 $value_date = date("Y-m-d", strtotime( $jobs->date ) );
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
                        <?php  $if_apply = DB::table('applicant')->where(['user_id' => Auth::id(),'job_id'=>$jobs->id])->count(); ?>
                        <?php if($if_apply == 0){ ?>
                           <button data-toggle="modal" data-target="#jobs_{{ $jobs->id }}">Apply</button> 
                        <?php }else{ ?> 
                           <button data-toggle="">Applied</button>
                        <?php } ?>
                       
                                  
            </div>

          </div>

            <!-- Modal for apply Job -->
                                      <section>

                                                 <div class="modal fade" id="jobs_{{ $jobs->id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="POST" action="/jobs/applyJobs" class="theme1">
                                                             {{ csrf_field() }}  
                                                               <input type="hidden" name="job_id" value="<?php echo $jobs->id; ?>">

                                                               <div class="modal-header col-md-12 content-panel-header">
                                                                    <h3>Applying for {{ $jobs->company_job }}</h3>
                                                               </div>
                                                                        
                                                               <div class="col-md-12  content-panel">
                                                                    <div class="col-md-4">
                                                                              <p>Company Name: </p>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                              <p>{{ $jobs->company_name }}</p>
                                                                    </div>
                                                                          
                                                               </div>      

                                                               <div class="col-md-12  content-panel">
                                                                    <div class="col-md-4">
                                                                              <p>Company Address: </p>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                              <p>{{ $jobs->company_address }}</p>
                                                                    </div>
                                                                     
                                                               </div> 

                                                               <div class="col-md-12  content-panel">
                                                                    <div class="col-md-4">
                                                                              <p>Company Details: </p>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                              <p>{{ $jobs->company_details }}</p>
                                                                    </div>
                                                                                  
                                                               </div>

                                                               <div class="col-md-12  content-panel">
                                                                    <div class="col-md-4">
                                                                              <p>Salary Rate </p>
                                                                    </div>  
                                                                    <div class="col-md-7">
                                                                              <p class="job_salary">{{ $jobs->company_rate }}</p>
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

<!-- Modal for viewApplication-->
<section>

           <div class="modal fade" id="viewApplication" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

              <form method="POST" action="/jobs/applyJobs" class="theme1">
                       {{ csrf_field() }}  
                         <input type="hidden" name="job_id" value="<?php echo $jobs->id; ?>">

                         <div class="modal-header col-md-12 content-panel-header">
                              <h3>Your Application</h3>
                         </div>  
                              <div class="col-md-12 ">
                                  <div class="col-md-2"></div>
                                  <div class="col-md-4"><h4>Company Name</h4></div>
                                  <div class="col-md-3"><h4>Company Job</h4></div>
                                  <div class="col-md-3"><h4></h4></div>
                              </div>
                             <?php foreach ($job_application as $value) { ?>
                                <?php $jobInfo = DB::table('job')->where('id',$value->job_id)->first(); ?>
                                  <div class="col-md-12" style="margin:0px 0px 10px 0px;">
                                    <div class="col-md-2"><img src="joblogo/{{ $jobInfo->company_picture }}" class="img-responsive"></div>
                                    <div class="col-md-4"><h5>{{ $jobInfo->company_name }}</h5></div>
                                    <div class="col-md-3"><h5>{{ $jobInfo->company_job }}</h5></div>
                                    <div class="col-md-3"><h5></h5></div>
                                  </div>
                             <?php  } ?>

                           <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                        <div class="modal-footer">
                             <button class="btn btn-default" data-dismiss="modal">Close</button> 
                        </div>
              </form>
              </div>
      
    </div>
  </div>

</section>
<!-- Modal for viewApplication -->

<!-- Modal for viewApplication-->
<section>

           <div class="modal fade" id="viewAvailable" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

              <form method="POST" action="/jobs/applyJobs" class="theme1">
                       {{ csrf_field() }}  
                         <input type="hidden" name="job_id" value="<?php echo $jobs->id; ?>">

                         <div class="modal-header col-md-12 content-panel-header">
                              <h3>Available Jobs </h3>
                         </div>  
                              <div class="col-md-12 ">
                                  <div class="col-md-2"></div>
                                  <div class="col-md-4"><h4>Company Name</h4></div>
                                  <div class="col-md-3"><h4>Company Job</h4></div>
                                  <div class="col-md-3"><h4></h4></div>
                              </div>
                             <?php foreach ($userJobs as $value) { ?>
                                <?php $available_job = DB::table('applicant')->where(['user_id' =>Auth::id() ,'job_id' => $value->id])->count(); ?>

                                  <?php if($available_job == 0){ ?> 
                                      <div class="col-md-12" style="margin:0px 0px 10px 0px;">
                                        <div class="col-md-2"><img src="joblogo/{{ $value->company_picture }}" class="img-responsive"></div>
                                        <div class="col-md-4"><h5>{{ $value->company_name }}</h5></div>
                                        <div class="col-md-3"><h5>{{ $value->company_job }}</h5></div>
                                        <div class="col-md-3"><h5></h5></div>
                                      </div>
                                  <?php } ?>
                             <?php  } ?>

                           <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                        <div class="modal-footer">
                             <button class="btn btn-default" data-dismiss="modal">Close</button> 
                        </div>
              </form>
              </div>
      
    </div>
  </div>

</section>
<!-- Modal for viewApplication -->








@endsection
