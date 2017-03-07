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

class MessageController extends Controller
{
    

    public function message()
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
    //$FollowedUsers = DB::table('users_follow')->where('user_id',$userId)->count();            
    // $userFollow = DB::table('profiles')->orderByRaw("RAND()")->take(3)->get();
    // $userFollow2 = DB::table('profiles')->orderByRaw("RAND()")->take(2)->get();        
    $userSettings = DB::table('settings')->where('user_id',$userId)->first(); 
    $userAds = DB::table('ads')->where([
                     'area' => 'USERDASHBOARD',
                     'status' => 'ACTIVE'
                  ])->first();   
    
    $timeline = DB::table('dashboard_timeline')->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();
    $count_job = DB::table('job')->count();          

    
    $if_exist_settings = DB::table('settings')->where('user_id',$userId)->count();  

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



        return view('message')
                ->with("userProfile",$userProfile)
                ->with("userFeeds",$userFeeds)
                ->with("usersFile",$usersFile)
                ->with("name",$name)
                ->with("if_exist",$if_exist)
                ->with("if_exist_settings",$if_exist_settings)
                ->with("userSettings",$userSettings)
                // ->with("userFollow",$userFollow)
                // ->with("userFollow2",$userFollow2)
                // ->with("FollowedUsers",$FollowedUsers)
                ->with("userAds",$userAds)
                ->with("timeline",$timeline)
                ->with("count_job",$count_job)
                ->with("no_message",$no_message)
                ->with("list_message",$list_message)
                ->with("list_job",$list_job)
                ->with("job_notification",$job_notification)
                ->with("job_list_notification",$job_list_notification)
       ;
   

    }


    
    public function messageSend(){

        $userId = Input::get('id');
        $inputName = Input::get('name');
        $inputEmail = Input::get('email');
        $inputMessage = Input::get('message');
        $inputDate = date('Y-m-d');

        $getLastID = DB::table('message')->insertGetId([
                    'user_id' => $userId,
                    'name'    => $inputName,
                    'email'   => $inputEmail,
                    'message' => $inputMessage,
                    'date'    => $inputDate,
                    'status'  => "PENDING"
        ]);

        DB::table('dashboard_timeline')->insert([
                       'user_id'     => $userId,
                       'category'    => "Send Message",
                       'category_id' => $getLastID,
                       'activity'    => "New Message from  ".$inputName,
                       'date'        => $inputDate
        ]);   

        return back();

    }


    public function messageSendtoClient()
    {
        $user = Input::get('id');
        $user_id = Auth::id();
        $subject_value = Input::get('sender_subject');
        $message_value = Input::get('sender_message');
        $client_email = 'ocojcastro@gmail.com';

        $userProfile = DB::table('profiles')->where('user_id',$user_id)->first();
        $message_data = DB::table('message')->where('id',$user)->first();
        $name = $userProfile->name;
        $email = $userProfile->email;
       
        Mail::send('email.sendtoClient',["message_value" => $message_value], function ($message) use($name,$email,$subject_value,$client_email) {

            $message->from($email,$name);

            $message->to($client_email)->subject($subject_value);

        });
         return back();

    }
    
    public function messageDelete()
    {
        $id = Input::get('id');
        
        DB::table('message')->where('id',$id)->delete();
        

        return back();

    }        


}
