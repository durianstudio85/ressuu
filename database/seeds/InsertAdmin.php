<?php

use Illuminate\Database\Seeder;

class InsertAdmin extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
          


 		$if_exist = DB::table('admin_users')->where('id',1)->count();

 		if($if_exist == 0){

 			  DB::table('admin_users')->insert([
            	  'name' => "Hello World",	
	              'email' => "admin@gmail.com",
	       		  'password' => "98423651",	
	              'position' => "Adminstrator",
	         	  'phone' => " ",	
	              'profile_pic' => "default_avatar.jpg",
	              'url' => " ",
	              'facebook_id' => " ",
	              'twitter_id' => " ",
	              'remember_token' => " ",
	              'is_logged_in' => "0"		         
            ]);

 			 echo "Admin Succesfully Inserted. \n"; 
 			 echo "Email: admin@gmail.com \n";
 			 echo "Password: 98423651"; 


 		} else { 
 			echo "Admin Already Inserted \n";
 			

 		}

    }
}


