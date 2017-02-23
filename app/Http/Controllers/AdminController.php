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

             return view('admin.index')
             		 ->with("admin_newsfeed",$admin_newsfeed)
             		 ->with("adminProfile",$adminProfile)
             ;

	}

	public function adminUsers(){


      $userList = DB::table('users')->orderBy('name', 'desc')->get();

			//$userList = DB::table('profiles')->orderBy('name', 'desc')->get();
	
             return view('admin.users')
             		 ->with("userList",$userList)
             ;

	}

	public function adminAds(){

             return view('admin.ads');

	}

	public function adminJobs(){

		    $jobList = DB::table('job')->orderBy('id', 'desc')
		                ->get();

             return view('admin.jobs')
             		->with("jobList",$jobList)

             ;

	}

	public function adminSettings(){

             return view('admin.settings');

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
                  	 $inputJob_id = "0";
                  	 $inputUser_id = "0";
                  	 $inputCompany_Name =  Input::get('company_name');
					 $inputCompany_Address  =  Input::get('company_address');
					 $inputCompany_Jobtitle  =  Input::get('company_jobtitle');
					 $inputCompany_Picture  =  $fileName;
					 $inputCompany_Details  =  Input::get('company_details');
					 $inputCompany_Rate  =  Input::get('company_rate');
					 $inputCompany_Status = "PENDING";
					 $inputDate = date('Y-m-d');
					  

                 	DB::table('job')->insert([
                            'job_id' => "0",
                            'user_id' => "0",
                            'company_name' => $inputCompany_Name,
                            'company_address' => $inputCompany_Address,
                            'company_job' => $inputCompany_Jobtitle,
                            'company_picture' => $inputCompany_Picture,
                            'company_details' => $inputCompany_Details,
                            'company_rate' => $inputCompany_Rate,
                            'company_status' => $inputCompany_Status,
                            'date'=> $inputDate
                    ]);


                 	DB::table('admin_news_feeds')->insert([
			                'user_id' => session('id'),
			                'activity' => "Add New Job about ".$inputCompany_Jobtitle,
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


	public function editJobs(){


			  $job_id = Input::get('id');	


			  if(empty(Input::file('logo'))){

             $inputCompany_Name =  Input::get('company_name');
             $inputCompany_Address  =  Input::get('company_address');
             $inputCompany_Jobtitle  =  Input::get('company_jobtitle');
             $inputCompany_Details  =  Input::get('company_details');
             $inputCompany_Rate  =  Input::get('company_rate');




               DB::table('job')
                  ->where('id', $job_id)
                  ->update(array(
                            'company_name' => $inputCompany_Name,
                            'company_address' => $inputCompany_Address,
                            'company_job' => $inputCompany_Jobtitle,
                            'company_details' => $inputCompany_Details,
                            'company_rate' => $inputCompany_Rate,
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
                     $inputCompany_Name =  Input::get('company_name');
                     $inputCompany_Address  =  Input::get('company_address');
                     $inputCompany_Jobtitle  =  Input::get('company_jobtitle');
                     $inputCompany_Picture  =  $fileName;
                     $inputCompany_Details  =  Input::get('company_details');
                     $inputCompany_Rate  =  Input::get('company_rate');




               DB::table('job')
                  ->where('id', $job_id)
                  ->update(array(
                            'company_name' => $inputCompany_Name,
                            'company_address' => $inputCompany_Address,
                            'company_job' => $inputCompany_Jobtitle,
                            'company_picture' => $inputCompany_Picture,
                            'company_details' => $inputCompany_Details,
                            'company_rate' => $inputCompany_Rate,
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

        $jobs = DB::table('job')->where('id',$job_id)->first(); 


        DB::table('job')
                ->where('id',$job_id)->delete();


        DB::table('admin_news_feeds')->insert([
                 'user_id' => session('id'),
                 'activity' => "Delete job for ".$jobs->company_name,
                 'date'=> $inputDate
         ]);                 


        return back();







}























}
