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
                ->orderBy('date', 'desc')
                ->get();            

    //$userFeeds = DB::select('select * from news_feeds where user_id = :id', ['id' => $userId]);   
    $usersFile = DB::table('users')
                ->where('id', $userId)
                ->get();
    $FollowedUsers = DB::table('users_follow')->where('user_id',$userId)->count();            
    $userFollow = DB::table('profiles')->orderByRaw("RAND()")->take(3)->get();
    $userFollow2 = DB::table('profiles')->orderByRaw("RAND()")->take(2)->get();        
    $userSettings = DB::table('settings')->where('user_id',$userId)->first(); 
    $userAds = DB::table('ads')->where([
                     'area' => 'USERDASHBOARD',
                     'status' => 'ACTIVE'
                  ])->first();   
    
    $timeline = DB::table('dashboard_timeline')->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();
   
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();  

    $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 

    $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get(); 

    $count_job = DB::table('job')->count();          

    $list_job = DB::table('job')->get();

    $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

    $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->get();

    $user_list =  DB::table('users')->get();
      
    $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

    $count_like = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'LIKE'
                  ])->count();

    $count_view = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'VIEW'
                  ])->count();


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
                ->with("userAds",$userAds)
                ->with("timeline",$timeline)
                ->with("count_job",$count_job)
                ->with("no_message",$no_message)
                ->with("list_message",$list_message)
                ->with("list_job",$list_job)
                ->with("job_notification",$job_notification)
                ->with("job_list_notification",$job_list_notification)
                ->with("user_list",$user_list)
                ->with("user_notification",$user_notification)
                ->with("user_list_notification",$user_list_notification)
                ->with("count_connection",$count_connection)
                ->with("count_like",$count_like)
                ->with("count_view",$count_view)


       ;
   

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
    $count_job = DB::table('job')->count();   

    $userAds = DB::table('ads')->where([
                     'area' => 'USERPROFILE',
                     'status' => 'ACTIVE'
                  ])->first(); 

    $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 

    $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get();
    
    $list_job = DB::table('job')->get();

    $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

    $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();  

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->get();

    $user_list =  DB::table('users')->get(); 

    $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

    $count_like = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'LIKE'
                  ])->count();

    $count_view = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'VIEW'
                  ])->count();



          return view('profile')
                     ->with("userProfile",$userProfile)
                     ->with("name",$name)
                     ->with("email",$email)
                     ->with("if_exist",$if_exist)
                     ->with("if_exist_settings",$if_exist_settings)
                     ->with("userSettings",$userSettings)
                     ->with("userAds",$userAds)
                     ->with("count_job",$count_job)
                     ->with("no_message",$no_message)
                     ->with("list_message",$list_message)
                     ->with("list_job",$list_job)
                     ->with("job_notification",$job_notification)
                     ->with("job_list_notification",$job_list_notification)
                     ->with("user_list",$user_list)
                     ->with("user_notification",$user_notification)
                     ->with("user_list_notification",$user_list_notification)
                     ->with("count_connection",$count_connection)
                     ->with("count_like",$count_like)
                     ->with("count_view",$count_view)
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
    
    $count_job = DB::table('job')->count(); 

    $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 
    $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get();

    $list_job = DB::table('job')->get();


    $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

    $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();  

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->get();

    $user_list =  DB::table('users')->get();

    $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

    $count_like = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'LIKE'
                  ])->count();

    $count_view = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'VIEW'
                  ])->count();


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
                    ->with("count_job",$count_job)
                    ->with("no_message",$no_message)
                    ->with("list_message",$list_message)
                    ->with("list_job",$list_job)
                    ->with("job_notification",$job_notification)
                    ->with("job_list_notification",$job_list_notification)
                    ->with("user_list",$user_list)
                    ->with("user_notification",$user_notification)
                    ->with("user_list_notification",$user_list_notification)
                    ->with("count_connection",$count_connection)
                    ->with("count_like",$count_like)
                    ->with("count_view",$count_view)
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
    $count_job = DB::table('job')->count();  

    $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 
    $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get(); 
    $list_job = DB::table('job')->get();

    $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

    $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->get();

    $user_list =  DB::table('users')->get();

    $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

    $count_like = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'LIKE'
                  ])->count();

    $count_view = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'VIEW'
                  ])->count();

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
                 ->with("count_job",$count_job)
                 ->with("no_message",$no_message)
                 ->with("list_message",$list_message)
                 ->with("list_job",$list_job)
                 ->with("job_notification",$job_notification)
                ->with("job_list_notification",$job_list_notification)
                ->with("user_list",$user_list)
                ->with("user_notification",$user_notification)
                ->with("user_list_notification",$user_list_notification)
                ->with("count_connection",$count_connection)
                ->with("count_like",$count_like)
                ->with("count_view",$count_view)

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
        $userJobs = DB::table('job')->orderBy('id', 'desc')->get();   
        $userProfile = DB::table('profiles')->where('user_id',$userId)->first();

        $count_job = DB::table('job')->count();

        $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 

        $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get(); 

        $list_job = DB::table('job')->get();

        $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

        $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();

         $job_application = DB::table('applicant')->where('user_id',$userId)->get(); 

        $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

        $user_list_notification = DB::table('user_notification')->where([
                         'category_id' => $userId,
                         'category' => 'Followed',
                         'status' => 'PENDING'
                      ])->get();

        $user_list =  DB::table('users')->get();

        $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

        $count_like = DB::table('like_view')->where([
                         'to_user_id' => $userId,
                         'status' => 'LIKE'
                      ])->count();

        $count_view = DB::table('like_view')->where([
                         'to_user_id' => $userId,
                         'status' => 'VIEW'
                      ])->count();

        return view('jobs')
                ->with("userProfile",$userProfile)
                ->with("name",$name)
                ->with("email",$email)
                ->with("if_exist",$if_exist)
                ->with("userJobs",$userJobs)
                ->with("if_exist_settings",$if_exist_settings)
                ->with("userSettings",$userSettings)
                ->with("count_job",$count_job)
                ->with("no_message",$no_message)
                ->with("list_message",$list_message)
                ->with("list_job",$list_job)
                ->with("job_notification",$job_notification)
                ->with("job_list_notification",$job_list_notification)
                ->with("job_application",$job_application)
                ->with("user_list",$user_list)
                ->with("user_notification",$user_notification)
                ->with("user_list_notification",$user_list_notification)
                ->with("count_connection",$count_connection)
                ->with("count_like",$count_like)
                ->with("count_view",$count_view)
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
           $userAds = DB::table('ads')->where([
                     'area' => 'USERSETTINGS',
                     'status' => 'ACTIVE'
                  ])->first(); 
        $count_job = DB::table('job')->count();
        
        $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 
        $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get(); 
        
        $list_job = DB::table('job')->get();

        $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

        $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();

        $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

        $user_list_notification = DB::table('user_notification')->where([
                         'category_id' => $userId,
                         'category' => 'Followed',
                         'status' => 'PENDING'
                      ])->get();

        $user_list =  DB::table('users')->get();

        $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

        $count_like = DB::table('like_view')->where([
                         'to_user_id' => $userId,
                         'status' => 'LIKE'
                      ])->count();

        $count_view = DB::table('like_view')->where([
                         'to_user_id' => $userId,
                         'status' => 'VIEW'
                      ])->count();

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
                  ->with("userAds",$userAds)
                  ->with("count_job",$count_job)
                  ->with("no_message",$no_message)
                  ->with("list_message",$list_message)
                  ->with("list_job",$list_job)
                  ->with("job_notification",$job_notification)
                  ->with("job_list_notification",$job_list_notification)
                  ->with("user_list",$user_list)
                ->with("user_notification",$user_notification)
                ->with("user_list_notification",$user_list_notification)
                ->with("count_connection",$count_connection)
                ->with("count_like",$count_like)
                ->with("count_view",$count_view)
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
            
        // DB::table('news_feeds')->insert([
        //         'user_id' => $userId,
        //          'activity' => "Update Profile",
        //          'date'=> $inputDate
        //   ]);

        DB::table('dashboard_timeline')->insert([
                   'user_id' => $userId,
                   'category' => "Profile",
                   'category_id' =>$userId,
                   'activity' => "Update Profile ",
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
                'is_logged_in' => ' '
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

         $getLastID = DB::table('work_experience')->insertGetId([
                 'user_id' => $userId,
                 'company_name' => $inputCompanyname,
                 'job_title'=> $inputJobtitle,
                 'start_date' => $inputStartdate,
                 'end_date'=>$inputEnddate,
                 'description' => $inputDescription
          ]);

   

            DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Experience",
                       'category_id' =>$getLastID,
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

         $getLastID = DB::table('education')->insertGetId([
                 'user_id' => $userId,
                 'school' => $inputSchool,
                 'course'=> $inputCourse,
                 'date_start' => $inputStartdate,
                 'date_end'=>$inputEnddate,
                 'awards_rec' => $inputAward
          ]);


           DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Education",
                       'category_id' =>$getLastID,
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
       
        $getLastID = DB::table('skills')->insertGetId([
                 'skill_cat_id' => 0,
                 'user_id' => $userId,
                 'skillname'=> $inputSkills,
                 'rate' => $inputRate,
                 'description'=>$inputDescription
                
          ]);


           DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Skills",
                       'category_id' =>$getLastID,
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
       
         $getLastID = DB::table('certification')->insertGetId([
                 'user_id' => $userId,
                 'certificate_title' => $inputTitle,
                 'certificate_company'=> $inputCompany,
                 'certificate_receive' => $inputReceive
                 
                
          ]);

   
            
            DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Certification",
                       'category_id' => $getLastID,
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

                 $getLastID = DB::table('portfolio')->insertGetId([
                         'user_id' => $userId,
                         'port_title'=> $inputPortTitle,
                         'port_excerpt' => $inputDescription,
                         'post_thumbnail'=>$inputThumbnail,
                         'category_id'=>$inputCategoryId
                        
                  ]);

              

                   DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Portfolio",
                       'category_id' => $getLastID,
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

                 

                        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Profile Picture",
                       'category_id' =>$userId,
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

    

        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Update Experience",
                       'category_id' =>$expId,
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


        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Update Education",
                       'category_id' =>$expId,
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

       

        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Update Skills",
                       'category_id' =>$skiId,
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

        
        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Update Settings",
                       'category_id' =>$userId,
                       'activity' => "Update Settings",
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

           DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Update Settings",
                       'category_id' =>$userId,
                       'activity' => "Update Settings",
                       'date'=> $inputDate
        ]);


           return back();

    }

    public function updatePortfolio(){

    $port_id = Input::get('id'); 
    $userId = Auth::id();

        if(empty(Input::file('image'))){

             $inputPort_title =  Input::get('port_title');
             $inputPort_excerpt  =  Input::get('port_excerpt');
             $inputDate = date('Y-m-d');
             
                DB::table('portfolio')
                  ->where('id', $port_id)
                  ->update(array(
                            'port_title' => $inputPort_title,
                            'port_excerpt' => $inputPort_excerpt,
                      ));  

                DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Update Portfolio",
                       'category_id' =>$port_id,
                       'activity' => "Update Portfolio in ".$inputPort_title,
                       'date'=> $inputDate
                ]);    
         
              return back();

        }else{

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
     
                        
                     $inputPort_excerpt  =  Input::get('port_excerpt');
                     $inputPort_thumbnail  =  $fileName;
                     $inputDate = date('Y-m-d');


                DB::table('portfolio')
                  ->where('id', $port_id)
                  ->update(array(
                            'port_title' => $inputPort_title,
                            'port_excerpt' => $inputPort_excerpt,
                            'port_thumbnail' => $inputPort_thumbnail,
                      ));  

                DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Update Portfolio",
                       'category_id' =>$port_id,
                       'activity' => "Update Portfolio in ".$inputPort_title,
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



    }


    public function deletePortfolio($id){


        $userId = Auth::id();
        $portId = $id;
        $inputDate = date('Y-m-d');
        
        $portfolio = DB::table('portfolio')->where('id',$portId)->first(); 

        DB::table('dashboard_timeline')->insert([
                    'user_id' => $userId,
                    'category' => "Delete Portfolio",
                    'category_id' =>rand(11111,99999),
                    'activity' => "Delete Portfolio in ".$portfolio->port_title,
                    'date'=> $inputDate
        ]);

        DB::table('portfolio')
                ->where('id',$portId)->delete();

        return back();

    }


    public function deleteExperience($id){


        $userId = Auth::id();
        $expId = $id;
        $inputDate = date('Y-m-d');
        
        $experience = DB::table('work_experience')->where('id',$expId)->first(); 

       //  DB::table('news_feeds')->insert([
       //           'user_id' => $userId,
       //           'activity' => "Delete Experience in ".$experience->company_name,
       //           'date'=> $inputDate
       // ]);        

        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Delete Experience",
                       'category_id' =>rand(11111,99999),
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
        
        
        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Delete Education",
                       'category_id' =>rand(11111,99999),
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
         
        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Delete Skills",
                       'category_id' =>rand(11111,99999),
                       'activity' => "Delete Skills ".$skills->skillname,
                       'date'=> $inputDate
        ]);

        return back();

    }

     
     public function applyJobs(){

        $userId = Auth::id();
        $job_id =  Input::get('job_id');
        $inputDate = date('Y-m-d');
        
        $jobInfo = DB::table('job')->where('id',$job_id)->first(); 

        $applicantId = DB::table('applicant')->insertGetId([
                       'user_id' => $userId,
                       'job_id' => $job_id,
                       'date'=> $inputDate,
                       'status'=> "PENDING"
        ]);
                
        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Apply Jobs",
                       'category_id' => $applicantId,
                       'activity' => "Applying for ".$jobInfo->company_job." in ".$jobInfo->company_name,
                       'date'=> $inputDate
        ]);

        return back();

    }


    public function applyJobsinNotificaton(){

        $userId = Auth::id();
        $job_id =  Input::get('job_id');
        $inputDate = date('Y-m-d');
        $notificaton_id = Input::get('notification_id');
        
        $jobInfo = DB::table('job')->where('id',$job_id)->first(); 

        $applicantId = DB::table('applicant')->insertGetId([
                       'user_id' => $userId,
                       'job_id' => $job_id,
                       'date'=> $inputDate,
                       'status'=> "PENDING"
        ]);
                
        DB::table('dashboard_timeline')->insert([
                       'user_id' => $userId,
                       'category' => "Apply Jobs",
                       'category_id' => $applicantId,
                       'activity' => "Applying for ".$jobInfo->company_job." in ".$jobInfo->company_name,
                       'date'=> $inputDate
        ]);

        DB::table('user_notification')
                  ->where('id', $notificaton_id)
                  ->update(array(
                        'status' => "Delete"
                    ));

        return back();

    }


     public function deleteJobNotification($id){

        $id = Input::get('id');
        $status = "Delete";

        DB::table('user_notification')
                  ->where('id', $id)
                  ->update(array(
                        'status' => $status
                    ));

        return back();

    }

    public function cvlist()
    {
    $userId = Auth::id();
    $name = Auth::user()->name;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();

                 
    $userSettings = DB::table('settings')->where('user_id',$userId)->first(); 

    $userAds = DB::table('ads')->where([
                     'area' => 'USERDASHBOARD',
                     'status' => 'ACTIVE'
                  ])->first();   
    
  
   
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();  

    $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 

    $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get(); 

    $count_job = DB::table('job')->count();          

    $list_job = DB::table('job')->get();

    $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

    $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();  

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->get();

    $user_list =  DB::table('users')->get(); 

    $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

    $count_like = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'LIKE'
                  ])->count();

    $count_view = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'VIEW'
                  ])->count();


        return view('cvlist')
                ->with("userProfile",$userProfile)
                ->with("name",$name)
                ->with("if_exist",$if_exist)
                ->with("if_exist_settings",$if_exist_settings)
                ->with("userSettings",$userSettings)
                ->with("userAds",$userAds)
                ->with("count_job",$count_job)
                ->with("no_message",$no_message)
                ->with("list_message",$list_message)
                ->with("list_job",$list_job)
                ->with("job_notification",$job_notification)
                ->with("job_list_notification",$job_list_notification)
                ->with("user_list",$user_list)
                ->with("user_notification",$user_notification)
                ->with("user_list_notification",$user_list_notification)
                ->with("count_connection",$count_connection)
                ->with("count_like",$count_like)
                ->with("count_view",$count_view)
        ;

    }
     

    public function connection()
    {
    $userId = Auth::id();
    $name = Auth::user()->name;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();

                 
    $userSettings = DB::table('settings')->where('user_id',$userId)->first(); 

    $userAds = DB::table('ads')->where([
                     'area' => 'USERDASHBOARD',
                     'status' => 'ACTIVE'
                  ])->first();   
    
  
   
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();  

    $no_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->count(); 

    $list_message = DB::table('message')->where([
                     'user_id' => $userId,
                     'status' => 'PENDING'
                  ])->get(); 

    $count_job = DB::table('job')->count();          

    $list_job = DB::table('job')->get();

    $job_notification =  DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->count();

    $job_list_notification = DB::table('user_notification')->where([
                     'user_id' => $userId,
                     'category' => 'Job',
                     'status' => 'PENDING'
                  ])->get();  

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->get();

    $user_list =  DB::table('users')->get(); 

    $get_invitation = DB::table('connection_requests')->where(['to_user_id' => $userId, 'status'=>'ACCEPT'])->get();

    $get_follower = DB::table('connection_requests')->where(['to_user_id' => $userId, 'status'=>'PENDING'])->get();

    $count_connection = DB::table('connection_requests')->where([
                     'to_user_id' => $userId,
                     'status' => 'ACCEPT'
                  ])->count();

    $count_like = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'LIKE'
                  ])->count();

    $count_view = DB::table('like_view')->where([
                     'to_user_id' => $userId,
                     'status' => 'VIEW'
                  ])->count();



        return view('connection')
                ->with("userProfile",$userProfile)
                ->with("name",$name)
                ->with("if_exist",$if_exist)
                ->with("if_exist_settings",$if_exist_settings)
                ->with("userSettings",$userSettings)
                ->with("userAds",$userAds)
                ->with("count_job",$count_job)
                ->with("no_message",$no_message)
                ->with("list_message",$list_message)
                ->with("list_job",$list_job)
                ->with("job_notification",$job_notification)
                ->with("job_list_notification",$job_list_notification)
                ->with("user_list",$user_list)
                ->with("user_notification",$user_notification)
                ->with("user_list_notification",$user_list_notification)
                ->with("get_invitation",$get_invitation)
                ->with("get_follower",$get_follower)
                ->with("count_connection",$count_connection)
                ->with("count_like",$count_like)
                ->with("count_view",$count_view)

        ;

    }

    public function follow_users($id){

         $userId = Auth::id();
         $followed_id = $id;
         $inputDate = date('Y-m-d');

         $if_exist = DB::table('profiles')->where('user_id',$followed_id)->count(); 

         if($if_exist == 0){

                 $userInfo = DB::table('users')->where('id',$followed_id)->first(); 

                 DB::table('user_notification')->insert([
                          'user_id' => $userId,
                          'category' => "Followed",
                          'category_id' => $followed_id,
                          'status' => "PENDING",
                          'date'=> $inputDate
                 ]);


                 $connect = DB::table('connection_requests')->insertGetId([
                          'to_user_id' => $followed_id,
                          'from_user_id' => $userId,
                          'date'=> $inputDate,
                          'status' => "PENDING"
                 ]);


                //  DB::table('dashboard_timeline')->insert([
                //            'user_id' => $userId,
                //            'category' => "Followed",
                //            'category_id' =>$connect,
                //            'activity' => "Followed ".$userInfo->name,
                //            'date'=> $inputDate
                // ]);


         }else{

                $profileInfo = DB::table('profiles')->where('user_id',$followed_id)->first(); 

                DB::table('user_notification')->insert([
                          'user_id' => $userId,
                          'category' => "Followed",
                          'category_id' => $followed_id,
                          'status' => "PENDING",
                          'date'=> $inputDate
                 ]);

                 $connect = DB::table('connection_requests')->insertGetId([
                          'to_user_id' => $followed_id,
                          'from_user_id' => $userId,
                          'date'=> $inputDate,
                          'status' => "PENDING"
                 ]);


                // DB::table('dashboard_timeline')->insert([
                //            'user_id' => $userId,
                //            'category' => "Followed",
                //            'category_id' => $connect,
                //            'activity' => "Followed ".$profileInfo->name,
                //            'date'=> $inputDate
                // ]);




         }

        
        return back();


    }

    public function deleteUserNotification(){

        $id = Input::get('id');
        $status = "Delete";

        DB::table('user_notification')
                  ->where('id', $id)
                  ->update(array(
                        'status' => $status
                    ));

        return back();

    }


     public function acceptFollower($id){

        //$id = Auth::id();
        $getConnectionId = $id;
        $status = "ACCEPT";
        $inputDate = date('Y-m-d');

        $your_id = Auth::id();

        $your_user_info = DB::table('users')->where('id',$your_id)->first();
        $your_profile_info = DB::table('profiles')->where('user_id',$your_id)->first();
        $check_your_profiles =  DB::table('profiles')->where('user_id',$your_id)->count();

        $getConnectionInfo = DB::table('connection_requests')->where('id',$getConnectionId)->first(); 

        $follower_id = $getConnectionInfo->from_user_id;
        $follower_profile =  DB::table('profiles')->where('user_id',$follower_id)->first();
        $follower_users =  DB::table('users')->where('id',$follower_id)->first();
        $check_follower_profiles =  DB::table('profiles')->where('user_id',$follower_id)->count();



        if($check_follower_profiles = 0){
            $follower_name = $follower_users->name;
        }else{
            $follower_name = $follower_profile->name;
        }


        if($check_your_profiles == 0){
            $your_name = $your_user_info->name;
        }else{
            $your_name = $your_profile_info->name;
        }
        



        //notify you
        DB::table('dashboard_timeline')->insert([
                           'user_id' => $your_id,
                           'category' => "Accept Follower",
                           'category_id' => $getConnectionId,
                           'activity' => $follower_name." is now your follower.",
                           'date'=> $inputDate
                ]);


        //notify follower
        DB::table('dashboard_timeline')->insert([
                           'user_id' => $follower_id,
                           'category' => "Accept Invitation",
                           'category_id' => $getConnectionId,
                           'activity' =>  $your_name." accept your request.",
                           'date'=> $inputDate
        ]);





         DB::table('connection_requests')
                       ->where('id', $getConnectionId)
                     ->update(array(
                           'status' => $status
                       ));





       return back();


    }

    public function declineFollower($id){

        $getFollowerId = $id;
        $status = "DECLINE";

        DB::table('connection_requests')
                  ->where('id', $getFollowerId)
                  ->update(array(
                        'status' => $status
                    ));

       return back();

    }



    public function removeFollower($id){

        $getFollowerId = $id;
        $status = "DELETE_FOLLOWER";

       // DB::table('connection_requests')
       //         ->where('id',$getFollowerId)->delete();    

        DB::table('connection_requests')
                  ->where('id', $getFollowerId)
                  ->update(array(
                        'status' => $status
                    ));        


       return back();

    }

      public function likeUsersCV($id){

        $getUserId = $id;
        $your_id = Auth::id();
        $category = "LIKE CV";
        $status = "LIKE";
        $inputDate = date('Y-m-d');

        $check_your_profile = DB::table('profiles')->where('user_id',$your_id)->count();
        $your_profile =  DB::table('profiles')->where('user_id',$your_id)->first();


        if($check_your_profile == 0){
            $your_name = Auth::name();
        }else{
            $your_name = $your_profile->name;
        }



        $getLikeId = DB::table('like_view')->insertGetId([
                           'to_user_id' => $your_id,
                           'from_user_id' => $getUserId,
                           'category_id' => $getUserId,
                           'category' =>  $category,
                           'status' =>  $status,
                           'date'=> $inputDate
                ]);

        DB::table('dashboard_timeline')->insert([
                           'user_id' => $getUserId,
                           'category' => "Like CV",
                           'category_id' => $getLikeId,
                           'activity' =>  $your_name." like your CV.",
                           'date'=> $inputDate
        ]);

       return back();

    }


















































}
