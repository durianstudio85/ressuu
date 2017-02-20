@extends('layouts.app')


@section('title')
   | Settings
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
                 <?php if ($if_exist == 1) { ?>
      
                    <?php if(!empty($userProfile->profile_picture)  AND $userProfile->profile_picture != " "   ){ ?>
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
                      
                        <a href="{{ url('/profile') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Profile</li></a>
                        <a href="{{ url('/resume') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                        <a href="{{ url('/portfolio') }}"><li><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                        <a href="{{ url('/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
                        <a href="{{ url('/setting') }}"><li class="menuactive"><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
                        <a href="{{ url('/logout') }}"><li><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li></a>
                  </ul>
              </nav>

</sidebar>
<content class="col-md-9 spage">
<a href="https://duriangraphics.com/"> 
<section class="col-xs-12 col-md-12 content-header ads-bg">

                    <div class="col-xs-12 col-md-12 content-people-wrap "> </div>

</section>
</a>             
<section>
          
          <div class="col-xs-12  col-md-12 content-panel-header"><h3>Settings</h3></div>

          <div class="col-xs-12 col-md-12 content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Themes</p>
                     </div>
                     <div class="col-xs-4 col-md-4">
                     <?php if ($if_exist_settings == 0) { ?>
                               <p>Active Theme</p>                   
                              <img src="images/theme1.jpg" class="img-themes"> 
                      <?php }else{?> 
                              <?php  if ( $userSettings->theme == "clean-modern") { ?>
                                         <p>Active Theme | Theme 1</p>  
                                          <img src="images/theme2.jpg" class="img-themes"> 
                              <?php }else{ ?>
                                          <p>Active Theme | Theme 2</p> 
                                         <img src="images/theme1.jpg" class="img-themes"> 
                              <?php } ?>
                      <?php } ?> 
                                   
                     </div>
                      <div class="col-xs-4 col-md-5">
                        <p>Preview Available Themes</p>
                        <ul>
                          <li><a href="/previewcv/theme1/<?php echo Auth::id(); ?>">Theme 1</a></li>
                          <li><a href="/previewcv/theme2/<?php echo Auth::id(); ?>">Theme 2</a></li>
                        </ul>
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">CV Status</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                      <?php if ($if_exist_settings == 0) { ?>
                               <p>Not Set</p>
                      <?php }else{?> 
                              <p><?php echo ucfirst($userSettings->status); ?></p>

                      <?php } ?>           
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title" >Username</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                        <p>{{$email}}</p>            
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title" >CV Link</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                     <?php if ($if_exist_settings == 0) { ?>
                               <p>Not Set</p>
                      <?php }else{?> 
                               <p style="width:100px;">{{$userSettings->permalink }}</p>
                      <?php } ?>                     
                                      
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>

         <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Embeded Code</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                   
                      <?php if ($if_exist_settings == 0) { ?>
                            <p><code>Not Set</code></p>
                      <?php }else{?>
                             <p><code>{{$userSettings->preview}}</code></p>   
                      <?php } ?>                   
                                   
                     </div>
                     <div class="col-md-12 line"></div>                
         </div>        

          <div class="col-xs-12 col-md-12  content-panel">
                     <div class="col-xs-3 col-md-3">
                        <p class="title">Token Key</p>
                     </div>
                     <div class="col-xs-9 col-md-9">
                      <?php if ($if_exist_settings == 0) { ?>
                            <p>Not Set</p>
                      <?php }else{?>
                            <p>{{$userSettings->key}}</p>   
                      <?php } ?>                
                         
                     </div>
                     <div class="col-md-12 line"></div>                
         </div> 
          
                                
</section>
                  
<section class="setting-foot">
             <div class="col-xs-12 col-md-12  content-panel">
                    <div class="content-profile">
                        <center><button data-toggle="modal" data-target="#myModal">Update</button></center>
                    </div>
            </div>   
</section>
                

<!-- Modal for Update_Settings -->
 <section>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
                <div class="modal-content">
   
                    <form method="POST" action="setting/updateSettings" class="theme1" enctype="multipart/form-data">
 {{ csrf_field() }}
                                        <div class="col-md-12 content-panel-header">
                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                           <h3>Update Settings</h3>

                                        </div>

                                        <section>

                                             <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                            <?php if ($if_exist_settings == 0) { ?>
                                                  <select class="form-control" name="themes">
                                                    <option value="clean-modern">Theme1</option>
                                                    <option value="default">Theme2</option>
                                                </select>
                                            <?php }else{?>
                                                     <?php  if ( $userSettings->theme == "clean-modern") { ?>
                                                          <select class="form-control" name="themes">
                                                            <option value="clean-modern">Theme1</option>
                                                            <option value="default">Theme2</option>
                                                          </select>
                                                     <?php }else{ ?>
                                                          <select class="form-control" name="themes">
                                                            <option value="default">Theme2</option>
                                                            <option value="clean-modern">Theme1</option>  
                                                          </select> 
                                                     <?php } ?>
                                                 
                                            <?php } ?>
                                            </div>
                                            </div>

                                             <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                            <?php if ($if_exist_settings == 0) { ?>
                                                    <select class="form-control" name="cv_status">
                                                    <option value="public">Public</option>
                                                    <option value="private">Private</option>
                                                </select>
                                            <?php }else{?>
                                                     <?php  if ( $userSettings->status == "public") { ?>
                                                          <select class="form-control" name="cv_status">
                                                              <option value="public">Public</option>
                                                              <option value="private">Private</option>
                                                          </select>
                                                     <?php }else{ ?>
                                                          <select class="form-control" name="cv_status">
                                                              <option value="private">Private</option>
                                                              <option value="public">Public</option> 
                                                          </select> 
                                                     <?php } ?>
                                                 
                                            <?php } ?>  


                                             
                                              </div>
                                            </div>
                                            

                                            <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                               <?php if ($if_exist_settings == 0) { ?>
                                                 <input class="form-control" name="username" type="text" value="{{$email}}">
                                                <?php }else{?>
                                                 <input class="form-control" name="username" type="text" value="{{ $userSettings->username }}">     
                                                <?php } ?>  
                                              </div>
                                            </div>
                                            
                                             <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                                <?php if ($if_exist_settings == 0) { ?>
                                                 <input class="form-control" name="cv_link" type="text" placeholder="CV link" value="{{$cvlink}}">
                                                <?php }else{?>                                               
                                                 <input class="form-control" name="" type="text" value="{{$create_cvlink}}">
                                                 <input class="form-control" name="cv_link" type="hidden" value="{{$cvlink}}">
                                                <?php } ?>
                                              </div>
                                            </div>

                                            <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-md-10">
                                              <?php if ($if_exist_settings == 0) { ?>
                                               <textarea class="form-control" name="embeded_code" rows="5" cols="10">&lt;iframe src="<?php echo $create_cvlink; ?>" width="100%" scrolling="yes" style="border:0"&gt; &lt;/iframe&gt;
                                               </textarea>
                                              <?php }else{?>
                                               <textarea class="form-control" name="embeded_code" rows="5" cols="10">&lt;iframe src="<?php echo $create_cvlink; ?>" width="100%" scrolling="yes" style="border:0"&gt; &lt;/iframe&gt;
                                               </textarea>
                                              <?php } ?>
                                               
                                              </div>
                                             
                                            </div>

                                              <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                              <?php if ($if_exist_settings == 0) { ?>
                                                <input class="form-control" name="token_key" type="text" value="<?php echo$token; ?>">
                                              <?php }else{?>

                                                  <?php if(empty($userSettings->key)){ ?>
                                                         <input class="form-control" name="token_key" type="text" placeholder="Token Key" value="<?php echo$token; ?>">

                                                  <?php }else{ ?>
                                                      <input class="form-control" name="token_key" type="text" value="{{ $userSettings->key }}">

                                                  <?php } ?>


                                              <?php } ?>
                                               
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
<!-- Modal for Update_Settings -->


               
</content>
              
</div>
@endsection
