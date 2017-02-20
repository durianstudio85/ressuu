<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Redirect;
use Session;
use Hybrid_Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $userId = Auth::id();
    $name = Auth::user()->name;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();
    $userFeeds = DB::table('news_feeds')
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();
    //$userFeeds = DB::select('select * from news_feeds where user_id = :id', ['id' => $userId]);   
    $usersFile = DB::table('users')
                ->where('id', $userId)
                ->get();
    $FollowedUsers = DB::table('users_follow')->where('user_id',$userId)->count();            
    $userFollow = DB::table('profiles')->orderByRaw("RAND()")->take(3)->get();
    $userFollow2 = DB::table('profiles')->orderByRaw("RAND()")->take(2)->get();        
    $userSettings = DB::table('settings')->where('user_id',$userId)->first(); 
    
    
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();            
        return view('home')
                ->with("userProfile",$userProfile)
                ->with("userFeeds",$userFeeds)
                ->with("usersFile",$usersFile)
                ->with("name",$name)
                ->with("if_exist",$if_exist)
                ->with("if_exist_settings",$if_exist_settings)
                ->with("userSettings",$userSettings)
                ->with("userFollow",$userFollow)
                ->with("userFollow2",$userFollow2)
                ->with("FollowedUsers",$FollowedUsers)
       ;
    
      /* return view('home')
                ->with("name",$name)
                ->with("if_exist",$if_exist)
       ;
    */


    }
    public function profile()
    {

    $userId = Auth::id();
    $name = Auth::user()->name;
    $email = Auth::user()->email;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();
     $userSettings = DB::table('settings')->where('user_id',$userId)->first(); 
          return view('profile')
                     ->with("userProfile",$userProfile)
                     ->with("name",$name)
                     ->with("email",$email)
                     ->with("if_exist",$if_exist)
                     ->with("if_exist_settings",$if_exist_settings)
                     ->with("userSettings",$userSettings)
          ;
                


    }

    public function resume()
    {
    $userId = Auth::id();
    $name = Auth::user()->name;
    $email = Auth::user()->email;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();  

    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();
    $userResume_Experience = DB::table('work_experience')
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();

    $userResume_Education = DB::table('education')
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();  

    $userResume_Skills = DB::table('skills')
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();   
    $userResume_Certification = DB::table('certification')
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get(); 
                                     
    $userSettings = DB::table('settings')->where('user_id',$userId)->first();            

        return view('resume')
                    ->with("userProfile",$userProfile)
                    ->with("userResume_Experience",$userResume_Experience)
                    ->with("userResume_Education",$userResume_Education)
                    ->with("userResume_Skills",$userResume_Skills)
                     ->with("userResume_Certification",$userResume_Certification)
                    ->with("name",$name)
                     ->with("email",$email)
                     ->with("if_exist",$if_exist)
                      ->with("if_exist_settings",$if_exist_settings)
                      ->with("userSettings",$userSettings)
        ;




    }

    public function portfolio()
    {

    $userId = Auth::id();
    $name = Auth::user()->name;
    $email = Auth::user()->email;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    
    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();
    $userPorfolios = DB::table('portfolio')
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();

    $userPorfoliosCategories = DB::table('portfolio_cat')
                ->get();
    $if_have_portfolio =  DB::table('portfolio')->where('user_id',$userId)->count(); 
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();
    $userSettings = DB::table('settings')->where('user_id',$userId)->first();            
        return view('portfolio')
                 ->with("userProfile",$userProfile)
                 ->with("userPorfolios",$userPorfolios)
                 ->with("userPorfoliosCategories",$userPorfoliosCategories)
                 ->with("if_have_portfolio",$if_have_portfolio)
                 ->with("name",$name)
                 ->with("email",$email)
                 ->with("if_exist",$if_exist)
                  ->with("if_exist_settings",$if_exist_settings)
                   ->with("userSettings",$userSettings)

        ;


    }

    public function jobs()
    {
        $userId = Auth::id();
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
        $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();  
        $userSettings = DB::table('settings')->where('user_id',$userId)->first(); 
        $userJobs = DB::table('job')->get();   
        $userProfile = DB::table('profiles')->where('user_id',$userId)->first();
        return view('jobs')
                ->with("userProfile",$userProfile)
                 ->with("name",$name)
                 ->with("email",$email)
                 ->with("if_exist",$if_exist)
                 ->with("userJobs",$userJobs)
                  ->with("if_exist_settings",$if_exist_settings)
                  ->with("userSettings",$userSettings)
        ;
    }

    public function setting()
    {

        function random_string($length) {
            $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));

            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }

            return $key;
        }



        $userId = Auth::id();
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $if_exist = DB::table('profiles')->where('user_id',$userId)->count();

        $userProfile = DB::table('profiles')->where('user_id',$userId)->first();

        $userSettings = DB::table('settings')->where('user_id',$userId)->first();          
        $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();        

        $cvlink = strtolower(str_replace (" ", "", $name)).".".$userId;
        // $create_cvlink = "http://localhost:8000/cv/".($cvlink);
         $create_cvlink = "https://ressuu.me/cv/".($cvlink);
         $token = random_string(40);

        return view('setting')
                ->with("userProfile",$userProfile)
                ->with("name",$name)
                 ->with("email",$email)
                 ->with("if_exist",$if_exist)
                 ->with("userSettings",$userSettings)
                  ->with("if_exist_settings",$if_exist_settings)
                  ->with("create_cvlink",$create_cvlink)
                  ->with("cvlink",$cvlink)
                  ->with("token",$token)
        ;




    }

    public function edit(){

        $userId = Auth::id();
        $inputName =        Input::get('name');
        $inputJobtitle =    Input::get('jobtitle');
        $inputBday =        Input::get('bday');
        $inputAddress =     Input::get('address');
        $inputEmail =       Input::get('email');
        $inputPhone =       Input::get('phone');
        $inputBio =         Input::get('bio');
        $inputUrl =         Input::get('url');
        $inputFacebook =    Input::get('facebook');
        $inputLinked =      Input::get('linkedin');
        $inputTwitter =     Input::get('twitter');
        $inputGoogle =      Input::get('google');
        $inputDate = date('Y-m-d');
       
         DB::table('profiles')
            ->where('user_id', $userId)
            ->update(array(
                'email' => $inputEmail,
                'name' => $inputName,
                'position' => $inputJobtitle,
                'bday' => $inputBday,
                'address' => $inputAddress,
                'phone' => $inputPhone,
                'url' => $inputUrl,
                'bio' => $inputBio, 
                'facebook' => $inputFacebook,
                'linkedin' => $inputLinked,
                'twitter' => $inputTwitter,
                'google' => $inputGoogle
                ));
            
        DB::table('news_feeds')->insert([
                'user_id' => $userId,
                 'activity' => "Update Profile",
                 'date'=> $inputDate
          ]);



        return back();

    }

    public function insertProfile(){
    
         $userId = Auth::id();
        $inputName =        Input::get('name');
        $inputJobtitle =    Input::get('jobtitle');
        $inputBday =        Input::get('bday');
        $inputAddress =     Input::get('address');
        $inputEmail =       Input::get('email');
        $inputPhone =       Input::get('phone');
        $inputBio =         Input::get('bio');
        $inputUrl =         Input::get('url');
        $inputFacebook =    Input::get('facebook');
        $inputLinked =      Input::get('linkedin');
        $inputTwitter =     Input::get('twitter');
        $inputGoogle =      Input::get('google');

        DB::table('profiles')->insert([
                'user_id'=> $userId,
                'email' => $inputEmail,
                'name' => $inputName,
                'position' => $inputJobtitle,
                'bday' => $inputBday,
                'address' => $inputAddress,
                'phone' => $inputPhone,
                'url' => $inputUrl,
                'bio' => $inputBio,
                'profile_picture' => " ",
                'facebook' => $inputFacebook,
                'linkedin' => $inputLinked,
                'twitter' => $inputTwitter,
                'google' => $inputGoogle,
                'is_logged_in' => 0
          ]);




        return back();

    }


    public function addExperience(){
    
         $userId = Auth::id();
         $inputJobtitle = Input::get('job_title');
         $inputCompanyname = Input::get('company');
         $inputStartdate = Input::get('start_date');
         $inputEnddate = Input::get('end_date');
         $inputDescription = Input::get('description');
         $inputDate = date('Y-m-d');

          DB::table('work_experience')->insert([
                 'user_id' => $userId,
                 'company_name' => $inputCompanyname,
                 'job_title'=> $inputJobtitle,
                 'start_date' => $inputStartdate,
                 'end_date'=>$inputEnddate,
                 'description' => $inputDescription
          ]);

           DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Add New Experience as ".$inputJobtitle. " in ".$inputCompanyname,
                 'date'=> $inputDate
          ]);

           return back();

    }

    public function addEducation(){
    
         $userId = Auth::id();
         $inputCourse = Input::get('course');
         $inputSchool = Input::get('school');
         $inputStartdate = Input::get('start_date');
         $inputEnddate = Input::get('end_date');
         $inputAward = Input::get('award');
          $inputDate = date('Y-m-d');

          DB::table('education')->insert([
                 'user_id' => $userId,
                 'school' => $inputSchool,
                 'course'=> $inputCourse,
                 'date_start' => $inputStartdate,
                 'date_end'=>$inputEnddate,
                 'awards_rec' => $inputAward
          ]);

          DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Add New Educational Background as ".$inputCourse. " in ".$inputSchool,
                  'date'=> $inputDate
          ]);

           return back();

    }

     public function addSkill(){
    
         $userId = Auth::id();
         $inputSkills = Input::get('skills');
         $inputRate = Input::get('rate');
         $inputDescription = Input::get('description');
         $inputDate = date('Y-m-d');
       
          DB::table('skills')->insert([
                 'skill_cat_id' => 0,
                 'user_id' => $userId,
                 'skillname'=> $inputSkills,
                 'rate' => $inputRate,
                 'description'=>$inputDescription
                
          ]);

          DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Add New Skills about ". $inputSkills,
                 'date'=> $inputDate
          ]);

           return back();

    }

     public function addCertification(){
    
         $userId = Auth::id();
         $inputTitle = Input::get('title');
         $inputCompany = Input::get('company');
         $inputReceive = Input::get('receive');
         $inputDate = date('Y-m-d');
       
          DB::table('certification')->insert([
                 'user_id' => $userId,
                 'certificate_title' => $inputTitle,
                 'certificate_company'=> $inputCompany,
                 'certificate_receive' => $inputReceive
                 
                
          ]);

          DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Add Certification about ". $inputTitle,
                 'date'=> $inputDate
          ]);
            
           return back();

    }

     public function addPortfolio(){
        
          // getting all of the post data
          $file = array('image' => Input::file('image'));
          // setting up rules
          $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
          // doing the validation, passing post data, rules and the messages
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('upload')->withInput()->withErrors($validator);
          }
          else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
              $destinationPath = 'upload'; // upload path
              $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
              $fileName = rand(11111,99999).'.'.$extension; // renameing image
              Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
              // sending back with message

                 $userId = Auth::id();
                 $inputPortTitle = Input::get('port_title');
                 $inputCategoryId = Input::get('category_id');
                 $inputDescription = Input::get('description');
                 $inputThumbnail = $fileName;
                 $portfolio_Category = DB::table('portfolio_cat')->where('id',$inputCategoryId)->first();
                 $inputDate = date('Y-m-d');

                  DB::table('portfolio')->insert([
                         'user_id' => $userId,
                         'port_title'=> $inputPortTitle,
                         'port_excerpt' => $inputDescription,
                         'post_thumbnail'=>$inputThumbnail,
                         'category_id'=>$inputCategoryId
                        
                  ]);

                   DB::table('news_feeds')->insert([
                         'user_id' => $userId,
                         'activity' => "Add New Portfolio in ". $portfolio_Category->title,
                         'date'=> $inputDate
                  ]);

              Session::flash('success', 'Upload successfully'); 
              return back();    
            }
            else {
              // sending back with error message.
              Session::flash('error', 'uploaded file is not valid');
             return back();
            }
          }

    }

    public function follow(){
    
         $userId = Auth::id();
         $inputFollowedId = Input::get('id');
         $FollowedStatus = "Followed";   
       
          DB::table('users_follow')->insert([
                 'user_id' => $userId,
                 'following_id' => $inputFollowedId,
                 'follow_status'=> $FollowedStatus           
          ]);

           return back();
       
    }

     public function uploadPicture(){
        
              // getting all of the post data
              $file = array('image' => Input::file('image'));
              // setting up rules
              $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
              // doing the validation, passing post data, rules and the messages
              $validator = Validator::make($file, $rules);
              if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('upload')->withInput()->withErrors($validator);
              }
              else {
                // checking file is valid.
                if (Input::file('image')->isValid()) {
                  $destinationPath = 'profilepic'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                  // sending back with message

                     $userId = Auth::id();
                     $inputDate = date('Y-m-d');
                     $inputThumbnail = $fileName;


                       DB::table('profiles')
                        ->where('user_id', $userId)
                        ->update(array(
                             'profile_picture' => $inputThumbnail 
                            ));    

                       DB::table('news_feeds')->insert([
                             'user_id' => $userId,
                             'activity' => "Update Profile Picture ",
                             'date'=> $inputDate
                      ]);



                  Session::flash('success', 'Upload successfully'); 
                  return back();
                }
                else {
                  // sending back with error message.
                  Session::flash('error', 'uploaded file is not valid');
                 return back();
                }
              }

    }











     public function updateExperience($id){
    
        $userId = Auth::id();
        $expId = $id;
        $inputJobtitle = Input::get('update_job_title');
        $inputCompanyname = Input::get('update_company');
        $inputStartdate = Input::get('update_start_date');
        $inputEnddate = Input::get('update_end_date');
        $inputDescription = Input::get('update_description');
        $inputDate = date('Y-m-d');


         DB::table('work_experience')
            ->where('id', $expId)
            ->update(array(
                 'user_id' => $userId,
                 'company_name' => $inputCompanyname,
                 'job_title'=> $inputJobtitle,
                 'start_date' => $inputStartdate,
                 'end_date'=>$inputEnddate,
                 'description' => $inputDescription
                ));  

          DB::table('news_feeds')->insert([
                             'user_id' => $userId,
                             'activity' => "Updating Experience in ". $inputCompanyname,
                             'date'=> $inputDate
         ]);          

        return back();

    }


     public function updateEducation($id){

        $userId = Auth::id();
        $expId = $id;
        $inputCourse = Input::get('update_course');
        $inputSchool = Input::get('update_school');
        $inputStartdate = Input::get('update_start_date');
        $inputEnddate = Input::get('update_end_date');
        $inputAward = Input::get('update_award');
         $inputDate = date('Y-m-d');


         DB::table('education')
            ->where('id', $expId)
            ->update(array(
                 'user_id' => $userId,
                 'school' => $inputSchool,
                 'course'=> $inputCourse,
                 'date_start' => $inputStartdate,
                 'date_end'=>$inputEnddate,
                 'awards_rec' => $inputAward
                ));    

         DB::table('news_feeds')->insert([
                             'user_id' => $userId,
                             'activity' => "Updating Education in ". $inputSchool,
                             'date'=> $inputDate
         ]);   


        return back();

    }

    public function updateSkill($id){
    
         $userId = Auth::id();
         $skiId = $id;
         $inputSkills = Input::get('skills');
         $inputRate = Input::get('rate');
         $inputDescription = Input::get('description');
          $inputDate = date('Y-m-d');

           DB::table('skills')
            ->where('id', $skiId)
            ->update(array(
                 'skill_cat_id' => 0,
                 'user_id' => $userId,
                 'skillname'=> $inputSkills,
                 'rate' => $inputRate,
                 'description'=>$inputDescription
                ));  

          DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Update Skills in ". $inputSkills,
                 'date'=> $inputDate
          ]);


           return back();



    }

    public function updateSettings(){
    
         $userId = Auth::id();
         $inputTheme = Input::get('themes');
         $inputStatus = Input::get('cv_status');
         $inputPermalink = Input::get('cv_link');
         $inputKey = Input::get('token_key');
         $inputUsername = Input::get('username');
         $inputPreview = Input::get('embeded_code');
           $inputDate = date('Y-m-d');
        

         $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count(); 


         if($if_exist_settings == 0){

          DB::table('settings')->insert([
                 'user_id' => $userId,
                 'theme'=> $inputTheme,
                 'status' => $inputStatus,
                 'permalink'=>$inputPermalink,
                 'key'=>$inputKey,
                 'username'=>$inputUsername,
                 'preview'=>$inputPreview
                
          ]);

          DB::table('news_feeds')->insert([
                'user_id' => $userId,
                'activity' => "Update Settings ",
                 'date'=> $inputDate
          ]);

         }else{

        DB::table('settings')
                ->where('user_id', $userId)
                ->update([
                 'theme'=> $inputTheme,
                 'status' => $inputStatus,
                 'permalink'=>$inputPermalink,
                 'key'=>$inputKey,
                 'username'=>$inputUsername,
                 'preview'=>$inputPreview 
                 ]);     
         }       

            DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Update Settings ",
                 'date'=> $inputDate
         ]);

           return back();

    }










    public function deleteExperience($id){


        $userId = Auth::id();
        $expId = $id;
        $inputDate = date('Y-m-d');
        
        $experience = DB::table('work_experience')->where('id',$expId)->first(); 

        DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Delete Experience in ".$experience->company_name,
                 'date'=> $inputDate
       ]);        


        DB::table('work_experience')
                ->where('id',$expId)->delete();

        

        return back();

    }

    public function deleteEducation($id){


        $userId = Auth::id();
        $eduId = $id;
        $inputDate = date('Y-m-d');

        $education = DB::table('education')->where('id',$eduId)->first(); 
        
        DB::table('education')
                ->where('id',$eduId)->delete();



         DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Delete Education in ".$education->school,
                'date'=> $inputDate
         ]);          
        

        return back();



    }

     public function deleteSkill($id){

        $userId = Auth::id();
        $skiId = $id;
        $inputDate = date('Y-m-d');

        $skills = DB::table('skills')->where('id',$skiId)->first(); 


        DB::table('skills')
                ->where('id',$skiId)->delete();


        DB::table('news_feeds')->insert([
                 'user_id' => $userId,
                 'activity' => "Delete Skills ".$skills->skillname,
                'date'=> $inputDate
         ]);                 


        return back();

    }

    




    public function getFacebooklogin($auth = NULL){

            if($auth == 'auth')
            {

                 try{
                    Hybrid_Endpoint::process();
                 }
                 catch(Exception $e)
                 {
                    return Redirect::to('fbauth');
                 }
                 return;
            }

            $oauth = new Hybrid_Auth(app_path(). '/config/fb_auth.php');
            $provider = $oauth->authenticate('Facebook');
            $profile = $provider->getUserProfile();
            return var_dump($profile). '<a href="logout">Log Out</a>';


    }












}
