<?php
    
$theme_selection = $settings->theme;
$status = $settings->status;
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


?>

<?php if($status == "private"){ ?>

<?php if(!isset($_COOKIE['tokenKey']) OR $_COOKIE['tokenKey'] == "Mis Match"  ){ ?> 

      
<html>
  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/../css/style.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/../css/adminstyle.css">
    <link rel="shortcut icon" type="image/x-icon" href="/../../images/fav icon.png"> 
    <title>Ressu.me</title> 

  </head>
  <body class="signup ressuuhome">


    <content class="row ">

    <center><a href="{{ url('/') }}"><img src="../images/logo.png" class="signuplogo" /></a></center>
    <section class="container">

        <center>
        
        <div class="clearfix"></div>
            <h4>Welcome!</h4>



            <div class="form-group">
                <input required="required" placeholder="Please Enter Token Key" id="myText" >
            </div>

            <div class="form-group">
                <button onclick="myFunction()" class="signin" >Submit</button>
            </div>

           <div class="signupfooter">
                 <p id="demo"></p>
                 <input id="tokenkey" type="hidden" value="<?php echo $settings->key;  ?>">
            <input id="link" type="hidden" value="<?php echo $actual_link;  ?>">
            </div>  
        </center>
    </section>

</content>

<script>
function myFunction() {

    var token = document.getElementById("tokenkey").value;
    var x = document.getElementById("myText").value;
    var htmlString = document.getElementById("link").value;

    if (token == x) {
       document.cookie = "tokenKey=MATCH";
       greeting = "Match";
       window.location.replace(htmlString);
     
    } else {
        greeting = "Error Token";
        //window.location.replace("http://localhost:8000/cv/orlandjaecastro.3");
    }
    document.getElementById("demo").innerHTML = greeting;


}
</script>


  </body>
<footer class="ressuufooter">
        
        <div class="container">
            <div class="col-md-6">
                <p>You can Sign In with popular Social Networks</p>
            </div>
            <div class="col-md-6 btn-group btnwrap">
                <center>
                    <a class="btn btn-success btn1"><i class="fa fa-twitter"></i>&nbsp;Sign In with Twitter</a>
                    <a href="auth/facebook" class="btn btn-success btn2"><i class="fa fa-facebook"></i>&nbsp;Sign In with Facebook</a>
                </center>
            </div>
        </div>

</footer>


</html>

<?php }else{ ?>


<script>
 //document.cookie = "tokenKey=Mis Match";
</script>

<?php if($theme_selection == "default"){ ?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
   <meta charset="utf-8">
        
   <title>Ressu.me | <?php echo $profiles->name; ?></title>
    
   <!-- Mobile viewport optimized -->
   <meta name="viewport" content="width=device-width">
    
   <!-- Style Sheets -->

   <link rel="stylesheet" href="../cv/clean_modern/style.css">
   <link rel="stylesheet" href="../cv/clean_modern/scripts/prettyPhoto/css/prettyPhoto.css">   
   <!-- Favicon -->
   <link rel="shortcut icon" type="image/x-icon" href="/../../images/fav icon.png">     
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
                <?php if(!empty($profiles->profile_picture)   AND $profiles->profile_picture != " "   ){ ?>
                        <a href="#">
                          <img class="cv_theme1_img" src="../profilepic/<?php echo $profiles->profile_picture; ?>">
                       </a>    
                    <?php  }else{ ?>
                       <a href="#">
                          <img class="cv_theme1_img" src="../profilepic/default_avatar.jpg">
                       </a>
                  <?php } ?>
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
      
      <p id="page-loader"><img src="clean_modern/images/pageload.gif" alt="Loading..." /></p>
                        
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
                                              <a class="prettyPhoto" href="../upload/{{ $category->post_thumbnail }}" title="{{ $category->port_excerpt }}">
                                                    <img src="../upload/{{ $category->post_thumbnail }}" class="work-image" style="width:100%;height:100%;"   />
                                              </a>
                                        </figure>
                                      
                                      <?php }else{ ?>
                                      <figure>
                                           <a class="prettyPhoto" href="../images/portfolio_images.png" title="<?php echo $category->port_title; ?>">
                                                <img src="../images/portfolio_images.png" class="work-image" />                                           </a>
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
          <h3 class="contact-head">Let's talk <span class="plane"><img src="clean_modern/images/plane.png" alt="" /></span></h3>
          <form action="scripts/contact.php" method="post" id="contact-form" class="clearfix">
              <div class="left">
                 <p><input type="text" name="name" id="name" class="required" value="Full Name" /></p>
                 <p><input type="text" name="email" id="email" class="required email" value="Email Address" /></p>
                 <p><input type="text" name="number" id="number" class="required" value="Phone Number" /></p>
              </div>
              <div class="right clearfix">
                 <textarea name="message" id="message" cols="30" rows="10" class="required">Message</textarea>
                 <p id="message-sent">Message sent successfully</p>
                 <p id="loading"><img src="images/loading.gif" alt="Sending..." /></p>
                 <input type="submit" id="submit" value="Submit" />
              </div>
           </form>                                        
        </section>                                
     </section>                     
    
</section>  

<!-- JS Scripts -->
<script src="../cv/clean_modern/js/jquery-1.8.2.min.js"></script>
<script src="../cv/clean_modern/js/jquery.prettyPhoto.js"></script>
<script src="../cv/clean_modern/js/jquery.selectbox-0.5.js"></script>
<script src="../cv/clean_modern/js/jquery.easing.1.3.js"></script>
<script src="../cv/clean_modern/js/jquery.form.js"></script>
<script src="../cv/clean_modern/js/jquery.validate.js"></script>
<script src="../cv/clean_modern/js/custom.js"></script>                
                    
</body>
</html>



<?php } else { ?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ressu.me | <?php echo $profiles->name; ?></title>

    <link rel="stylesheet" type="text/css" href="../cv/yellow_theme/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../cv/yellow_theme/css/fancybox.css"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic"/>
    <link rel="shortcut icon" type="image/x-icon" href="/../../images/fav icon.png"> 
    
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/respond.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.adipoli.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.isotope.min.js"></script>
    <!--<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>-->
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.gmap.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/custom.js"></script>

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

                        <div class="photo-inner"> 
                         <?php if(!empty($profiles->profile_picture)   AND $profiles->profile_picture != " "  ){ ?>
                              <img class="img-reponsive"  height="186" width="153" src="../profilepic/<?php echo $profiles->profile_picture; ?>"></a> 
                                <?php  }else{ ?>
                              <img class="img-responsive"   height="186" width="153" src="../profilepic/default_avatar.jpg" >

                          <?php } ?>
                        </div>
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
                        <li><label>Website</label><span><?php echo $profiles->url; ?></span></li>
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
                                    <h4>{{ $work->job_title }}</h4>
                                    <h4 class="timelineDate">{{ $work->start_date }} - {{ $work->end_date }}</h4>
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
                                    <h4>{{ $edu->school }}</h4>
                                    <h4 class="timelineDate">{{ $edu->date_start }} - {{ $edu->date_end }}</h4>
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
                                                 <a href="../upload/{{ $category->post_thumbnail }}" title="{{ $category->port_excerpt }}" rel="portfolio" class="folio">
                                                 <?php }else{ ?>
                                                  <a href="../images/portfolio_images.png" title="{{ $category->port_excerpt }}" rel="portfolio" class="folio">       
                                    <?php } ?>
                                         <?php $fileName = "upload/".$category->post_thumbnail;
                                            if(file_exists($fileName)){  ?>
                                            <img src="../upload/{{ $category->post_thumbnail }}" class="img-responsive">
                                              <?php }else{ ?>
                                            <img src="../images/portfolio_images.png" class="img-responsive"> 

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
                    <div id="mapouter">
                          <div id="gmap_canvas">
                        <?php $location = "https://maps.google.com/maps?q=".$profiles->address." , &t=&z=14&ie=UTF8&iwloc=&output=embed"; ?>
                            <iframe width="860" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $location; ?>" >
                           </iframe>
                         </div>
                         <style>#gmap_canvas{height:400px;width:860px;}#mapouter{overflow:hidden;height:400px;width:860px;}</style>
                      </div>
                      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj_FG4Hogq9S4wXhl2onS5vPpTQHJKO6g&callback=initMap"></script>   
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
                



</body>
</html>
<?php } ?>









<?php } ?>















<?php  }if( $status == "public"){ ?>
<script>
 //document.cookie = "tokenKey=Mis Match";
</script>

<?php if($theme_selection == "default"){ ?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
   <meta charset="utf-8">
        
   <title>Ressu.me | <?php echo $profiles->name; ?></title>
    
   <!-- Mobile viewport optimized -->
   <meta name="viewport" content="width=device-width">
    
   <!-- Style Sheets -->

   <link rel="stylesheet" href="../cv/clean_modern/style.css">
   <link rel="stylesheet" href="../cv/clean_modern/scripts/prettyPhoto/css/prettyPhoto.css">
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
                   <?php if(!empty($profiles->profile_picture)   AND $profiles->profile_picture != " "  ){ ?>

                        <a href="#">
                          <img class="cv_theme1_img" src="../profilepic/<?php echo $profiles->profile_picture; ?>">
                       </a>

                    <?php  }else{ ?>

                       <a href="#">
                          <img class="cv_theme1_img" src="../profilepic/default_avatar.jpg">
                       </a>

                  <?php } ?>
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
      
      <p id="page-loader"><img src="clean_modern/images/pageload.gif" alt="Loading..." /></p>
                        
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
                                              <a class="prettyPhoto" href="../upload/{{ $category->post_thumbnail }}" title="{{ $category->port_excerpt }}">
                                                    <img src="../upload/{{ $category->post_thumbnail }}" class="work-image" style="width:100%;height:100%;"   />
                                              </a>
                                        </figure>
                                      
                                      <?php }else{ ?>
                                      <figure>
                                           <a class="prettyPhoto" href="../images/portfolio_images.png" title="<?php echo $category->port_title; ?>">
                                                <img src="../images/portfolio_images.png" class="work-image" />                                           </a>
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
          <h3 class="contact-head">Let's talk <span class="plane"><img src="clean_modern/images/plane.png" alt="" /></span></h3>
          <form action="scripts/contact.php" method="post" id="contact-form" class="clearfix">
              <div class="left">
                 <p><input type="text" name="name" id="name" class="required" value="Full Name" /></p>
                 <p><input type="text" name="email" id="email" class="required email" value="Email Address" /></p>
                 <p><input type="text" name="number" id="number" class="required" value="Phone Number" /></p>
              </div>
              <div class="right clearfix">
                 <textarea name="message" id="message" cols="30" rows="10" class="required">Message</textarea>
                 <p id="message-sent">Message sent successfully</p>
                 <p id="loading"><img src="images/loading.gif" alt="Sending..." /></p>
                 <input type="submit" id="submit" value="Submit" />
              </div>
           </form>                                        
        </section>                                
     </section>                     
    
</section>  

<!-- JS Scripts -->
<script src="../cv/clean_modern/js/jquery-1.8.2.min.js"></script>
<script src="../cv/clean_modern/js/jquery.prettyPhoto.js"></script>
<script src="../cv/clean_modern/js/jquery.selectbox-0.5.js"></script>
<script src="../cv/clean_modern/js/jquery.easing.1.3.js"></script>
<script src="../cv/clean_modern/js/jquery.form.js"></script>
<script src="../cv/clean_modern/js/jquery.validate.js"></script>
<script src="../cv/clean_modern/js/custom.js"></script>                
                    
</body>
</html>



<?php } else { ?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ressu.me | <?php echo $profiles->name; ?></title>

     <link rel="stylesheet" type="text/css" href="../cv/yellow_theme/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../cv/yellow_theme/css/fancybox.css"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic"/>
    <link rel="shortcut icon" type="image/x-icon" href="/../../images/fav icon.png"> 
    
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/respond.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.adipoli.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.isotope.min.js"></script>
    <!--<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>-->
    <script type="text/javascript" src="../cv/yellow_theme/js/jquery.gmap.min.js"></script>
    <script type="text/javascript" src="../cv/yellow_theme/js/custom.js"></script>

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
                        <div class="photo-inner">
                          <?php if(!empty($profiles->profile_picture)  AND $profiles->profile_picture != " "  ){ ?>
                              <img class="img-reponsive"  height="186" width="153" src="../profilepic/<?php echo $profiles->profile_picture; ?>"></a> 
                                <?php  }else{ ?>
                              <img class="img-responsive"   height="186" width="153" src="../profilepic/default_avatar.jpg" >

                          <?php } ?>

                        </div>
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
                        <li><label>Website</label><span><?php echo $profiles->url; ?></span></li>
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
                                    <h4>{{ $work->job_title }}</h4>
                                    <h4 class="timelineDate">{{ $work->start_date }} - {{ $work->end_date }}</h4>
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
                                    <h4>{{ $edu->school }}</h4>
                                    <h4 class="timelineDate">{{ $edu->date_start }} - {{ $edu->date_end }}</h4>
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
                                                 <a href="../upload/{{ $category->post_thumbnail }}" title="{{ $category->port_excerpt }}" rel="portfolio" class="folio">
                                                 <?php }else{ ?>
                                                  <a href="../images/portfolio_images.png" title="{{ $category->port_excerpt }}" rel="portfolio" class="folio">       
                                    <?php } ?>
                                         <?php $fileName = "upload/".$category->post_thumbnail;
                                            if(file_exists($fileName)){  ?>
                                            <img src="../upload/{{ $category->post_thumbnail }}" class="img-responsive">
                                              <?php }else{ ?>
                                            <img src="../images/portfolio_images.png" class="img-responsive"> 

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
                    <div id="mapouter">
                          <div id="gmap_canvas">
                        <?php $location = "https://maps.google.com/maps?q=".$profiles->address." , &t=&z=14&ie=UTF8&iwloc=&output=embed"; ?>
                            <iframe width="860" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $location; ?>" >
                           </iframe>
                         </div>
                         <style>#gmap_canvas{height:400px;width:860px;}#mapouter{overflow:hidden;height:400px;width:860px;}</style>
                      </div>
                      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj_FG4Hogq9S4wXhl2onS5vPpTQHJKO6g&callback=initMap"></script>   
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
               





</body>
</html>
<?php } ?>






<?php } ?>  