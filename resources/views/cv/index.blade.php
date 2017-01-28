<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Personal vCard Template</title>

    <link rel="stylesheet" type="text/css" href="../cv/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../cv/css/fancybox.css"/>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic"/>
    
    <script type="text/javascript" src="../cv/js/jquery.min.js"></script>
    <script type="text/javascript" src="../cv/js/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="../cv/js/respond.min.js"></script>
    <script type="text/javascript" src="../cv/js/jquery.adipoli.min.js"></script>
    <script type="text/javascript" src="../cv/js/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="../cv/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="../cv/js/jquery.gmap.min.js"></script>
    <script type="text/javascript" src="../cv/js/custom.js"></script>
    
</head>
    <body>

<?php
    
$theme_selection = $settings->theme;

if($theme_selection == "default"){ ?>
    <center>
    <h1>Theme 2 is Not Available Yet</h1>
    </center>

<?php } else { ?>
        
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
                        <div class="photo-inner"><img src="../profilepic/eduardo.jpg" height="186" width="153" /></div>
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
                    <div id="map">
                        
                    </div>
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

<?php } ?>


</body>
</html>