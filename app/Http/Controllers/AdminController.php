<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
use Input;
use Session;
use Validator;
use Redirect;

class AdminController extends Controller
{
    



  public function index(){


             return view('admin.login');

  }

  public function adminHome(){


    $adminProfile = DB::table('admin_users')->where('id',session('id'))->first(); 
    $admin_newsfeed = DB::table('admin_news_feeds')
                ->where('user_id', session('id'))
                ->orderBy('id', 'desc')
                ->get();

    $AdminDashboard_Ads = DB::table('ads')->where([
                     'area' => 'ADMIN',
                     'status' => 'ACTIVE'
                  ])->first();           
     


             return view('admin.index')
                 ->with("admin_newsfeed",$admin_newsfeed)
                 ->with("adminProfile",$adminProfile)
                 ->with("AdminDashboard_Ads",$AdminDashboard_Ads)
             ;

  }

  public function adminUsers(){

      $adminProfile = DB::table('admin_users')->where('id',session('id'))->first(); 
      $userList = DB::table('users')->orderBy('name', 'desc')->get();

      $AdminDashboard_Ads = DB::table('ads')->where([
                     'area' => 'ADMIN',
                     'status' => 'ACTIVE'
                  ])->first();     

             return view('admin.users')
                 ->with("userList",$userList)
                 ->with("adminProfile",$adminProfile)
                 ->with("AdminDashboard_Ads",$AdminDashboard_Ads)
             ;

  }

  public function adminAds(){

      $adminProfile = DB::table('admin_users')->where('id',session('id'))->first();
     
      $UserDashboard_Ads = DB::table('ads')->where([
                     'area' => 'USERDASHBOARD',
                     'status' => 'ACTIVE'
                  ])->first(); 

      $UserProfile_Ads = DB::table('ads')->where([
                     'area' => 'USERPROFILE',
                     'status' => 'ACTIVE'
                  ])->first(); 

      $UserSettings_Ads = DB::table('ads')->where([
                     'area' => 'USERSETTINGS',
                     'status' => 'ACTIVE'
                  ])->first(); 

      $AdminDashboard_Ads = DB::table('ads')->where([
                     'area' => 'ADMIN',
                     'status' => 'ACTIVE'
                  ])->first(); 

             return view('admin.ads')
                  ->with("adminProfile",$adminProfile)
                  ->with("UserDashboard_Ads",$UserDashboard_Ads)
                  ->with("UserProfile_Ads",$UserProfile_Ads)
                  ->with("UserSettings_Ads",$UserSettings_Ads)
                  ->with("AdminDashboard_Ads",$AdminDashboard_Ads)




             ;

  }

  public function adminJobs(){

        $adminProfile = DB::table('admin_users')->where('id',session('id'))->first();
      
        $jobList = DB::table('job')->orderBy('id', 'desc')->get();

        $AdminDashboard_Ads = DB::table('ads')->where([
                     'area' => 'ADMIN',
                     'status' => 'ACTIVE'
                  ])->first();                 
        $number = 0; 


             return view('admin.jobs')
                ->with("jobList",$jobList)
                ->with("adminProfile",$adminProfile)
                ->with("AdminDashboard_Ads",$AdminDashboard_Ads)
                ->with("number",$number)


             ;

  }

  public function adminSettings(){

        $adminProfile = DB::table('admin_users')->where('id',session('id'))->first();

        $AdminDashboard_Ads = DB::table('ads')->where([
                     'area' => 'ADMIN',
                     'status' => 'ACTIVE'
                  ])->first();     

             return view('admin.settings')
                ->with("adminProfile",$adminProfile)
                ->with("AdminDashboard_Ads",$AdminDashboard_Ads)

             ;

  }






