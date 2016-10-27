@extends('layouts.app')
@extends('layouts.header')

@section('title')
   - Portfolio
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
                        <a href="{{ url('/profile') }}"><li><span class="glyphicon glyphicon-star">&nbsp;</span>Profile</li></a>
                        <a href="{{ url('/resume') }}"><li><span class="glyphicon glyphicon-flag">&nbsp;</span>Resume</li></a>
                        <a href="{{ url('/portfolio') }}"><li class="menuactive"><span class="glyphicon glyphicon-send">&nbsp;</span>Portfolio</li></a>
                        <a href="{{ url('/jobs') }}"><li><span class="glyphicon glyphicon-calendar">&nbsp;</span>Jobs</li><span class="jobbagde">6</span></a>    
                        <a href="{{ url('/setting') }}"><li><span class="glyphicon glyphicon-cog">&nbsp;</span>Settings</li></a>
                        <a href="{{ url('/logout') }}"><li><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li></a>
                  </ul>
              </nav>

</sidebar>
 <content class="col-md-9">
 
 <section class="col-md-12 content-header portfolio">

     <div class="col-md-10">
          <h3>Portfolio</h3> 
          <p class="">Subheading here</p>    
      </div>
                  
     <div  class="col-md-2">
        <a href="#"><img  src="images/menu.png" class="nav-menu"></a>
     </div>

 </section>


<section  class="col-md-12 content-portfolio"> 
    <nav class="col-md-12">
        <ul>
             <li class="active">
              <a href="#tab0" role="tab" data-toggle="tab">All</a></li>
           @foreach ($userPorfoliosCategories as $userCategories)
             <li><a href="#tab{{ $userCategories->id }}" role="tab" data-toggle="tab">{{ $userCategories->title }}</a></li>
           @endforeach
        </ul>
    </nav>

    <section  class="tab-content">
        <!-- All -->
        <section role="tabpanel" class="tab-pane active" id="tab0">
               @foreach ($userPorfolios as $userPorfolio)
                    <div class="col-md-4" data-toggle="modal" data-target="#all_{{ $userPorfolio->id }}">
                        <center>
                        <div class="portfolio-details form-group hvr-float-shadow">


                 <?php $fileName = "upload/".$userPorfolio->post_thumbnail;
                    if(file_exists($fileName)){  ?>
                             <img src="upload/{{ $userPorfolio->post_thumbnail }}" class="img-responsive">
                 <?php }else{ ?>
                              <img src="images/portfolio_images.png" class="img-responsive"> 
                 <?php } ?>      

                         
                          <div class="ro$fileNamew">
                            {{ $userPorfolio->port_title }}
                          </div>
                        </div>
                        </center>
                    </div>

                  <!-- Modal for All_PorfolioCategory -->
                          <section>
                                    <div class="modal fade" id="all_{{ $userPorfolio->id }}" role="dialog">
                                      <div class="modal-dialog">
                                            <!-- Modal content-->
                                              <div class="modal-content">
                                                    
                                                                        
                                                    <div class="col-md-12 content-panel-header">

                                                        <center>
                                                         <h4>{{ $userPorfolio->port_title }}</h4>
                                                          <?php $fileName = "upload/".$userPorfolio->post_thumbnail;
                                                              if(file_exists($fileName)){  ?>
                                                                       <img src="upload/{{ $userPorfolio->post_thumbnail }}" class="img-responsive">
                                                           <?php }else{ ?>
                                                                        <img src="images/portfolio_images.png" class="img-responsive"> 
                                                           <?php } ?> 
                                                          <p class="text-center">{{ $userPorfolio->port_excerpt }}</p>   
                                                        </center>
                                                    </div>
                                              </div>
                                            
                                       </div>
                                    </div>

                          </section>
                  <!-- Modal for All_PorfolioCategory -->



               @endforeach 
        </section>
        <!-- All -->



     <?php foreach ($userPorfoliosCategories as $userCategories) { ?>
    
        <section role="tabpanel" class="tab-pane" id="tab{{ $userCategories->id }}">

          <?php 
              $userId = Auth::id();
            /* $portfolioCat = DB::table('portfolio')
                ->where('category_id',$userCategories->id)
                ->orderBy('id', 'desc')
                ->get(); 
              */
          $portfolioCat = DB::select('select * from portfolio where category_id = :id  and user_id = :userid', 
            ['id' => $userCategories->id,'userid' => $userId]);   
         
         ?>

          <?php  foreach ($portfolioCat as $category) { ?>
              <div class="col-md-4" data-toggle="modal" data-target="#cat_{{ $category->id }}">
                        <center>
                        <div class="portfolio-details form-group hvr-float-shadow">
                          <?php $fileName = "upload/".$category->post_thumbnail;
                            if(file_exists($fileName)){  ?>
                            <img src="upload/{{ $category->post_thumbnail }}" class="img-responsive">
                              <?php }else{ ?>
                            <img src="images/portfolio_images.png" class="img-responsive"> 

                            <?php } ?>

                          <div class="row">
                           <?php  echo $category->port_title; ?>                        
                          </div>

                        </div>
                        </center>
              </div> 
               <!-- Modal for PorfolioCategory -->
                          <section>
                                    <div class="modal fade" id="cat_{{ $category->id }}" role="dialog">
                                      <div class="modal-dialog">
                                            <!-- Modal content-->
                                              <div class="modal-content">
                                                    
                                                                        
                                                    <div class="col-md-12 content-panel-header">

                                                        <center>
                                                         <h4>{{ $category->port_title }}</h4>
                                                          <?php $fileName = "upload/".$category->post_thumbnail;
                                                          if(file_exists($fileName)){  ?>
                                                          <img src="upload/{{ $category->post_thumbnail }}" class="img-responsive">
                                                            <?php }else{ ?>
                                                          <img src="images/portfolio_images.png" class="img-responsive"> 

                                                          <?php } ?>
                                                          <p class="text-center">{{ $category->port_excerpt }}</p>   
                                                        </center>
                                                    </div>
                                              </div>
                                            
                                       </div>
                                    </div>

                          </section>
                  <!-- Modal for PorfolioCategory -->

           <?php } ?>
            
        </section>


      <?php } ?>


 


    </section>
 
     
        
