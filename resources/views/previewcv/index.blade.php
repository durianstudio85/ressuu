<?php $theme_selection = $theme_name; ?>



<?php if($theme_selection == "theme2"){ ?>

 <!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
   <meta charset="utf-8">
        
   <title>Ressuu.me | <?php echo $profiles->name; ?></title>
    
   <!-- Mobile viewport optimized -->
   <meta name="viewport" content="width=device-width">
    
   <!-- Style Sheets -->

   <link rel="stylesheet" href="../../cv/clean_modern/style.css">
   <link rel="stylesheet" href="../../cv/clean_modern/scripts/prettyPhoto/css/prettyPhoto.css">   
      <link rel="shortcut icon" type="image/x-icon" href="/../../images/fav icon.png">   
   <!-- Favicon -->
   <link rel="shortcut icon" href="favicon.ico">    
   <!-- Google Fonts -->
   <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic' rel='stylesheet' type='text/css'>
    
   <!--[if lt IE 9]>
        <script src="js/html5.js"></script>             
   <![endif]-->
</head>
<body>              
   <section id="wrapper" class="clearfix">
      <header id="main-head" class="clearfix">
      
         <!-- Author Info -->
         <section class="author-info">
            <figure class="author-img">
               <a href="#">
                  <img src="../../profilepic/eduardo.jpg" class="cv_theme1_img" />
               </a>
            </figure>
            <h1 class="name"><?php echo $profiles->name; ?></h1>
            <p class="statement"><?php echo $profiles->position; ?></p>
            <p class="author-links">
               <a href="#" class="dwl-vcard">Download my vcard</a>
               <a href="mailto:layergeek@gmail.com" class="hireme">Hire me</a>
            </p>
         </section>
         
         <!-- Navigation -->
         <nav class="main-nav">
            <ul>
               <li class="active"><a href="#" title="homepage">Profile</a></li>
               <li><a href="#" title="resume">Resume</a></li>
               <li><a href="#" title="work">Work</a></li>
               <li><a href="#" title="contact">Contact</a></li>
            </ul>
         </nav>
     
      </header>
      
      <!-- Social Icons -->
      <aside id="sidebar">
         <ul class="social-nav">
            <li class="twitter"><a href="#">Twitter</a></li>
            <li class="facebook"><a href="#">Facebook</a></li>
            <li class="linkedin"><a href="#">Linkedin</a></li>
         </ul>
      </aside>
      
      <p id="page-loader"><img src="../../cv/clean_modern/images/pageload.gif" alt="Loading..." /></p>
                        
      <section id="content">                       
      </section>
      
      <!-- Profile -->                    
      <section class="homepage-section hidden-section">                             
         <section class="biography clearfix">
            <section class="left-col">
             <h3>Biography</h3>
            </section>
            <section class="right-col">
               <p><?php echo $profiles->bio;?></p>
            </section>
         </section>
                                  
         <section class="clients clearfix">
            <section class="left-col">
               <h3>Clients</h3>
            </section>
            <section class="right-col">
               <ul>
                <li>
                   <blockquote>
                      <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur Aenean eu leo quam. Pellentesque ornare sem lacinia quam vene.</p>
                   </blockquote>
                   <p class="author">Steve<cite>&nbsp; Apple.com</cite></p>
                </li>
                  <li>
                   <blockquote>
                      <p>Donec ullamcorper nulla non metus auctor fringilla. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                   </blockquote>
                   <p class="author">Larry<cite>&nbsp; Google.com</cite></p>
                </li>
             </ul>
            </section>
         </section>                              
        </section>
      
        <!-- Resume -->
        <section class="hidden-section resume-section">
           <section class="experience clearfix">
              <h3>Experience</h3>
              <ul class="exp-list">

               @foreach ($work_experience as $work) 
                <br>                         
                         <li>
                            <section class="left-col">
                             <h4>{{ $work->company_name }}</h4>
                             <h4 class="meta">{{ $work->start_date }} - {{ $work->end_date }}</h4>
                          </section>
                          <section class="right-col">
                             <h4 class="heading">{{ $work->job_title }}</h4>
                             <p>{{ $work->description }}</p>
                          </section>
                         </li>

               @endforeach 
                 </li>
              </ul>
           </section>
           
           <!-- Skills --> 
           <br>                     
           <section class="skills">
              <section class="left-col">
                 <h4>SKILLS</h4>
              </section>
              <section class="right-col">
                 <ul class="skill-list">
                    @foreach ($skills as $my_skills) 
                    <li>
                       <p class="label">{{ $my_skills->skillname }}</p>
                       <p class="level"><span title="{{ $my_skills->rate }}0"></span></p>
                    </li> 
                    @endforeach
                    
                 </ul>
             </section>
           </section>

      </section>
 
      <!-- Portfolio -->                   
      <section class="hidden-section work-section">                         
         <section class="portfolio">
            <div class="filter-by">
               <h4>Filter by:</h4>
               <a href="#" data-filter="all">All</a>
                @foreach ($userPorfoliosCategories as $userCategories)
                            <a href="#" data-filter="{{ $userCategories->title }}">{{ $userCategories->title }}</a>
                @endforeach         
               <a href="#" data-filter="branding">Branding</a>
               <a href="#" data-filter="illustration">Illustration</a>
               <a href="#" data-filter="artwork">Artwork</a>
               <a href="#" data-filter="print">Print</a>
               <a href="#" data-filter="webdesign">Web design</a>
            </div>
            
            <ul id="portfolio" class="port-list isotope">

                
                  <?php foreach ($userPorfoliosCategories as $userCategories) { ?>

                             <?php 

                                  $userId = $profiles->user_id;         
                                  $portfolioCat = DB::select('select * from portfolio where category_id = :id  and user_id = :userid', 
                                  ['id' => $userCategories->id,'userid' => $userId]);   
                                
                              ?>

                           

                            <?php  foreach ($portfolioCat as $category) { ?>
       
                            <li class="all isotope-item {{ $userCategories->title }}">

                                 <?php $fileName = "upload/".$category->post_thumbnail;
                                      if(file_exists($fileName)){  ?>
                                        <figure>
                                              <a class="prettyPhoto" href="../../upload/{{ $category->post_thumbnail }}" title="{{ $category->port_excerpt }}">
                                                    <img src="../../upload/{{ $category->post_thumbnail }}" class="work-image" style="width:100%;height:100%;"   />
                                              </a>
                                        </figure>
                                      
                                      <?php }else{ ?>
                                      <figure>
                                           <a class="prettyPhoto" href="../../images/portfolio_images.png" title="<?php echo $category->port_title; ?>">
                                                <img src="../../images/portfolio_images.png" class="work-image" />                                           </a>
                                      </figure>
                                                  


                                <?php } ?>
                               <section class="desc">
                                      <section class="descin">
                                     <h5>{{ $userCategories->title }}</h5>
                                         <p class="inc"><?php echo $category->port_title; ?> </p>
                                  </section>
                                </section>

                             </li>

                            <?php } ?>


                  <?php } ?>

                
           

               
            </ul>                                        
        </section>                               
    </section>
    
    <!-- Contact -->                    
    <section class="hidden-section contact-section">                                
       <section class="contact">                                    
          <h3 class="contact-head">Let's talk <span class="plane"><img src="../../cv/clean_modern/images/plane.png" alt="" /></span></h3>
          <form action="scripts/contact.php" method="post" id="contact-form" class="clearfix">
              <div class="left">
                 <p><input type="text" name="name" id="name" class="required" value="Full Name" /></p>
                 <p><input type="text" name="email" id="email" class="required email" value="Email Address" /></p>
                 <p><input type="text" name="number" id="number" class="required" value="Phone Number" /></p>
              </div>
              <div class="right clearfix">
                 <textarea name="message" id="message" cols="30" rows="10" class="required">Message</textarea>
                 <p id="message-sent">Message sent successfully</p>
                 <p id="loading"><img src="../../images/loading.gif" alt="Sending..." /></p>
                 <input type="submit" id="submit" value="Submit" />
              </div>
           </form>                                        
        </section>                                
     </section>                     
    
</section>  

<!-- JS Scripts -->
<script src="../../cv/clean_modern/js/jquery-1.8.2.min.js"></script>
<script src="../../cv/clean_modern/js/jquery.prettyPhoto.js"></script>
<script src="../../cv/clean_modern/js/jquery.selectbox-0.5.js"></script>
<script src="../../cv/clean_modern/js/jquery.easing.1.3.js"></script>
<script src="../../cv/clean_modern/js/jquery.form.js"></script>
<script src="../../cv/clean_modern/js/jquery.validate.js"></script>
<script src="../../cv/clean_modern/js/custom.js"></script>                
                    
</body>
</html>






<?php } elseif($theme_selection == "theme1"){ ?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ressuu.me | <?php echo $profiles->name; ?></title>

    <link rel="stylesheet" type="text/css" href="../../cv/yellow_theme/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../../cv/yellow_theme/css/fancybox.css"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic"/>
    
    <script type="text/javascript" src="../../cv/yellow_theme/js/jquery.min.js"></script>
    <script type="text/javascript" src="../../cv/yellow_theme/js/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="../../cv/yellow_theme/js/respond.min.js"></script>
    <script type="text/javascript" src="../../cv/yellow_theme/js/jquery.adipoli.min.js"></script>
    <script type="text/javascript" src="../../cv/yellow_theme/js/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="../../cv/yellow_theme/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="../../cv/yellow_theme/js/jquery.gmap.min.js"></script>
    <script type="text/javascript" src="../../cv/yellow_theme/js/custom.js"></script>
       <link rel="shortcut icon" type="image/x-icon" href="/../../images/fav icon.png">   

</head>
    <body>

        
<!--START THEME 2  -->   

        <!-- Container -->
        <div id="container">
        
            <!-- Top -->
            <div class="top"> 
                <!-- Logo -->
                <div id="logo">
                    <h2> <?php echo $profiles->name; ?> </h2>
                    <h4> <?php echo $profiles->position; ?> </h4>
                </div>
                <!-- /Logo -->
                
                <!-- Social Icons -->
                <ul class="socialicons">
                    <li><a href="#" class="social-text">SOCIAL PROFILES</a></li>
                    <li><a href="http://<?php echo $profiles->facebook; ?>" class="social-facebook" target="_blank"></a></li>
                    <li><a href="http://<?php echo $profiles->twitter; ?>" class="social-twitter" target="_blank"></a></li>
                    <li><a href="http://<?php echo $profiles->linkedin; ?>" class="social-in" target="_blank"></a></li>
                    <li><a href="http://<?php echo $profiles->google; ?>" class="social-googleplus" target="_blank"></a></li>
                </ul>
                <!-- /Social Icons -->
            </div>
            <!-- /Top -->
            
            <!-- Content -->
            <div id="content" >
            
                <!-- Profile -->
                <div id="profile"> 
                    <!-- About section -->
                    <div class="about">
                        <div class="photo-inner"><img src="../../profilepic/eduardo.jpg" height="186" width="153" /></div>
                        <h1><?php echo $profiles->name; ?></h1>
                        <h3><?php echo $profiles->position; ?></h3>
                        <p><?php echo $profiles->bio;?></p>
                    </div>
                    <!-- /About section -->
                     
                    <!-- Personal info section -->
                    <ul class="personal-info">
                        <li><label>Name</label><span><?php echo $profiles->name; ?></span></li>
                        <li><label>Birthday</label><span><?php echo $profiles->bday; ?></span></li>
                        <li><label>Address</label><span><?php echo $profiles->address; ?></span></li>
                        <li><label>Email</label><span><?php echo $profiles->email; ?></span></li>
                        <li><label>Phone</label><span><?php echo $profiles->phone; ?></span></li>
                        <li><label>Website</label><span><?php echo $profiles->facebook; ?></span></li>
                    </ul>
                    <!-- /Personal info section -->
                </div>        
                <!-- /Profile --> 

                <!-- Menu -->
                <div class="menu">
                    <ul class="tabs">
                        <li class="tmenu"><a href="#profile" class="tab-profile">Profile</a></li>
                        <li class="tmenu"><a href="#resume" class="tab-resume">Resume</a></li>
                        <li class="tmenu"><a href="#portfolio" class="tab-portfolio">Portfolio</a></li>
                        <li class="tmenu"><a href="#contact" class="tab-contact">Contact</a></li>
                    </ul>
                </div>
                <!-- /Menu --> 
                
                <!-- Resume -->
                <div id="resume">
                     <div class="timeline-section">
                        <!-- Timeline for Employment  -->   
                        <h3 class="main-heading"><span>Experience</span></h3>   
                        <ul class="timeline">
                        @foreach ($work_experience as $work)                          
                            <li>
                                                   
                                <div class="timelineUnit">
                                    <h4>{{ $work->job_title }}<span class="timelineDate">{{ $work->start_date }} - {{ $work->end_date }}</span></h4>
                                    <h5>{{ $work->company_name }}</h5>
                                    <p>{{ $work->description }}</p>
                                </div>
                            </li>
                        @endforeach 
                            <div class="clear"></div>
                        </ul> 
                        <!-- /Timeline for Employment  -->

                        <!-- Timeline for Education  -->   
                        <h3 class="main-heading"><span>Education</span></h3>   
                         <ul class="timeline">

                        @foreach ($education as $edu)  
                            <li>            
                                <div class="timelineUnit">
                                    <h4>{{ $edu->school }}<span class="timelineDate">{{ $edu->date_start }} - {{ $edu->date_end }}</span></h4>
                                    <h5>{{ $edu->course }}</h5>
                                    <p>{{ $edu->awards_rec }}</p>
                                </div>
                            </li>
                         @endforeach    
                            <div class="clear"></div>
                        </ul> 
                        <!-- /Timeline for Education  -->              
                    </div>
                    <div class="skills-section">
                        <!-- Skills -->
                        <h3 class="main-heading"><span>Skills</span></h3> 
                        <ul class="skills">
                             @foreach ($skills as $my_skills)  
                                    <li>
                                        <h4>{{ $my_skills->skillname }}</h4>
                                        <span class="rat{{ $my_skills->rate }}"></span>
                                    </li>
                             @endforeach
                            
                        </ul>
                   
                     
                     <!-- /Skills -->
                     </div>
                     <div class="clear"></div>
                     <a href="#" class="button">Download Vcard</a>
                </div>
                <!-- /Resume --> 
                                        
                <!-- Portfolio -->
                <div id="portfolio">

                     <ul id="portfolio-filter">
                        <li><a href="" class="current" data-filter="*">All</a></li>
                           @foreach ($userPorfoliosCategories as $userCategories)
                             <li><a href="" data-filter=".tab{{ $userCategories->id }}">{{ $userCategories->title }}</a></li>
                           @endforeach                  
                      <!--   <li><a href="" data-filter=".photoghraphy">Photoghraphy</a></li>
                        <li><a href="" data-filter=".illustration">Illustration</a></li>
                        <li><a href="" data-filter=".print">Print</a></li>
                        <li><a href="" data-filter=".animation">Animation</a></li> -->
                    </ul>
                    <div class="extra-text">Some of the projects i'm proud with</div>
                    <ul id="portfolio-list">
                        <?php foreach ($userPorfoliosCategories as $userCategories) { ?>

                             <?php 

                                  $userId = $profiles->user_id;         
                                  $portfolioCat = DB::select('select * from portfolio where category_id = :id  and user_id = :userid', 
                                  ['id' => $userCategories->id,'userid' => $userId]);   
                                
                              ?>

                               <?php  foreach ($portfolioCat as $category) { ?>

                                <li class="tab{{ $userCategories->id }}">

                                    <?php $fileName = "upload/".$category->post_thumbnail;
                                            if(file_exists($fileName)){  ?>
                                                 <a href="../../upload/{{ $category->post_thumbnail }}" title="{{ $category->port_excerpt }}" rel="portfolio" class="folio">
                                                 <?php }else{ ?>
                                                  <a href="../../images/portfolio_images.png" title="{{ $category->port_excerpt }}" rel="portfolio" class="folio">       
                                    <?php } ?>
                                         <?php $fileName = "upload/".$category->post_thumbnail;
                                            if(file_exists($fileName)){  ?>
                                            <img src="../../upload/{{ $category->post_thumbnail }}" class="img-responsive">
                                              <?php }else{ ?>
                                            <img src="../../images/portfolio_images.png" class="img-responsive"> 

                                            <?php } ?>


                                    
                                        <h2 class="title"> <?php echo $category->port_title; ?> </h2>
                                        <span class="categorie">{{ $userCategories->title }}</span> 
                                    </a>
                                </li>

                                <?php } ?>

                        <?php } ?>
                    </ul>
                </div>
                <!-- /Portfolio -->   
                
                <!-- Contact -->
                <div id="contact">
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                    <!-- Contact Info -->
                    <div class="contact-info">
                    <h3 class="main-heading"><span>Contact info</span></h3>
                    <ul>
                        <li><?php echo $profiles->address; ?><br /><br /></li>
                        <li>Email: <?php echo $profiles->email; ?> </li>
                        <li>Phone: <?php echo $profiles->phone; ?></li>
                        <li>Biography: <?php echo $profiles->bio; ?></li>
                    </ul>
                    </div>
                    <!-- /Contact Info -->
                    
                    <!-- Contact Form -->
                    <div class="contact-form">
                        <h3 class="main-heading"><span>Let's keep in touch</span></h3>
                        <div id="contact-status"></div>
                        <form action="" id="contactform">
                            <p>
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="input" >
                            </p>
                            <p>
                                <label for="email">Your Email</label>
                                <input type="text" name="email" class="input">
                            </p>
                            <p>
                                <label for="message">Your Message</label>
                                <textarea name="message" cols="88" rows="6" class="textarea" ></textarea>
                            </p>
                            <input type="submit" name="submit" value="Send your message" class="button">
                        </form>
                    </div>
                    <!-- /Contact Form -->
                </div>
                <!-- /contact -->  

            </div>
            <!-- /Content -->
            
            <!-- Footer -->
            <div class="footer">
                <div class="copyright">© Copyright <script>document.write(new Date().getFullYear());</script> </div>
            </div>
            <!-- /Footer --> 
            
        </div>
        <!-- /Container -->

<!--END THEME 2  -->
                <script>
                    function myMap() {
                    var mapProp= {
                        center:new google.maps.LatLng(7.1911805,125.4552101),
                        zoom:15,
                    };
                    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>



</body>
</html>

<?php } elseif($theme_selection == "theme3"){ ?>


    <!DOCTYPE html>
          <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
              <title>Ressu.me | <?php echo $profiles->name; ?> </title>

              <!-- Bootstrap -->
              <link href="../../cv/theme3/assets/css/bootstrap.min.css" rel="stylesheet">
              <link href="../../cv/theme3/assets/css/style.css" rel="stylesheet">
              <link href="../../cv/theme3/assets/css/scrolling-nav.css" rel="stylesheet">
              <link href="../../cv/theme3/assets/css/hover.css" rel="stylesheet">
             
              <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
              <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
              <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->
              <style>
                body.modal-open {
                    overflow: visible;
                }
              </style>
            </head>
            <body>
            <?php 
            $cover_exists = DB::table('cover_photo')->where(['user_id' => $profiles->user_id,'status' => 'ACTIVE'])->count();
            if($cover_exists){
                $cover_photo = DB::table('cover_photo')->where(['user_id' => $profiles->user_id,'status' => 'ACTIVE'])->first();
                $cover = $cover_photo->cover_photo_name;
            }else{
                $cover = "default_cover_theme3.png";
            }
            ?>
             <section id="page-top" class="header navbar navbar navbar-static-top" style="background-image: url('../../cover_photo/default_cover_theme3.png');">
                    <div class="container">
                      <div class="navbar-header col-md-5">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                         <i class="fa fa-list"></i>
                        </button>
                        <a class="navbar-brand" href="index.html" style="">
                          <p class="user-name">JAMES SMITH</p>
                        </a>
                      </div>
                      <div class="col-md-2">&nbsp;</div>
                      <nav id="navbar" class="navbar-collapse collapse header-menu col-md-3">
                        <ul class="nav navbar-nav navbar-right">
                          <li><a class="page-scroll" href="#page-top">Home</a></li>
                          <li><a class="page-scroll" href="#resume">Resume</a></li>
                          <li><a class="page-scroll" href="#portfolio">Portfolio</a></li>
                          <li><a class="page-scroll" href="#contact">Contact</a></li>
                        </ul>
                      </nav><!--/.nav-collapse -->
                    </div>
                    <div class="row"> 
                         
                          <div class="col-md-12 banner-details">
                                <p class="introduction">Hi, I’m James Smith a Web Developer</p>
                                <p class="sub_introduction">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a href="#resume" class="btn btn-info page-scroll">GET STARTED</a>
                          </div>
                     
                    </div>



            </section>
            <section id="resume" class="row about">
                    
                  <div class="container">
                       <div class="col-md-6">
                          <p class="introduction">I'M <span class="name">James Smith</span> AND I'M A <span class="position">Web Developer</span></p>
                          <p class="bio">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.

                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an printer took a galley.</p>
                          <!--<button class="btn btn-info">LEARN MORE</button>-->
                    
                       </div> 
                       <div class="col-md-6">
                              <img class="img-responsive" src="../../profilepic/default_profilepic_theme3.png" >
                       </div>
                  </div>
            </section>
            <section class="row skills">
                  <div class="container">
                      

                       <div class="col-xs-4">
                              <p class="skills_title">PHP</p>
                              
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div>
                                </div>

                      </div> 

                      <div class="col-xs-4">
                              <p class="skills_title">HTML/CSS</p>
                              
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:50%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div>
                                </div>

                      </div> 

                      <div class="col-xs-4">
                              <p class="skills_title">LARAVEL</p>
                              
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:90%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div>
                                </div>

                      </div> 
                      
                      <div class="col-xs-4">
                              <p class="skills_title">WORDPRESS</p>
                              
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:80%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div>
                                </div>

                      </div> 
                  </div> 
            </section>

            <section class="row experience" style=""> 
                  <div class="container">
                        <p class="title">MY WORK <span class="bold">EXPERIENCE</span></p>
                  </div>
                  <div class="container">

                     

                        <div class="col-md-4">
                           <div class="experience-tabs ">
                              <p class="job_title">WEB DEVELOPMENT</p>
                              <p class="date">JANUARY 20 2016 - DECEMBER 20 2017</p>
                              <p class="company_name">Donec vel sem</p>
                              <p class="description"><i>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry</i></p>
                           </div> 
                        </div>

                        <div class="col-md-4">
                           <div class="experience-tabs ">
                              <p class="job_title">WEB DESIGN</p>
                              <p class="date">JANUARY 20 2016 - DECEMBER 20 2017</p>
                              <p class="company_name"> Aenean mauris</p>
                              <p class="description"><i>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry</i></p>
                           </div> 
                        </div>

                        <div class="col-md-4">
                           <div class="experience-tabs ">
                              <p class="job_title">INTERNET MARKETING</p>
                              <p class="date">JANUARY 20 2016 - DECEMBER 20 2017</p>
                              <p class="company_name">Pellentesque vel</p>
                              <p class="description"><i>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry</i></p>
                           </div> 
                        </div>
      
                                 
                  </div>
            </section>

            <section class="row education" style=""> 
                  <div class="container">
                        <p class="title">MY <span class="bold">EDUCATION</span></p>
                  </div>
                  <div class="container">

                       
                        <div class="col-md-4">
                           <div class="education-tabs ">
                              <p class="job_title">Donec dictum University</p>
                              <p class="date">JANUARY 20 2016 - DECEMBER 20 2017</p>
                              <p class="company_name">BS in Information Technology</p>
                              <p class="description"><i>Curabitur nec fringilla lorem, et egestas mi. Vivamus venenatis velit leo, sit amet porttitor felis sollicitudin id. Nullam dictum, massa eget rhoncus gravida</i></p>
                           </div> 
                        </div>
                       
                       <div class="col-md-4">
                           <div class="education-tabs ">
                              <p class="job_title">Donec dictum University</p>
                              <p class="date">JANUARY 20 2016 - DECEMBER 20 2017</p>
                              <p class="company_name">BS in Information Technology</p>
                              <p class="description"><i>Curabitur nec fringilla lorem, et egestas mi. Vivamus venenatis velit leo, sit amet porttitor felis sollicitudin id. Nullam dictum, massa eget rhoncus gravida</i></p>
                           </div> 
                        </div>

                        <div class="col-md-4">
                           <div class="education-tabs ">
                              <p class="job_title">Donec dictum University</p>
                              <p class="date">JANUARY 20 2016 - DECEMBER 20 2017</p>
                              <p class="company_name">BS in Information Technology</p>
                              <p class="description"><i>Curabitur nec fringilla lorem, et egestas mi. Vivamus venenatis velit leo, sit amet porttitor felis sollicitudin id. Nullam dictum, massa eget rhoncus gravida</i></p>
                           </div> 
                        </div>
                         
                  </div>
            </section>

            <section id="portfolio" class="row recent-work">
                  <div class="container">
                      <div class="col-md-12">
                           <p class="title">MY RECENT <span class="bold">WORK</span></p> 
                      </div>
                      <div class="col-md-12">
                           <ul class="list">
                             <li><a href="#all" data-toggle="tab">All</a></li>
                             @foreach ($userPorfoliosCategories as $userCategories)
                                <li><a href="#tab{{ $userCategories->id }}" data-toggle="tab">{{ $userCategories->title }}</a></li>
                            @endforeach      
                           </ul>
                      </div> 
                      <div class="row project tab-content">

                        <div id="all" class="tab-pane fade in active">

                            @foreach ($userPorfolios as $userPorfolio)

                               <?php $fileName = "upload/".$userPorfolio->post_thumbnail;
                                 if(file_exists($fileName)){  ?>
                                     <a data-toggle="modal" data-target="#portfolio{{ $userPorfolio->id }}" >
                                         <div class="col-md-4  hvr-float-shadow" style="background-image:url('../../upload/{{ $userPorfolio->post_thumbnail }}');background-size:100% 100%;">
                                            <div style="height:256px;">
                                                &nbsp;
                                            </div>
                                               
                                        </div>
                                   </a>                      
                           <?php }else{ ?>
                                         <div class="col-md-4" style="background-image:url('../../images/portfolio_images.png');background-size:100% 100%;">
                                               <div style="height:256px;">
                                               &nbsp;
                                                </div>
                                         </div>
                           <?php } ?>      
                            @endforeach    

                        </div>
                            <?php foreach ($userPorfoliosCategories as $userCategories) { ?>
                                <div id="tab{{ $userCategories->id }}" class="tab-pane fade in">

                                 <?php 

                                    $userId = $profiles->user_id;         
                                    $portfolioCat = DB::select('select * from portfolio where category_id = :id  and user_id = :userid', 
                                    ['id' => $userCategories->id,'userid' => $userId]);   
                                  
                                 ?>

                                 <?php  foreach ($portfolioCat as $category) { ?>

                                         <?php $fileName = "upload/".$category->post_thumbnail;
                                            if(file_exists($fileName)){  ?>
                                               <a data-toggle="modal" data-target="#portfolio{{ $category->id }}" >
                                                  <div class="col-md-4" style="background-image:url('../../upload/{{ $category->post_thumbnail }}');background-size:100% 100%;">
                                                      <div style="height:256px;">
                                                        &nbsp;
                                                      </div>

                                                  </div>
                                                </a>
                                          <?php }else{ ?>
                                                <div class="col-md-4" style="background-image:url('../../images/portfolio_images.png');background-size:100% 100%;">
                                                    <div style="height:256px;">
                                                      &nbsp;
                                                    </div>
                                                </div>
                                          <?php } ?>

                                <?php } ?>

                                 </div>

                              <?php } ?>

                               @foreach ($userPorfolios as $userPorfolio)

                                <!-- Modal -->
                                <div class="theme3_portfolio_modal">
                                      <div id="portfolio{{ $userPorfolio->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">{{ $userPorfolio->port_title }}</h4>
                                            </div>
                                            <div class="modal-body">

                                               <?php $fileName = "upload/".$userPorfolio->post_thumbnail;
                                                if(file_exists($fileName)){  ?>
                                                  <center>
                                                    <img class="img-responsive" src="../../upload/{{ $userPorfolio->post_thumbnail }}">
                                                  </center>
                                               <?php }else{ ?>
                                                <center>
                                                      <img class="img-responsive" src="../../images/portfolio_images.png">
                                                </center>
                                               <?php } ?>  
                                               <p class="port_excerpt"><?php echo $userPorfolio->port_excerpt; ?></p>
                                            </div>
                                          
                                          </div>

                                        </div>
                                      </div>
                                </div>      
                               <!-- Modal -->
                               
                              @endforeach   
                             
                      </div>

                  </div>
            </section>
            <section class="row quote">
                  <div class="container">
                       <div class="col-md-12">
                          <p class="introduction">Do you have any project?</span></p>
                          <p class="sub_introduction">Let's Work <span class="bold">Together</span> Indeed!</p>
                          <!--<button class="btn btn-info">LEARN MORE</button> --> 
                       </div> 
                  </div>
            </section>

            <section class="row contact">
                  <div class="container">
                       <div class="col-md-12">
                          <p class="title">GET IN <span class="bold">TOUCH</span>!</p>
                       </div>
                       <div class="col-md-12">
                          <form class="form-group">
                              <input type="hidden" name="id" class="input" value="<?php echo $profiles->user_id; ?>">
                              <div class="col-md-6">
                                  <label>Your Name</label>
                                  <input class="form-control" name="name" type="text" placeholder="Enter your name">
                              </div>
                              <div class="col-md-6">
                                  <label>Your Email Address</label>
                                  <input class="form-control" name="email" type="text" placeholder="Enter your email">
                              </div>
                              <div class="col-md-12"><br>
                               <label>Your Message</label> 
                              <textarea class="form-control" name="message"  rows="10">Enter your message</textarea>    
                              </div>
                              <div class="col-md-4 btn-wrap"><br>
                              
                                  <button type="submit" name="submit" class="btn btn-info">SEND MESSAGE</button>
                              </div>
                          </form>  

                       </div> 
                  </div>
            </section>
            <footer id="contact" class="row">
                <div class="container">
                    <div class="col-md-6">
                        <p class="copyright">Copyright © 2017 All Right Reserved. Redesigned by Durian Studio</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="footer-list">
                          <li><a href="#" target="_blank">FACEBOOK</a></li>
                          <li><a href="#" target="_blank">TWITTER</a></li>
                          <li><a href="#" target="_blank">INSTAGRAM</a></li>
                          <li><a href="#" target="_blank">WEBSITE</a></li>
                        </ul>
                    </div>
                </div>
                
            </footer>


              <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
              <!-- Include all compiled plugins (below), or include individual files as needed -->
              <script src="../../cv/theme3/assets/js/bootstrap.min.js"></script>
              <script src="../../cv/theme3/assets/js/custom.js"></script>
              <!-- Scrolling Nav JavaScript -->
              <script src="../../cv/theme3/assets/js/jquery.easing.min.js"></script>
              <script src="../../cv/theme3/assets/js/scrolling-nav.js"></script>
             <script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>

            </body>
          </html>


















<?php } ?>