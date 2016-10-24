@extends('layouts.app')
@extends('layouts.header')

@section('title')
    Profile
@endsection

@section('body-class')

@endsection


@section('content')

<div class="container wrap">
<sidebar class="col-md-3 ">

              <div class="row">
                <div class="user">
                  <img src="images/user.png">     
                </div>  
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
                         <?php $URL = 'http://'.str_ireplace('http://','',$userSettings->permalink); ?>
                             <a href="{{$URL}}" target="_blank" ><li><span class="glyphicon glyphicon-list-alt">&nbsp;</span>My CV</li></a>
                        <?php } ?>   
                        <a href="{{ url('/profile') }}"><li class="menuactive"><span class="glyphicon glyphicon-star">&nbsp;</span>Profile</li></a>
                        <a href="{{ url('/resume') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                        <a href="{{ url('/portfolio') }}"><li><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                        <a href="{{ url('/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
                        <a href="{{ url('/setting') }}"><li><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
                        <a href="{{ url('/logout') }}"><li><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li></a>
                  </ul>
              </nav>

</sidebar>
<content class="col-md-9">
<section class="col-md-12 content-header">

                    <div class="col-md-10">
                      <h3>People You May Know</h3>
                    
                    </div>

                    <div  class="col-md-2">
                      <img src="images/cancel.png"  class="cancel-button">
                    </div>

                    <div class="col-md-12">
                         <div class="col-md-4 content-profile-people"> 

                              <div class="col-md-5 people-img">
                                  <img src="images/user1.png"> 
                              </div>

                              <div class="col-md-7 people-status">
                                   <p class="people-name">Arya Stark</p>
                                   <p class="people-subname">Winterfell</p>
                                  <button class="following">Following</button>  
                              </div>                         
                                  
                              
                          </div>
                           <div class="col-md-4 content-profile-people"> 

                              <div class="col-md-5 people-img">
                                  <img src="images/user1.png"> 
                              </div>

                              <div class="col-md-7 people-status">
                                   <p class="people-name">Arya Stark</p>
                                   <p class="people-subname">Winterfell</p>
                                  <button class="follow">Follow</button>  
                              </div>                         
                                  
                              
                          </div> 
                          <div class="col-md-4 content-profile-people"> 

                              <div class="col-md-5 people-img">
                                  <img src="images/user1.png"> 
                              </div>

                              <div class="col-md-7 people-status">
                                   <p class="people-name">Arya Stark</p>
                                   <p class="people-subname">Winterfell</p>
                                  <button class="follow">Follow</button>  
                              </div>                         
                                  
                              
                          </div>
                    </div>

</section> 

       
                   
<section>
          
          <div class="col-md-12 content-panel-header"><h3>Profile</h3></div>

          <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Name</p>
                     </div>
                     <div class="col-md-9">
                            <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->name; ?></p>
                            <?php }else{ ?>
                               <p>{{ $name }}</p>
                            <?php } ?>                    
                                      
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Job Title</p>
                     </div>
                     <div class="col-md-9">
                            <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->position; ?></p>
                            <?php }else{ ?>
                               <p>not Set</p>
                            <?php } ?>                   
                          <p></p>            
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Birthday</p>
                     </div>
                     <div class="col-md-9">
                          <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->bday; ?></p>  
                            <?php }else{ ?>
                               <p>not Set</p>
                            <?php } ?>                     
                                    
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Address</p>
                     </div>
                     <div class="col-md-9">
                            <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->address; ?></p>     
                            <?php }else{ ?>
                               <p>not Set</p>
                            <?php } ?>                   
                                 
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Email</p>
                     </div>
                     <div class="col-md-9">                   
                           <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->email; ?></p>     
                            <?php }else{ ?>
                               <p>{{ $email }}</p>
                            <?php } ?>                 
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>        

          <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Phone</p>
                     </div>
                     <div class="col-md-9">
                      <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->phone; ?></p>       
                            <?php }else{ ?>
                               <p>Not Set</p>
                            <?php } ?>                   
                                  
                     </div>
                     <div class="col-md-12 line"></div>                
         </div> 
          
          <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Biography</p>
                     </div>
                     <div class="col-md-9">
                       <?php if ($if_exist == 1) { ?> 
                                <p><?php echo$userProfile->bio; ?></p>    
                            <?php }else{ ?>
                               <p>Not Set</p>
                            <?php } ?>                      
                                     
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>                          
</section>