  public function fetchadmin(){

      $inputEmail =  Input::get('email');
      $inputPass  =  Input::get('password');

       $fetchAdmin = DB::table('admin_users')->where([
                     'email' => $inputEmail,
                     'password' => $inputPass
                  ])->first();

       if(!$fetchAdmin){

               return redirect()->to('/admin');

      }else{

           DB::table('admin_users')->where([
                      'id' => $fetchAdmin->id
                 ])->update([
                    'is_logged_in' => "1"
                    ]);
          session()->regenerate();
            Session::put('id', $fetchAdmin->id );
             
         return redirect()->to('/admin/home');
       }  


  }
  public function logoutAdmin(){


      DB::table('admin_users')->where([
                      'id' => session('id')
             ])->update([
                 'is_logged_in' => '0'
      ]); 
      Session::forget('id');
      return redirect()->to('/admin');

  }



  public function addJobs(){


       // getting all of the post data
              $file = array('image' => Input::file('logo'));
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
                if (Input::file('logo')->isValid()) {
                  $destinationPath = 'joblogo'; // upload path
                  $extension = Input::file('logo')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('logo')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message
                     $inputJob_id = rand(11111,99999);
                     $inputUser_id = "0";

                //     $inputCompany_Name =  Input::get('company_name');
                     // $inputCompany_Address  =  Input::get('company_address');
                     // $inputCompany_Jobtitle  =  Input::get('company_jobtitle');
                     
                     // $inputCompany_Details  =  Input::get('company_details');
                     // $inputCompany_Rate  =  Input::get('company_rate');
                     // $inputJob_Description = Input::get('job_description');
                     // $inputDate = date('Y-m-d');

                     $inputCompany_Jobtitle  =  Input::get('company_jobtitle');
                     $inputCompany_Rate  =  Input::get('company_rate');
                     $inputCompany_Workinghours  =  Input::get('company_workinghours');
                     $inputJob_Description = Input::get('job_description');

                     $inputCompany_Name =  Input::get('company_name');
                     $inputCompany_Address  =  Input::get('company_address');
                     $inputCompany_Details  =  Input::get('company_details');
                     $inputCompany_Email  =  Input::get('company_email');
                     $inputCompany_Website  =  Input::get('company_website');
                     $inputCompany_Telephone  =  Input::get('company_telephone');
                     $inputCompany_Companysize  =  Input::get('company_companysize');

                     $inputCompany_Spokenlanguage  =  Input::get('company_spokenlanguage');
                     $inputCompany_Industry  =  Input::get('company_industry');
                     $inputCompany_Processtime  =  Input::get('company_processtime');
                     $inputCompany_Facebook  =  Input::get('company_facebook');
                     $inputCompany_Benefits  =  Input::get('company_benefits');

                     $inputDate = date('Y-m-d');
                     $inputCompany_Picture  =  $fileName;
               
                     $my_address = $inputCompany_Address;
                     $my_prepAddr = str_replace(' ','+',$my_address);
                     $my_geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$my_prepAddr.'&sensor=false');
                     $output= json_decode($my_geocode);
                     $inputCompany_Latitude = $output->results[0]->geometry->location->lat;
                     $inputCompany_Longitude = $output->results[0]->geometry->location->lng;


                 $getLastId = DB::table('job')->insertGetId([
                            'job_id' => $inputJob_id,
                            'user_id' => "0",
                            'date'=> $inputDate,
                            'company_name' => $inputCompany_Name,
                            'company_address' => $inputCompany_Address,
                            'company_job' => $inputCompany_Jobtitle,
                            'company_picture' => $inputCompany_Picture,
                            'company_details' => $inputCompany_Details,
                            'company_rate' => $inputCompany_Rate,
                            'company_status' => $inputJob_Description,
                            'email' => $inputCompany_Email,
                            'company_processtime' => $inputCompany_Processtime,
                            'company_industry' => $inputCompany_Industry,
                            'company_telephone' => $inputCompany_Telephone,
                            'company_companysize' => $inputCompany_Companysize,
                            'company_spokenlanguage' => $inputCompany_Spokenlanguage,
                            'company_website' => $inputCompany_Website,
                            'company_facebook' => $inputCompany_Facebook,
                            'company_workinghours' => $inputCompany_Workinghours,
                            'company_benefits' => $inputCompany_Benefits,
                            'company_latitude' => $inputCompany_Latitude,
                            'company_longitude' => $inputCompany_Longitude,
                    ]);


                  DB::table('admin_news_feeds')->insert([
                      'user_id' => session('id'),
                      'activity' => "Add New Job about ".$inputCompany_Jobtitle,
                      'date'=> $inputDate
                 ]);


                  $userList = DB::table('users')->orderBy('name', 'desc')->get();

                  foreach ($userList as $users ) {
                  
             
                     DB::table('dashboard_timeline')->insert([
                          'user_id' => $users->id,
                          'category' => "Job",
                          'category_id' =>  $getLastId,
                          'activity' => "Add New Job about ".$inputCompany_Jobtitle,
                          'date'=> $inputDate
                     ]);

                     DB::table('user_notification')->insert([
                          'user_id' => $users->id,
                          'category' => "Job",
                          'category_id' => $getLastId,
                          'status' => "PENDING",
                          'date'=> $inputDate
                     ]);

                  }




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


  public function editJobs(){

    $job_id = Input::get('id'); 


        if(empty(Input::file('logo'))){

             $inputCompany_Jobtitle  =  Input::get('company_jobtitle');
             $inputCompany_Rate  =  Input::get('company_rate');
             $inputCompany_Workinghours  =  Input::get('company_workinghours');
             $inputJob_Description = Input::get('job_description');

             $inputCompany_Name =  Input::get('company_name');
             $inputCompany_Address  =  Input::get('company_address');
             $inputCompany_Details  =  Input::get('company_details');
             $inputCompany_Email  =  Input::get('company_email');
             $inputCompany_Website  =  Input::get('company_website');
             $inputCompany_Telephone  =  Input::get('company_telephone');
             $inputCompany_Companysize  =  Input::get('company_companysize');

             $inputCompany_Spokenlanguage  =  Input::get('company_spokenlanguage');
             $inputCompany_Industry  =  Input::get('company_industry');
             $inputCompany_Processtime  =  Input::get('company_processtime');
             $inputCompany_Facebook  =  Input::get('company_facebook');
             $inputCompany_Benefits  =  Input::get('company_benefits');

             $inputDate = date('Y-m-d');

             $my_address = $inputCompany_Address;
             $my_prepAddr = str_replace(' ','+',$my_address);
             $my_geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$my_prepAddr.'&sensor=false');
             $output= json_decode($my_geocode);
             $inputCompany_Latitude = $output->results[0]->geometry->location->lat;
             $inputCompany_Longitude = $output->results[0]->geometry->location->lng;




               DB::table('job')
                  ->where('id', $job_id)
                  ->update(array(
                            'company_name' => $inputCompany_Name,
                            'company_address' => $inputCompany_Address,
                            'company_job' => $inputCompany_Jobtitle,
                            'company_details' => $inputCompany_Details,
                            'company_rate' => $inputCompany_Rate,
                            'company_status' => $inputJob_Description,
                            'email' => $inputCompany_Email,
                            'company_processtime' => $inputCompany_Processtime,
                            'company_industry' => $inputCompany_Industry,
                            'company_telephone' => $inputCompany_Telephone,
                            'company_companysize' => $inputCompany_Companysize,
                            'company_spokenlanguage' => $inputCompany_Spokenlanguage,
                            'company_website' => $inputCompany_Website,
                            'company_facebook' => $inputCompany_Facebook,
                            'company_workinghours' => $inputCompany_Workinghours,
                            'company_benefits' => $inputCompany_Benefits,
                            'company_latitude' => $inputCompany_Latitude,
                            'company_longitude' => $inputCompany_Longitude,
                      ));  

                  DB::table('admin_news_feeds')->insert([
                      'user_id' => session('id'),
                      'activity' => "Update Job about ".$inputCompany_Jobtitle,
                      'date'=> $inputDate
                ]);

                  

                  
              //Session::flash('success', 'Upload successfully'); 
              return back();

        }else{

              // getting all of the post data
              $file = array('image' => Input::file('logo'));
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
                if (Input::file('logo')->isValid()) {
                  $destinationPath = 'joblogo'; // upload path
                  $extension = Input::file('logo')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('logo')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message
                     $inputJob_id = "0";
                     $inputOldlogo = Input::get('oldlogo');
          
                     $inputCompany_Jobtitle  =  Input::get('company_jobtitle');
                     $inputCompany_Rate  =  Input::get('company_rate');
                     $inputCompany_Workinghours  =  Input::get('company_workinghours');
                     $inputJob_Description = Input::get('job_description');

                     $inputCompany_Name =  Input::get('company_name');
                     $inputCompany_Address  =  Input::get('company_address');
                     $inputCompany_Details  =  Input::get('company_details');
                     $inputCompany_Email  =  Input::get('company_email');
                     $inputCompany_Website  =  Input::get('company_website');
                     $inputCompany_Telephone  =  Input::get('company_telephone');
                     $inputCompany_Companysize  =  Input::get('company_companysize');

                     $inputCompany_Spokenlanguage  =  Input::get('company_spokenlanguage');
                     $inputCompany_Industry  =  Input::get('company_industry');
                     $inputCompany_Processtime  =  Input::get('company_processtime');
                     $inputCompany_Facebook  =  Input::get('company_facebook');
                     $inputCompany_Benefits  =  Input::get('company_benefits');

                     $inputCompany_Picture  =  $fileName;
                     $inputDate = date('Y-m-d');

                     $my_address = $inputCompany_Address;
                     $my_prepAddr = str_replace(' ','+',$my_address);
                     $my_geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$my_prepAddr.'&sensor=false');
                     $output= json_decode($my_geocode);
                     $inputCompany_Latitude = $output->results[0]->geometry->location->lat;
                     $inputCompany_Longitude = $output->results[0]->geometry->location->lng;


               DB::table('job')
                  ->where('id', $job_id)
                  ->update(array(
                            'company_name' => $inputCompany_Name,
                            'company_address' => $inputCompany_Address,
                            'company_job' => $inputCompany_Jobtitle,
                            'company_picture' => $inputCompany_Picture,
                            'company_details' => $inputCompany_Details,
                            'company_rate' => $inputCompany_Rate,
                            'company_status' => $inputJob_Description,
                            'email' => $inputCompany_Email,
                            'company_processtime' => $inputCompany_Processtime,
                            'company_industry' => $inputCompany_Industry,
                            'company_telephone' => $inputCompany_Telephone,
                            'company_companysize' => $inputCompany_Companysize,
                            'company_spokenlanguage' => $inputCompany_Spokenlanguage,
                            'company_website' => $inputCompany_Website,
                            'company_facebook' => $inputCompany_Facebook,
                            'company_workinghours' => $inputCompany_Workinghours,
                            'company_benefits' => $inputCompany_Benefits,
                            'company_latitude' => $inputCompany_Latitude,
                            'company_longitude' => $inputCompany_Longitude,
                      ));  

                  DB::table('admin_news_feeds')->insert([
                      'user_id' => session('id'),
                      'activity' => "Update Job about ".$inputCompany_Jobtitle,
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


public function deleteJobs($id){



        $job_id = $id;
        $inputDate = date('Y-m-d');
        $status = "DELETE"; 
        $jobs = DB::table('job')->where('id',$job_id)->first(); 

         DB::table('job')
                  ->where('id', $job_id)
                  ->update(array(
                            'status' => $status, 
                      ));


        // DB::table('job')
        //         ->where('id',$job_id)->delete();


        DB::table('admin_news_feeds')->insert([
                 'user_id' => session('id'),
                 'activity' => "Delete job for ".$jobs->company_name,
                 'date'=> $inputDate
         ]);                 

        // $userList = DB::table('users')->orderBy('id', 'desc')->get();

        //          foreach ($userList as $users ) {
                  
        //           DB::table('dashboard_timeline')->where([
        //              'category_id' => $job_id,
        //           ])->delete();  

        //         }


        //DB::table('dashboard_timeline')->delete();

        return back();







}



  public function editSettings(){



        if(empty(Input::file('logo'))){

             $inputAdmin_Name =  Input::get('admin_name');
             $inputAdmin_Email  =  Input::get('admin_email');
             $inputAdmin_Password  =  Input::get('admin_password');
             $inputDate = date('Y-m-d');

               DB::table('admin_users')
                  ->where('id', session('id'))
                  ->update(array(
                            'name' => $inputAdmin_Name,
                            'email' => $inputAdmin_Email,
                            'password' => $inputAdmin_Password,
                      ));  

                  DB::table('admin_news_feeds')->insert([
                      'user_id' => session('id'),
                      'activity' => "Update Settings ",
                      'date'=> $inputDate
                ]);

              //Session::flash('success', 'Upload successfully'); 
              return back();

        }else{

              // getting all of the post data
              $file = array('image' => Input::file('logo'));
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
                if (Input::file('logo')->isValid()) {
                  $destinationPath = 'profilepic'; // upload path
                  $extension = Input::file('logo')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('logo')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputCompany_Picture  =  $fileName;
                    $inputAdmin_Name =  Input::get('admin_name');
                    $inputAdmin_Email  =  Input::get('admin_email');
                    $inputAdmin_Password  =  Input::get('admin_password');
                    $inputDate = date('Y-m-d');

                     DB::table('admin_users')
                    ->where('id', session('id'))
                    ->update(array(
                              'name' => $inputAdmin_Name,
                              'email' => $inputAdmin_Email,
                              'password' => $inputAdmin_Password,
                              'profile_pic' => $inputCompany_Picture,
                        ));  

                      DB::table('admin_news_feeds')->insert([
                          'user_id' => session('id'),
                          'activity' => "Update Settings ",
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





  public function adsNewUserDashboard(){



        if(empty(Input::file('image'))){

             // $inputAdmin_Name =  Input::get('admin_name');
             // $inputAdmin_Email  =  Input::get('admin_email');
             // $inputAdmin_Password  =  Input::get('admin_password');
             // $inputDate = date('Y-m-d');

             //   DB::table('admin_users')
             //      ->where('id', session('id'))
             //      ->update(array(
             //                'name' => $inputAdmin_Name,
             //                'email' => $inputAdmin_Email,
             //                'password' => $inputAdmin_Password,
             //          ));  

             //      DB::table('admin_news_feeds')->insert([
             //          'user_id' => session('id'),
             //          'activity' => "Update Settings ",
             //          'date'=> $inputDate
             //    ]);

             //Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "USERDASHBOARD";


                     DB::table('ads')->insert([
                         'photo'  => $inputAds_Photo,
                         'title'  => $inputAds_Title,
                         'link'   => $inputAds_Link,
                         'date'   => $inputAds_Date,
                         'status' => $inputAds_Status,
                         'area'   => $inputAds_Area
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



 public function adsUpdateUserDashboard(){

        $add_UserDashboard_Id = Input::get('id'); 

        if(empty(Input::file('image'))){


                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  


               Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "USERDASHBOARD";

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'photo'  => $inputAds_Photo,   
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  




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




   public function adsNewUserProfile(){



        if(empty(Input::file('image'))){

             // $inputAdmin_Name =  Input::get('admin_name');
             // $inputAdmin_Email  =  Input::get('admin_email');
             // $inputAdmin_Password  =  Input::get('admin_password');
             // $inputDate = date('Y-m-d');

             //   DB::table('admin_users')
             //      ->where('id', session('id'))
             //      ->update(array(
             //                'name' => $inputAdmin_Name,
             //                'email' => $inputAdmin_Email,
             //                'password' => $inputAdmin_Password,
             //          ));  

             //      DB::table('admin_news_feeds')->insert([
             //          'user_id' => session('id'),
             //          'activity' => "Update Settings ",
             //          'date'=> $inputDate
             //    ]);

             //Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "USERPROFILE";


                     DB::table('ads')->insert([
                         'photo'  => $inputAds_Photo,
                         'title'  => $inputAds_Title,
                         'link'   => $inputAds_Link,
                         'date'   => $inputAds_Date,
                         'status' => $inputAds_Status,
                         'area'   => $inputAds_Area
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



 public function adsUpdateUserProfile(){

        $add_UserDashboard_Id = Input::get('id'); 

        if(empty(Input::file('image'))){


                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  


               Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "USERPROFILE";

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'photo'  => $inputAds_Photo,   
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  




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







 public function adsNewUserSettings(){



        if(empty(Input::file('image'))){

             // $inputAdmin_Name =  Input::get('admin_name');
             // $inputAdmin_Email  =  Input::get('admin_email');
             // $inputAdmin_Password  =  Input::get('admin_password');
             // $inputDate = date('Y-m-d');

             //   DB::table('admin_users')
             //      ->where('id', session('id'))
             //      ->update(array(
             //                'name' => $inputAdmin_Name,
             //                'email' => $inputAdmin_Email,
             //                'password' => $inputAdmin_Password,
             //          ));  

             //      DB::table('admin_news_feeds')->insert([
             //          'user_id' => session('id'),
             //          'activity' => "Update Settings ",
             //          'date'=> $inputDate
             //    ]);

             //Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "USERSETTINGS";


                     DB::table('ads')->insert([
                         'photo'  => $inputAds_Photo,
                         'title'  => $inputAds_Title,
                         'link'   => $inputAds_Link,
                         'date'   => $inputAds_Date,
                         'status' => $inputAds_Status,
                         'area'   => $inputAds_Area
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



 public function adsUpdateUserSettings(){

        $add_UserDashboard_Id = Input::get('id'); 

        if(empty(Input::file('image'))){


                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  


               Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "USERSETTINGS";

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'photo'  => $inputAds_Photo,   
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  




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


 public function adsNewAdmin(){



        if(empty(Input::file('image'))){

             // $inputAdmin_Name =  Input::get('admin_name');
             // $inputAdmin_Email  =  Input::get('admin_email');
             // $inputAdmin_Password  =  Input::get('admin_password');
             // $inputDate = date('Y-m-d');

             //   DB::table('admin_users')
             //      ->where('id', session('id'))
             //      ->update(array(
             //                'name' => $inputAdmin_Name,
             //                'email' => $inputAdmin_Email,
             //                'password' => $inputAdmin_Password,
             //          ));  

             //      DB::table('admin_news_feeds')->insert([
             //          'user_id' => session('id'),
             //          'activity' => "Update Settings ",
             //          'date'=> $inputDate
             //    ]);

             //Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "ADMIN";


                     DB::table('ads')->insert([
                         'photo'  => $inputAds_Photo,
                         'title'  => $inputAds_Title,
                         'link'   => $inputAds_Link,
                         'date'   => $inputAds_Date,
                         'status' => $inputAds_Status,
                         'area'   => $inputAds_Area
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



 public function adsUpdateAdmin(){

        $add_UserDashboard_Id = Input::get('id'); 

        if(empty(Input::file('image'))){


                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  


               Session::flash('success', 'Upload successfully'); 
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
                  $destinationPath = 'ads'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = rand(11111,99999).'.'.$extension; // renameing image
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                     // sending back with message

                    $inputAds_Photo   =  $fileName;
                    $inputAds_Title   =  Input::get('ads_Title');
                    $inputAds_Link    =  Input::get('ads_Link');
                    $inputAds_Date    =  date('Y-m-d');
                    $inputAds_Status  =  "ACTIVE";
                    $inputAds_Area    =  "ADMIN";

                     DB::table('ads')
                    ->where('id', $add_UserDashboard_Id)
                    ->update(array(
                              'photo'  => $inputAds_Photo,   
                              'title' => $inputAds_Title,
                              'link' => $inputAds_Link
                    ));  




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
























}
