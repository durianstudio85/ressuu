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
                <div class="col-md-12 user">
                    <?php if(!empty($adminProfile->profile_pic) AND $adminProfile->profile_pic != " " ){ ?>
                           <a href="#" data-toggle="modal" data-target="#profilepic" ><img class="img-reponsive profile-pic" src="../profilepic/<?php echo $adminProfile->profile_pic; ?>"></a> 
                    <?php }else{ ?>
                           <a href="#" data-toggle="modal" data-target="#profilepic" ><img class="img-responsive profile-pic" src="../profilepic/default_avatar.jpg"></a> 
                    <?php } ?>
                </div>
                 <div class="col-md-12 name-panel">
                  
                   <p class="name">
                   <?php echo $adminProfile->name; ?>
                   </p>
                   <p class="subname">
                   <?php echo $adminProfile->position; ?>
                    </p>
             
                 </div>
              </div>
      
             <nav class="row sidebar-menus">
                  <ul>
                        <a href="{{ url('/admin/home') }}"><li><span class="glyphicon glyphicon-inbox">&nbsp;</span>Dashboard</li></a>
                        <a href="{{ url('/admin/users') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Users</li></a>
                        <a href="{{ url('/admin/ads') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Ads</li></a>
                        <a href="{{ url('/admin/jobs') }}"><li class="menuactive"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
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
<section class="cph-wrapper">
  <div class="col-md-12 content-panel-header">
       <table class="table display" id="example" width="100%" cellspacing="0">
              <thead>
               <tr>
                <th>#</th> 
                <th></th> 
                <th>Company Name</th> 
                <th>Company Job</th> 
                <th>Rate</th>
                <th>Bulk Action</th> 
 
              </tr> 
              </thead> 
              <tbody> 
              
               <?php foreach ($jobList as $jobs) { ?> 

            
                <?php if($jobs->status != "DELETE"){ ?>  

                  <?php $number++; ?>
                  <tr> 
                    <th scope="row"><?php echo$number; ?></th> 
                    <td><img class="img-responsive" style="width:50px;height:50px;" src="../joblogo/<?php echo $jobs->company_picture; ?>"></td> 
                    <td><?php echo $jobs->company_name; ?></td> 
                    <td><?php echo $jobs->company_job; ?></td> 
                    <td><?php echo $jobs->company_rate; ?></td> 
                    <td>
                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                             <button data-toggle="modal" data-target="#viewJobs{{ $jobs->id }}" type="button" class="btn btn-info">View</button>
                             <button data-toggle="modal" data-target="#editJobs{{ $jobs->id }}" type="button" class="btn btn-primary">Edit</button>
                             <button data-toggle="modal" data-target="#deleteJobs{{ $jobs->id }}" type="button" class="btn btn-success">Delete</button>
                             <button data-toggle="modal" data-target="#viewApplicant{{ $jobs->id }}" type="button" class="btn btn-info">Applicant</button>
                        </div>
                      
                    </td> 
                  </tr> 
  <!-- Modal for viewJobs -->
  <section>

  <div class="modal fade bs-example-modal-lg" id="viewJobs{{ $jobs->id }}" role="dialog">
              
      <div class="modal-dialog modal-lg" style="width:1200px;">
              
             <!-- Modal content-->
          <div class="modal-content">

              <form method="" action="" class="theme1"  enctype="multipart/form-data">
                            
                  <div class="modal-header col-md-12 content-panel-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h3>{{ $jobs->company_job }} </h3>
                  </div>

                  <div class="modal-body" style="height: 100%;background: #fff;float: left;width: 100%;">
                  
                          <div class="col-sm-12">
                              <input type="hidden" value="{{ $jobs->id }}" name="id">

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <center><h4>Job Information</h4></center>
                                  <hr></hr>
                                </div>
                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-4">
                                  <p>Job Title</p>
                                  <?php if(empty($jobs->company_job OR $jobs->company_job == " ")){ ?> 
                                    <p>Empty</p>
                                  <?php }else{ ?> 
                                    <p class="form-control job_input">{{ $jobs->company_job }}</p>
                                  <?php } ?>
                                </div>
                              </div>

                              <div class="form-group form-group" style="margin-top:-15px;">
                                <div class="col-sm-4">
                                  <p>Salary Rate</p>
                                  <?php if(empty($jobs->company_rate OR $jobs->company_rate == " ")){ ?>
                                    <p>Empty</p>
                                  <?php }else{ ?> 
                                    <p class="form-control job_input">{{ $jobs->company_rate }}</p>
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group" style="margin-top:-15px;">
                                <div class="col-sm-4">
                                  <p>Working Hours</p>
                                  <?php if(empty($jobs->company_workinghours OR $jobs->company_workinghours == " ")){ ?> 
                                    <p>Empty</p>
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_workinghours }}</p> 
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                   <p>Job Description</p>
                                   <p class="form-control job_input" style="height:100%;">{!! nl2br($jobs->company_status) !!}</p>   
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
                                  <?php if(empty($jobs->company_name OR $jobs->company_name == " ")){ ?>
                                    <p>Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_name }}</p> 
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-8">
                                  <p>Address</p>
                                  <?php if(empty($jobs->company_address OR $jobs->company_address == " ")){ ?>
                                    <p>Empty</p>  
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_address }}</p>
                                  <?php } ?>

                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <p>About the Company</p>
                                  <p class="form-control job_input" style="height:100%;">{!! nl2br($jobs->company_details) !!}</p>
                                </div>
                               
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Email</p>
                                  <?php if(empty($jobs->email OR $jobs->email == " ")){ ?>
                                    <p>Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->email }}</p> 
                                  <?php } ?>
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Website</p>
                                  <?php if(empty($jobs->company_website OR $jobs->company_website == " ")){ ?>
                                    <p>Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input"><a href="{{ $jobs->company_website }}" target="_blank">Website Link</a></p> 
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Telephone Number</p>                     
                                  <?php if(empty($jobs->company_telephone OR $jobs->company_telephone == " ")){ ?>
                                    <p>Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_telephone }}</p> 
                                  <?php } ?>

                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Company Size</p>
                                  <?php if(empty($jobs->company_companysize OR $jobs->company_companysize == " ")){ ?>
                                    <p>Empty</p>  
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_companysize }}</p>
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
                                  <?php if(empty($jobs->company_spokenlanguage OR $jobs->company_spokenlanguage == " ")){ ?>
                                    <p>Empty</p>  
                                    
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_spokenlanguage }}</p>
                                    
                                  <?php } ?>

                               </div>

                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-6">
                                  <p>Industry</p>
                                  <?php if(empty($jobs->company_industry OR $jobs->company_industry == " ")){ ?>
                                    <p>Empty</p> 
                                    
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_industry }}</p>
                                    
                                  <?php } ?>
                               </div>

                              </div>


                               <div class="form-group form-group">
                                <div class="col-sm-6">
                                  <p>Process Time</p>
                                  <?php if(empty($jobs->company_processtime OR $jobs->company_processtime == " ")){ ?>
                                    <p>Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input">{{ $jobs->company_processtime }}</p>
                                  <?php } ?>
                               </div>

                              </div>



                              <div class="form-group form-group">
                                <div class="col-sm-6">
                                  <p>Facebook Page</p>
                                  <?php if(empty($jobs->company_facebook OR $jobs->company_facebook == " ")){ ?>
                                    <p>Empty</p> 
                                  <?php }else{ ?>
                                    <p class="form-control job_input"><a href="{{ $jobs->company_facebook }}" target="_blank">Facebook Page</a></p>
                                  <?php } ?>
                               </div>

                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <p>Benefits</p>
                                  <?php if(empty($jobs->company_benefits OR $jobs->company_benefits == " ")){ ?>
                                    <p>Empty</p> 
                                     
                                  <?php }else{ ?>
                                   
                                    <p class="form-control job_input" style="height:100%;">{!! nl2br($jobs->company_benefits) !!}</p>                  
                                  <?php } ?>
                                </div>
                               
                              </div>


                          </div>   
           
                  </div>

                  <div class="modal-footer content-panel-header" style="width:100%;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                  </div>

          
                             
              </form>

          </div>
           <!-- Modal content-->
              
      </div>
  </div>

  </section>
