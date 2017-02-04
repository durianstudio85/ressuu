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
                   <span class="glyphicon glyphicon-comment naviconactive dropdown-toggle" data-toggle="dropdown"><span class="badge">4</span></span>
                      <ul class="dropdown-menu drop-message">
                        <li><a href="#">Message 1</a></li>
                        <li><a href="#">Message 2</a></li>
                        <li><a href="#">Message 3</a></li>
                         <li><a href="#">Message 3</a></li>
                      </ul>
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

<sidebar class="col-md-3 ">

             <div class="row user-tabs">
                <div class="user">
                  <img src="images/user.png">     
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
                        <a href="{{ url('/profile') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Profile</li></a>
                        <a href="{{ url('/resume') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                        <a href="{{ url('/portfolio') }}"><li><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                        <a href="{{ url('/jobs') }}"><li   class="menuactive"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
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
                        <div class="col-xs-4 col-md-4 content-header-tabs">                        
                           <div class="jobs">
                             <h4>1,890</h4>
                             <p>Jobs Available</p>
                             <button class="view">View</button>
                           </div>

                        </div>
                        <div class="col-xs-4 col-md-4 content-header-tabs">
                        <div class="jobs">
                             <h4>250</h4>
                             <p>In your location</p>
                             <button class="views">View</button>
                           </div>                        
                           

                        </div>
                        <div class="col-xs-4 col-md-4 content-header-tabs">   
                        <div class="jobs">
                             <h4>16</h4>
                             <p>Your Application</p>
                             <button class="views">View</button>
                          </div>                     
                           

                        </div>
                    </div>

</section>

<section class="jobs-wrap">   


<?php foreach ($userJobs as $jobs) { ?>



          <div class="col-xs-12 col-md-12 content-panel-header">
              
            <div class="col-xs-12 col-md-2 img">
                    <img src="images/job_pic.png" class="img-responsive"> 
            </div>
            <div class="col-xs-8 col-md-8 content-panel-jobs">
                       <h4>{{ $jobs->company_job }}</h4>
                       <p>{{ $jobs->company_address }}</p>
                       <div><a href="#">Link</a> | <a href="#">Comment</a></div>
            </div>
             <div class="col-xs-4 col-md-2 apply">      
                        <p>2 Day Ago</p>
                        <button data-toggle="modal" data-target="#jobs_{{ $jobs->job_id }}">Apply</button>           
            </div>

          </div>

            <!-- Modal for deleteSkills -->
                                      <section>

                                                 <div class="modal fade" id="jobs_{{ $jobs->job_id }}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                    <form method="" action="jobs/addJob" class="theme1">
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

                                                              <div class="modal-footer">
                                                                   <button type="submit" class="btn btn-default">Confirm</button> 
                                                              </div>
                                                    </form>
                                                    </div>
                                            
                                          </div>
                                        </div>

                                      </section>
                  <!-- Modal for deleteSkills -->


<?php } ?>

 <div class="col-xs-12 col-md-12 content-panel-header">
              
            <div class="col-xs-12 col-md-2 img">
                    <img src="images/hp.png" class="img-responsive"> 
            </div>
            <div class="col-xs-8 col-md-8 content-panel-jobs">
                       <h4>IT Expert</h4>
                       <p>Suwon, South Korea</p>
                       <div><a href="#">Link</a> | <a href="#">Comment</a></div>
            </div>
             <div class="col-xs-4 col-md-2 apply">      
                        <p>2 Day Ago</p>
                        <button data-toggle="modal" data-target="#1">Apply</button>           
            </div>

             <!-- Modal for deleteSkills -->
                 <section>

                      <div class="modal fade" id="1" role="dialog">
                         <div class="modal-dialog">
                                                  
                          <!-- Modal content-->
                          <div class="modal-content">

                            <form method="" action="jobs/addJob" class="theme1">
                                   <div class="modal-header col-md-12 content-panel-header">
                                       <h3>Applying for IT Expert</h3>
                                   </div>
                                                                        
                                       <div class="col-md-12  content-panel">
                                            <div class="col-md-4">
                                                      <p>Company Name: </p>
                                            </div>
                                            <div class="col-md-7">
                                                      <p>HP</p>
                                            </div>
                                                  
                                       </div>      

                                       <div class="col-md-12  content-panel">
                                            <div class="col-md-4">
                                                      <p>Company Address: </p>
                                            </div>
                                            <div class="col-md-7">
                                                      <p>Suwon, South Korea</p>
                                            </div>
                                             
                                       </div> 

                                       <div class="col-md-12  content-panel">
                                            <div class="col-md-4">
                                                      <p>Company Details: </p>
                                            </div>
                                            <div class="col-md-7">
                                                      <p>Praesent sit amet porttitor neque, vel congue erat. Donec id massa dolor. Pellentesque suscipit lobortis metus, luctus placerat massa. In finibus at libero id consectetur.</p>
                                            </div>
                                                          
                                       </div>

                                       <div class="col-md-12  content-panel">
                                            <div class="col-md-4">
                                                      <p>Salary Rate </p>
                                            </div>  
                                            <div class="col-md-7">
                                                      <p class="job_salary">$200/Month</p>
                                            </div>
                                                          
                                       </div>

                                      <div class="modal-footer">
                                           <button type="submit" class="btn btn-default">Confirm</button> 
                                      </div>
                                </form>
                            </div>
                                            
                         </div>
                      </div>

                    </section>
                <!-- Modal for deleteSkills -->
</div>

<div class="col-xs-12 col-md-12 content-panel-header">
              
            <div class="col-xs-12 col-md-2 img">
                    <img src="images/ibm.png" class="img-responsive"> 
            </div>
            <div class="col-xs-8 col-md-8 content-panel-jobs">
                       <h4>technical Support</h4>
                       <p>{{ $jobs->company_address }}</p>
                       <div><a href="#">Link</a> | <a href="#">Comment</a></div>
            </div>
             <div class="col-xs-4 col-md-2 apply">      
                        <p>2 Day Ago</p>
                        <button data-toggle="modal" data-target="#jobs_{{ $jobs->job_id }}">Apply</button>           
            </div>

</div>

 <div class="col-xs-12 col-md-12 content-panel-header">
              
            <div class="col-xs-12 col-md-2 img">
                    <img src="images/appguruz.png" class="img-responsive"> 
            </div>
            <div class="col-xs-8 col-md-8 content-panel-jobs">
                       <h4>Android App Developer</h4>
                       <p>{{ $jobs->company_address }}</p>
                       <div><a href="#">Link</a> | <a href="#">Comment</a></div>
            </div>
             <div class="col-xs-4 col-md-2 apply">      
                        <p>2 Day Ago</p>
                        <button data-toggle="modal" data-target="#jobs_{{ $jobs->job_id }}">Apply</button>           
            </div>

</div>      
          
         
                     
</section>  
</content>
              
</div>
@endsection
