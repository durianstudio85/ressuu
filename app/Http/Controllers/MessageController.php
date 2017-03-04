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