<section>
          
          <div class="col-md-12 content-panel-header"><h3>Social Media</h3></div>

          <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Facebook</p>
                     </div>
                     <div class="col-md-9">
                      <?php if ($if_exist == 1) { ?> 
                                <p><?php echo$userProfile->facebook; ?></p>   
                            <?php }else{ ?>
                               <p>Not Set</p>
                            <?php } ?>                     
                                    
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Linkedin</p>
                     </div>
                     <div class="col-md-9">
                        <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->linkedin; ?></p> 
                            <?php }else{ ?>
                               <p>Not Set</p>
                            <?php } ?>                    
                                     
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

        <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Twitter</p>
                     </div>
                     <div class="col-md-9"> 
                      <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->twitter; ?></p> 
                            <?php }else{ ?>
                               <p>Not Set</p>
                            <?php } ?>                    
                                     
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

            <div class="col-md-12  content-panel">
                     <div class="col-md-3">
                        <p>Google</p>
                     </div>
                     <div class="col-md-9">
                     <?php if ($if_exist == 1) { ?> 
                               <p><?php echo$userProfile->google; ?></p>
                      <?php }else{ ?>
                               <p>Not Set</p>
                      <?php } ?>                      
                                      
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>
                       
</section> 
                  
<section>
            <div class="col-md-12 content-panel">
                    <div class="content-profile">
                        <center><button data-toggle="modal" data-target="#myModal">Edit Profile</button></center>
                    </div>
            </div>   
</section>