</section>

<section class="col-md-12 content-panel">
            <div class="content-experience">
                        <center><button data-toggle="modal" data-target="#myModal">Add Portfolio</button></center>
            </div>  
</section>

<!-- Modal for add_Porfolio -->
 <section>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
                <div class="modal-content">

<form method="POST" action="portfolio/addPortfolio" class="theme1" enctype="multipart/form-data" files="true">
 {{ csrf_field() }}
                                        <div class="col-md-12 content-panel-header">
                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                           <h3>Add Portfolio</h3>

                                        </div>

                                        <section>

                                            <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                                <input class="form-control" name="port_title" type="text" placeholder="Portfolio Title">
                                              </div>
                                            </div>

                                             <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                                <select class="form-control" name="category_id">
                                                    @foreach ($userPorfoliosCategories as $userCategories)
                                                     <option value="{{ $userCategories->id }}">{{ $userCategories->title }}</option>
                                                   @endforeach
                                                </select>
                                              </div>
                                            </div>
                          
                                           <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-sm-10">
                                                <input  class="form-control input-file" name="image" type="file" id="icondemo">
                                              </div>
                                                
                                            </div>
                                         

                                            <div class="form-group form-group">
                                              <div class="col-md-offset-1 col-md-10">
                                                <textarea class="form-control" name="description" rows="5" cols="10">Portfolio Description</textarea>
                                              </div>
                                             
                                            </div>
                                            <input type="hidden" value="{{ csrf_token() }}" name="_token" >
                                       </section>

                              <div class="modal-footer">

                                   <button type="submit" class="btn btn-default">Save</button>
                      

                              </div>
                    </form>
                          </div>                         
                                            
           </div>
     </div>

</section>
<!-- Modal for add_Porfolio -->



</content>
              
</div>
@endsection
