<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Input;
use DB;
use Mail;
use App\User;
use Request;

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

    public function messageSendtoClient(){

        $userId = Input::get('id');
        $email_subject = "Thank you for getting!";

        $admin_email = "Hellow World";
        $email_from = "Test USer";
        // $inputEmail = Input::get('email');
        // $inputMessage = Input::get('message');
        // $inputDate = date('Y-m-d');

        // $getLastID = DB::table('message')->insertGetId([
        //             'user_id' => $userId,
        //             'name'    => $inputName,
        //             'email'   => $inputEmail,
        //             'message' => $inputMessage,
        //             'date'    => $inputDate,
        //             'status'  => "PENDING"
        // ]);

        // DB::table('dashboard_timeline')->insert([
        //                'user_id'     => $userId,
        //                'category'    => "Send Message",
        //                'category_id' => $getLastID,
        //                'activity'    => "New Message from  ".$inputName,
        //                'date'        => $inputDate
        // ]);   

        


        //     Mail::send('email.sendtoClient',['user' => $user], function ($message) {
        //     $message->from('us@example.com', 'Laravel');

        //     $message->to('ocojcastro@gmail.com')->subject('Your Reminder!');
        // });
        $headers = 'From: '.$email_from."\r\n".
 
        'Reply-To: '.$email_from."\r\n" .
         
        'X-Mailer: PHP/' . phpversion();

        @mail("ocojcastro@gmail.com", $email_subject, $admin_email, $headers);  

        return back();
    }

   

    

}