<section>

           <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">

        <?php if ($if_exist == 1) { ?> 
               <form method="" action="profile/edit">
        <?php }else{ ?>
              <form method="" action="profile/insert">
         <?php } ?> 


    <section class="theme1">
          <section>
                    
                    <div class="col-md-12 content-panel-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h3>Profile</h3>

                    </div>

                    <div class="col-md-12  content-panel">                 
                               <div class="col-md-3">
                                  <p>Name</p>
                               </div>
                               <div class="col-md-9">
                                <?php if ($if_exist == 1) { ?> 
                                        <input type="text" name="name" class="form-control" value="{{ $userProfile->name }}">
                                <?php }else{ ?>
                                        <input type="text" name="name" class="form-control" value="{{ $name }}">
                                <?php } ?>                     
                                              
                               </div>
                                            
                    </div>

                   <div class="col-md-12  content-panel">
                               <div class="col-md-3">
                                  <p>Job Title</p>
                               </div>
                               <div class="col-md-9">
                                <?php if ($if_exist == 1) { ?> 
                                        <input type="text" name="jobtitle" class="form-control" value="{{ $userProfile->position }}">  
                                <?php }else{ ?>
                                        <input type="text" name="jobtitle" class="form-control">
                                <?php } ?>
                                                              
                               </div>
                                           
                   </div>

                   <div class="col-md-12  content-panel">
                               <div class="col-md-3">
                                  <p>Birthday</p>
                               </div>
                               <div class="col-md-9">
                                                 
                                <?php if ($if_exist == 1) { ?> 
                                         <input type="text" name="bday" class="form-control" value="{{ $userProfile->bday }}"> 
                                <?php }else{ ?>
                                        <input type="text" name="bday" class="form-control">
                                <?php } ?>                
                               </div>
                                             
                   </div>

                   <div class="col-md-12  content-panel">
                               <div class="col-md-3">
                                  <p>Address</p>
                               </div>
                               <div class="col-md-9">
                                                       
                                <?php if ($if_exist == 1) { ?> 
                                         <input type="text" name="address"  class="form-control" value="{{ $userProfile->address }}"> 
                                <?php }else{ ?>
                                        <input type="text" name="address" class="form-control">
                                <?php } ?>          
                               </div>
                                   
                   </div>

                   <div class="col-md-12  content-panel">
                               <div class="col-md-3">
                                  <p>Email</p>
                               </div>
                               <div class="col-md-9">
                                                       
                                <?php if ($if_exist == 1) { ?> 
                                         <input type="email" name="email" class="form-control" value="{{ $userProfile->email }}">
                                <?php }else{ ?>
                                        <input type="text" name="email" class="form-control" value="{{ $email }}">
                                <?php } ?>               
                               </div>
                                    
                   </div>        

                    <div class="col-md-12  content-panel">
                               <div class="col-md-3">
                                  <p>Phone</p>
                               </div>
                               <div class="col-md-9">
                                                     
                                <?php if ($if_exist == 1) { ?> 
                                        <input type="text" name="phone" class="form-control" value="{{ $userProfile->phone }}">  
                                <?php }else{ ?>
                                        <input type="text" name="phone" class="form-control">
                                <?php } ?>                 
                               </div>
                                              
                   </div> 
                    
                    <div class="col-md-12  content-panel">
                               <div class="col-md-3">
                                  <p>Biography</p>
                               </div>
                               <div class="col-md-9">
                                <?php if ($if_exist == 1) { ?> 
                                         <textarea rows="5" cols="45" name="bio">
                                            {{ $userProfile->bio }}
                                          </textarea>    
                                <?php }else{ ?>
                                         <textarea rows="5" cols="45" name="bio">
                                        </textarea>  
                                <?php } ?> 
                                                    
                                           
                               </div>
                                              
                   </div>                          
          </section>

            <section>
                      
                      <div class="col-md-12 content-panel-header"><h3>Social Media</h3></div>

                      <div class="col-md-12  content-panel">
                                 <div class="col-md-3">
                                    <p>Facebook</p>
                                 </div>
                                 <div class="col-md-9">
                                                         
                                <?php if ($if_exist == 1) { ?> 
                                         <input type="text" name="facebook" class="form-control" value="{{ $userProfile->facebook }}">  
                                <?php }else{ ?>
                                        <input type="text" name="facebook" class="form-control">
                                <?php } ?> 
                                 </div>
                                        
                     </div>

                     <div class="col-md-12  content-panel">
                                 <div class="col-md-3">
                                    <p>Linkedin</p>
                                 </div>
                                 <div class="col-md-9">
                                                          
                                <?php if ($if_exist == 1) { ?> 
                                         <input type="text" name="linkedin" class="form-control" value="{{ $userProfile->linkedin }}">  
                                <?php }else{ ?>
                                        <input type="text" name="linkedin" class="form-control">
                                <?php } ?>             
                                 </div>
                                              
                     </div>

                    <div class="col-md-12  content-panel">
                                 <div class="col-md-3">
                                    <p>Twitter</p>
                                 </div>
                                 <div class="col-md-9">
                                                           
                                <?php if ($if_exist == 1) { ?> 
                                        <input type="text" name="twitter" class="form-control" value="{{ $userProfile->twitter }}">  
                                <?php }else{ ?>
                                        <input type="text" name="twitter" class="form-control">
                                <?php } ?>             
                                 </div>
                                               
                     </div>

                      <div class="col-md-12  content-panel">
                                 <div class="col-md-3">
                                    <p>Google</p>
                                 </div>
                                 <div class="col-md-9">
                                                          
                                    <?php if ($if_exist == 1) { ?> 
                                        <input type="text"  name="google" class="form-control" value="{{ $userProfile->google }}">
                                <?php }else{ ?>
                                        <input type="text" name="google" class="form-control">
                                <?php } ?>    
                                 </div>
                                               
                     </div>




                                   
            </section>
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
                
               
</content>
              
</div>





@endsection
