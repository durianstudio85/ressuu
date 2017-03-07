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
              <?php $n =0; ?>
<?php foreach ($jobList as $jobs) { ?>
<?php $n++; ?>
<tr> 
  <th scope="row"><?php echo$n; ?></th> 
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

                               <div class="modal fade" id="viewJobs{{ $jobs->id }}" role="dialog">
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
                                                            <p>Salary Rate </p>
                                                  </div>  
                                                  <div class="col-md-7">
                                                            <p class="job_salary">{{ $jobs->company_rate }}</p>
                                                  </div>
                                                                
                                             </div>

                                              <div class="col-md-12  content-panel">
                                                  <div class="col-md-12">
                                                            <p>About Company:  </p>
                                                  </div>
                                                  <div class="col-md-12">
                                                            <p>{{ $jobs->company_details }}</p>
                                                  </div>
                                                                
                                             </div>

                                             <div class="col-md-12  content-panel">
                                                  <div class="col-md-12">
                                                            <p>Job Description</p>
                                                  </div>
                                                  <div class="col-md-12">
                                                            <p>{!! nl2br( $jobs->company_status) !!}</p>
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
<!-- Modal -->
<!-- Modal for editJobs -->
 <section class="upeducation_modal">

                               <div class="modal fade" id="editJobs{{ $jobs->id }}" role="dialog">

                                    <div class="modal-dialog">
                                    
                                      <!-- Modal content-->
                                      <div class="modal-content">

                                      <form method="POST" action="/jobs/editJobs" class="theme1"  enctype="multipart/form-data">
                                          {{ csrf_field() }}  
                                                          
                                                          <div class="col-md-12 content-panel-header">
                                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                             <h3>Update {{ $jobs->company_job }} </h3>

                                                          </div>
                                                          <section>
                                                                      <input type="hidden" value="{{ $jobs->id }}" name="id">

                                                               <div class="form-group form-group">

                                                                <div class="col-md-offset-1 col-sm-10">
                                                                  <input class="form-control job_input" name="company_name" type="text" value="{{ $jobs->company_name }}">

                                                                </div>
                                                              </div>

                                                              <div class="form-group form-group">
                                                                <div class="col-md-offset-1 col-sm-10">
                                                                  <input class="form-control job_input" name="company_address" type="text" value="{{ $jobs->company_address }}">
                                                                </div>
                                                              </div>

                                                              <div class="form-group form-group">
                                                                <div class="col-md-offset-1 col-sm-10">
                                                                  <input class="form-control job_input" name="company_jobtitle" type="text" value="{{ $jobs->company_job }}">
                                                                </div>
                                                              </div>


                                                                   <div class="form-group form-group">
                                                                <div class="col-md-offset-1 col-sm-10">
                                                                  <input class="form-control job_input" name="company_rate" type="text" value="{{ $jobs->company_rate }}">
                                                                </div>
                                                              </div>

                                                          
                                                              <div class="form-group form-group">
                                                                <div class="col-md-offset-1 col-md-10">
                                                                  <textarea class="form-control job_input" name="company_details" rows="5" cols="10">{{ $jobs->company_details }}</textarea>
                                                                </div>
                                                               
                                                              </div>

                                                              <div class="form-group form-group">
                                                                <div class="col-md-offset-1 col-md-10">
                                                                  <textarea  class="form-control job_input"  rows="5" cols="45" name="job_description">{{ $jobs->company_status }}</textarea>  
                                                                </div>
                                                               
                                                              </div>


                                                                 <div class="form-group form-group">
                                                                  <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                     <p>Logo</p>
                                                                    </div>
                                                                   <div class="col-xs-12 col-md-offset-1 col-sm-10">
                                                                      <input class="form-control jobfile" name="logo" type="file" placeholder="Logo">
                                                                      <input class="form-control jobfile" name="oldlogo" type="hidden" value="<?php echo $jobs->company_picture; ?>">
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

<!-- Modal for editJobs -->

 <!-- Modal for deletejob -->
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
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                            <div class="modal-content">

                              <form method="" action="" class="theme1"  enctype="multipart/form-data">

                                  {{ csrf_field() }}  

                                           <div class="modal-header">
                                            
                                            <h4>Applicant</h4>
                                          </div>
                                                    
                                          <div class="col-md-12 content-panel-header">
                                          <?php 
                                              $applicant = DB::table('applicant')
                                                          ->where('job_id', $jobs->id)
                                                          ->orderBy('id', 'desc')
                                                          ->get();
                                          ?>
                                          <?php foreach ($applicant as $value) { ?>
                                            <?php $userprofile = DB::table('profiles')->where('user_id', $value->user_id)->first();  ?>
                                            <h4><?php echo $userprofile->name; ?></h4>
                                       
                                          <?php } ?>
                                          
                                          </div>

                                          <div class="modal-footer">
                                                
                                               <button  data-dismiss="modal" class="btn btn-default">Close</button>   
                                          </div>

                                  <input type="hidden" value="{{ csrf_token() }}" name="_token" >  

                              </form>

                            </div>
                      
                    </div>
                  </div>

  </section>
  <!-- Modal for delteJobs -->


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



