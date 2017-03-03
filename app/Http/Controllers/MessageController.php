<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Input;
use DB;
use Mail;
use App\User;

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

        $user = User::findOrFail($userId);


        Mail::send('email.sendtoClient',['user' => $user], function ($message) {
		    $message->from('us@example.com', 'Laravel');

		    $message->to('ocojcastro@gmail.com')->subject('Your Reminder!');
		});


        return back();

    }

    

}