<!-- Modal for viewJobs -->
<!-- Modal -->
<!-- Modal for editJobs -->
 <section class="upeducation_modal">

   <div class="modal fade bs-example-modal-lg" id="editJobs{{ $jobs->id }}" role="dialog">

        <div class="modal-dialog modal-lg" style="width:1200px;">
        
          <!-- Modal content-->
          <div class="modal-content">

              <form method="POST" action="/jobs/editJobs" class="theme1"  enctype="multipart/form-data">
                  {{ csrf_field() }}  
                                  
                  <div class="modal-header col-md-12 content-panel-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h3>Update {{ $jobs->company_job }} </h3>

                  </div>

                  <div class="modal-body" style="height: 100%;background: #fff;float: left;width: 100%;">
                  
                          <div class="col-sm-12">
                              <input type="hidden" value="{{ $jobs->id }}" name="id">

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <center><h4>Job Information</h4></center>
                                  <hr></hr>
                                </div>
                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-4">
                                  <p>Job Title</p>
                                  <?php if(empty($jobs->company_job OR $jobs->company_job == " ")){ ?> 
                                    <input class="form-control job_input" name="company_jobtitle" type="text" value="Empty">
                                  <?php }else{ ?> 
                                    <input class="form-control job_input" name="company_jobtitle" type="text" value="{{ $jobs->company_job }}">
                                  <?php } ?>
                                </div>
                              </div>

                              <div class="form-group form-group" style="margin-top:-15px;">
                                <div class="col-sm-4">
                                  <p>Salary Rate</p>
                                  <?php if(empty($jobs->company_rate OR $jobs->company_rate == " ")){ ?> 
                                    <input class="form-control job_input" name="company_rate" type="text" value="Empty">
                                  <?php }else{ ?> 
                                    <input class="form-control job_input" name="company_rate" type="text" value="{{ $jobs->company_rate }}">
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group" style="margin-top:-15px;">
                                <div class="col-sm-4">
                                  <p>Working Hours</p>
                                  <?php if(empty($jobs->company_workinghours OR $jobs->company_workinghours == " ")){ ?> 
                                    <input class="form-control job_input" name="company_workinghours" type="text" value="Empty">
                                  <?php }else{ ?> 
                                    <input class="form-control job_input" name="company_workinghours" type="text" value="{{ $jobs->company_workinghours }}">
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                   <p>Job Description</p>
                                  <textarea  class="form-control job_input"  rows="5" cols="45" name="job_description">{{ $jobs->company_status }}</textarea>   
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
                                  <?php if(empty($jobs->company_name OR $jobs->company_name == " ")){ ?> 
                                    <input class="form-control job_input" name="company_name" type="text" value="Empty">
                                  <?php }else{ ?> 
                                    <input class="form-control job_input" name="company_name" type="text" value="{{ $jobs->company_name }}">
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-8">
                                  <p>Address</p>
                                  <?php if(empty($jobs->company_address OR $jobs->company_address == " ")){ ?> 
                                    <input class="form-control job_input" name="company_address" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_address" type="text" value="{{ $jobs->company_address }}">
                                  <?php } ?>

                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <p>About the Company</p>
                                  <textarea class="form-control job_input" name="company_details" rows="5" cols="10">{{ $jobs->company_details }}</textarea>
                                </div>
                               
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Email</p>
                                  <?php if(empty($jobs->email OR $jobs->email == " ")){ ?> 
                                    <input class="form-control job_input" name="company_email" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_email" type="text" value="{{ $jobs->email }}">
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Website</p>
                                  <?php if(empty($jobs->company_website OR $jobs->company_website == " ")){ ?> 
                                    <input class="form-control job_input" name="company_website" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_website" type="text" value="{{ $jobs->company_website }}">
                                  <?php } ?>
                                  
                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Telephone Number</p>                     
                                  <?php if(empty($jobs->company_telephone OR $jobs->company_telephone == " ")){ ?> 
                                    <input class="form-control job_input" name="company_telephone" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_telephone" type="text" value="{{ $jobs->company_telephone }}">
                                  <?php } ?>

                                </div>
                              </div>

                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Company Size</p>
                                  <?php if(empty($jobs->company_companysize OR $jobs->company_companysize == " ")){ ?> 
                                    <input class="form-control job_input" name="company_companysize" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_companysize" type="text" value="{{ $jobs->company_companysize }}">
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
                                <div class="col-sm-3">
                                  <p>Language Spoken</p>
                                  <?php if(empty($jobs->company_spokenlanguage OR $jobs->company_spokenlanguage == " ")){ ?> 
                                    <input class="form-control job_input" name="company_spokenlanguage" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_spokenlanguage" type="text" value="{{ $jobs->company_spokenlanguage }}">
                                  <?php } ?>

                               </div>

                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Industry</p>
                                  <?php if(empty($jobs->company_industry OR $jobs->company_industry == " ")){ ?> 
                                    <input class="form-control job_input" name="company_industry" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_industry" type="text" value="{{ $jobs->company_industry }}">
                                  <?php } ?>
                               </div>

                              </div>


                               <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Process Time</p>
                                  <?php if(empty($jobs->company_processtime OR $jobs->company_processtime == " ")){ ?> 
                                    <input class="form-control job_input" name="company_processtime" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_processtime" type="text" value="{{ $jobs->company_processtime }}">
                                  <?php } ?>
                               </div>

                              </div>



                              <div class="form-group form-group">
                                <div class="col-sm-3">
                                  <p>Facebook Page</p>
                                  <?php if(empty($jobs->company_facebook OR $jobs->company_facebook == " ")){ ?> 
                                    <input class="form-control job_input" name="company_facebook" type="text" value="Empty">
                                  <?php }else{ ?>
                                    <input class="form-control job_input" name="company_facebook" type="text" value="{{ $jobs->company_facebook }}">
                                  <?php } ?>
                               </div>

                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                  <p>Benefits</p>
                                  <?php if(empty($jobs->company_benefits OR $jobs->company_benefits == " ")){ ?> 
                                    <textarea  class="form-control job_input"  rows="5" cols="45" name="company_benefits"></textarea> 
                                  <?php }else{ ?>
                                    <textarea  class="form-control job_input"  rows="5" cols="45" name="company_benefits">{{ $jobs->company_benefits }}</textarea>                   
                                  <?php } ?>
                                </div>
                               
                              </div>


                              <div class="form-group form-group">
                                <div class="col-sm-12">
                                      <p>Logo</p>
                                      <input class="form-control jobfile" name="logo" type="file" placeholder="Logo">
                                      <input class="form-control jobfile" name="oldlogo" type="hidden" value="<?php echo $jobs->company_picture; ?>">
                                </div>
                                    
                              </div>


                          </div>   
           
                  </div>

                  <div class="modal-footer content-panel-header" style="width:100%;">
                       <button type="submit" class="btn btn-default">Update</button>  
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                  </div>

                  <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                             
              </form>

          </div>
           <!-- Modal content-->

        </div>

  </div>

 </section>
<!-- Modal for editJobs -->

<!-- Modal for deleteSkills -->
<section class="delexperience_modal">

                         <div class="modal fade" id="deleteJobs{{ $jobs->id }}" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                          <div class="modal-content">

                            <form method="" action="/jobs/deleteJobs/{{ $jobs->id }}" class="theme1"  enctype="multipart/form-data">

                                {{ csrf_field() }}  

                                         <div class="modal-header">
                                          
                                          <h4>Delete Job</h4>
                                        </div>
                                                  
                                        <div class="col-md-12 content-panel-header">
                                              <h3>Are you sure you want to delete the job about in {{ $jobs->company_name }}?</h3>

                                        </div>

                                        <div class="modal-footer">
                                             <button type="submit" class="btn btn-default">Delete</button> 
                                             <button  data-dismiss="modal" class="btn btn-default">Close</button>   
                                        </div>

                                <input type="hidden" value="{{ csrf_token() }}" name="_token" >  

                            </form>

                          </div>
                    
                  </div>
                </div>

</section>
<!-- Modal for delteJobs -->

<!-- Modal for deleteSkills -->
<section class="delexperience_modal">

                         <div class="modal fade" id="viewApplicant{{ $jobs->id }}" role="dialog">
                          <div class="modal-dialog modal-md">
                          
                            <!-- Modal content-->
                          <div class="modal-content">

                            <form method="" action="" class="theme1"  enctype="multipart/form-data">

                                {{ csrf_field() }}  

                                  <div class="modal-header"><h4>Applicant</h4></div>
                                                  
                                       
                                <div class="modal-body">
                                  <div class="row" style="padding:10px 0px 10px 0px;">
                                      <div class="col-xs-1">#</div>
                                      <div class="col-xs-2"></div>
                                      <div class="col-xs-3">NAME</div>
                                      <div class="col-xs-3">POSITION</div>
                                      <div class="col-xs-3">CVLINK</div>
                                  </div>

                                  
                                 
                                            <?php $n=0; ?>
                                            <?php $applicant = DB::table('applicant')->where('job_id', $jobs->id)->orderBy('id', 'desc')->get(); ?>

                                              <?php foreach ($applicant as $value) { ?>
                                              <?php $n++; ?>
                                              <?php $if_exist = DB::table('profiles')->where('user_id', $value->user_id)->count();  ?>

                                              <?php if($if_exist == 0){ ?> 

                                              <?php $user = DB::table('users')->where('id', $value->user_id)->first();  ?>
                                              <?php $settings = DB::table('settings')->where('user_id', $value->user_id)->count();  ?>
                                              <div class="row">
                                                  <div class="col-xs-1"><?php echo$n; ?></div>
                                                  <div class="col-xs-2">
                                                       <img class="img-responsive" style="width:50px;height:50px;border-radius:50px;" src="../profilepic/default_avatar.jpg"> 
                                                  </div>
                                                  <div class="col-xs-3"><p><?php echo $userprofile->name; ?></p></div>

                                                  <div class="col-xs-3">Not Set</div>
                                                  <?php if($settings == 0){ ?> 
                                                    <div class="col-xs-3">Not Set</div>
                                                  <?php }else{ ?> 
                                                     <div class="col-xs-3"><a target="_blank" href="<?php echo "https://ressuu.me/cv/".$settings->permalink; ?>">Link</a></div>
                                                  <?php } ?>
                                               </div>

                                              <?php }else{ ?> 

                                              <?php $userprofile = DB::table('profiles')->where('user_id', $value->user_id)->first();  ?>
                                              <?php $settings = DB::table('settings')->where('user_id', $value->user_id)->first();  ?>
                                              <div class="row">
                                                  <div class="col-xs-1"><?php echo$n; ?></div>
                                                  <div class="col-xs-2">
                                                    <?php if(!empty($userprofile->profile_picture ) AND $userprofile->profile_picture != " " ){ ?>
                                                      <img class="img-responsive" style="width:50px;height:50px;border-radius:50px;" src="../profilepic/<?php echo $userprofile->profile_picture; ?>">
                                                    <?php  }else{ ?>
                                                       <img class="img-responsive" style="width:50px;height:50px;border-radius:50px;" src="../profilepic/default_avatar.jpg"> 
                                                    <?php } ?>
                                                  </div>
                                                  <div class="col-xs-3">
                                                   <?php if(!empty($userprofile->name) AND $userprofile->name != " " ){ ?>
                                                      <?php echo $userprofile->name; ?>
                                                      <?php  }else{ ?>
                                                      <p>Not Set</p>
                                                    <?php } ?>
                                                  </div>
                                                  <div class="col-xs-3"><?php echo $userprofile->position; ?></div>
                                                  <div class="col-xs-3"><a target="_blank" href="<?php echo "https://ressuu.me/cv/".$settings->permalink; ?>">Link</a></div>
                                               </div>
                                             <?php } ?>

                                              <?php } ?>
                                              
                                      

                                      </div>       



                                        

                                    <div class="modal-footer"><button  data-dismiss="modal" class="btn btn-default">Close</button></div>

                                <input type="hidden" value="{{ csrf_token() }}" name="_token" >  

                            </form>

                          </div>

                    
                  </div>
                </div>

</section>
<!-- Modal for delteJobs -->

<?php $n++; ?>

<?php } ?>

<?php } ?> 
               

        
                </tbody> 
              </table>       

  </div>

               
</section>  
<section class="col-md-12 content-panel">
            <div class="content-experience">
                        <center><button data-toggle="modal" data-target="#addJobs">Add Jobs</button></center>
            </div>  
</section>



</content> 
<!-- Modal for Jobs -->
<section class="certification_modal">

           <div class="modal fade" id="addJobs" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

                  <form method="POST" action="/jobs/addJobs" class="theme1"  enctype="multipart/form-data">

                              {{ csrf_field() }}        
                                      <div class="col-md-12 content-panel-header">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         <h3>Add Jobs</h3>

                                      </div>

                                      <section>

                                           <div class="form-group form-group">
                                            <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="company_name" type="text" placeholder="Company Name">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                            <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="company_address" type="text" placeholder="Company Address">
                                            </div>
                                          </div>

                                          <div class="form-group form-group">
                                           <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="company_jobtitle" type="text" placeholder="Job Title">
                                            </div>
                                            
                                          </div>

                                          <div class="form-group form-group">
                                           <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control" name="company_rate" type="text" placeholder="Rate">
                                            </div>
                                            
                                          </div>

                                          <div class="form-group form-group">

                                            <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <textarea  class="form-control"  rows="5" cols="45" name="company_details">About Company</textarea>  
                                            </div>
                                            
                                          </div>


                                          <div class="form-group form-group">

                                            <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <textarea  class="form-control"  rows="5" cols="45" name="job_description">Job Description</textarea>  
                                            </div>
                                            
                                          </div>

                                           <div class="form-group form-group">
                                          
                                           <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                              <input class="form-control jobfile" name="logo" type="file" placeholder="Logo">
                                            </div>
                                            
                                          </div>
                                          <input type="hidden" value="{{ csrf_token() }}" name="_token" >
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
<!-- Modal for Jobs -->


                
</div>
@endsection


<?php } ?>



