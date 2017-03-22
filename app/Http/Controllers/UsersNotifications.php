<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Input;
use DB;
use Mail;
use App\User;
use App\Http\Controllers\Controller;

class UsersNotifications extends Controller
{


    public function allUserNotification()
     {

    $userId = Auth::id();
    $name = Auth::user()->name;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();
    // $userFeeds = DB::table('news_feeds')
    //             ->where('user_id', $userId)
    //             ->orderBy('date', 'desc')
    //             ->get();            

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
                  ])->orderBy('id', 'desc')->get(); 

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
                  ])->orderBy('id', 'desc')->get();

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->orderBy('id', 'desc')->get();

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

    $follow_list =  DB::table('users')->orderByRaw("RAND()")->take(3)->get();

    $follow_list2 = DB::table('users')->take(3)->get();


    //$follow_list =  DB::table('users')->take(2)->get();

    $check_followed_user = DB::table('connection_requests')->where([
                 'from_user_id'=>$userId,'status'=>"ACCEPT"
                 ])->count();

    $get_follower = DB::table('connection_requests')->where(['to_user_id' => $userId, 'status'=>'PENDING'])->get();


        return view('userNotification')
                ->with("userProfile",$userProfile)
                //->with("userFeeds",$userFeeds)
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
                ->with("follow_list",$follow_list)
                ->with("follow_list2",$follow_list2)
                ->with("check_followed_user",$check_followed_user)
                ->with("get_follower",$get_follower)
               


       ;
   

    }
    public function allMessageNotification()
     {


        return view('messageNotification')
            
       ;
   

    }
    public function allJobNotification()
     {


       $userId = Auth::id();
    $name = Auth::user()->name;
    $if_exist = DB::table('profiles')->where('user_id',$userId)->count();
    $userProfile = DB::table('profiles')->where('user_id',$userId)->first();
    // $userFeeds = DB::table('news_feeds')
    //             ->where('user_id', $userId)
    //             ->orderBy('date', 'desc')
    //             ->get();            

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
                  ])->orderBy('id', 'desc')->get(); 

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
                  ])->orderBy('id', 'desc')->get();

    $user_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->count();

    $user_list_notification = DB::table('user_notification')->where([
                     'category_id' => $userId,
                     'category' => 'Followed',
                     'status' => 'PENDING'
                  ])->orderBy('id', 'desc')->get();

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

    // $follow_list =  DB::table('users')->orderByRaw("RAND()")->take(3)->get();

    // $follow_list2 = DB::table('users')->take(3)->get();


    // //$follow_list =  DB::table('users')->take(2)->get();

    // $check_followed_user = DB::table('connection_requests')->where([
    //              'from_user_id'=>$userId,'status'=>"ACCEPT"
    //              ])->count();

    // $get_follower = DB::table('connection_requests')->where(['to_user_id' => $userId, 'status'=>'PENDING'])->get();

     $userJobs = DB::table('job')->orderBy('id', 'desc')->get();

        return view('jobNotification')
                ->with("userProfile",$userProfile)
                //->with("userFeeds",$userFeeds)
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
                ->with("userJobs",$userJobs)
               // ->with("follow_list",$follow_list)
                //->with("follow_list2",$follow_list2)
                //->with("check_followed_user",$check_followed_user)
                //->with("get_follower",$get_follower)
               


       ;
   

    }

}
