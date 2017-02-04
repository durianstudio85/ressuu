<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;


class CvController extends Controller
{
    


	public function cvdetails($id)
    {

    $link = $id;
    $getUser = DB::table('settings')->where('permalink',$link)->first();
  
  	$User_CVID = $getUser->user_id;

  	$profiles = DB::table('profiles')->where('user_id',$User_CVID)->first();

    $work_experience = DB::table('work_experience')
                ->where('user_id', $User_CVID)
                ->orderBy('id', 'desc')
                ->get();

    $education = DB::table('education')
                ->where('user_id', $User_CVID)
                ->orderBy('id', 'desc')
                ->get();  

    $skills = DB::table('skills')
                ->where('user_id', $User_CVID)
                ->orderBy('id', 'desc')
                ->get();   
    $certification = DB::table('certification')
                ->where('user_id', $User_CVID)
                ->orderBy('id', 'desc')
                ->get(); 

    $userPorfoliosCategories = DB::table('portfolio_cat')
                ->get();            

    $userPorfolios = DB::table('portfolio')
                ->where('user_id', $User_CVID)
                ->orderBy('id', 'desc')
                ->get();            

    $settings =  DB::table('settings')
                ->where('user_id', $User_CVID)
                ->first();        
              

        return view('cv.index')
               ->with("User_CVID",$User_CVID)
                ->with("profiles",$profiles)
                ->with("education",$education)
                ->with("profiles",$profiles)
                ->with("skills",$skills)
                ->with("work_experience",$work_experience)
                ->with("userPorfoliosCategories",$userPorfoliosCategories)
                ->with("userPorfolios",$userPorfolios)
                ->with("settings",$settings)
        ;

    }

      public function previewcv($themename,$id){


        $theme_name = $themename;
        $user_id = $id;

        $profiles = DB::table('profiles')->where('user_id',$user_id)->first();

        $work_experience = DB::table('work_experience')
                ->where('user_id', $user_id)
                ->orderBy('id', 'desc')
                ->get();

        $education = DB::table('education')
                    ->where('user_id', $user_id)
                    ->orderBy('id', 'desc')
                    ->get();  

        $skills = DB::table('skills')
                    ->where('user_id', $user_id)
                    ->orderBy('id', 'desc')
                    ->get();   
        $certification = DB::table('certification')
                    ->where('user_id', $user_id)
                    ->orderBy('id', 'desc')
                    ->get(); 

        $userPorfoliosCategories = DB::table('portfolio_cat')
                    ->get();            

        $userPorfolios = DB::table('portfolio')
                    ->where('user_id', $user_id)
                    ->orderBy('id', 'desc')
                    ->get();            

        $settings =  DB::table('settings')
                    ->where('user_id', $user_id)
                    ->first();        
                  

        return view('previewcv.index')
               ->with("user_id",$user_id)
               ->with("theme_name",$theme_name)
               ->with("profiles",$profiles)
               ->with("education",$education)
                ->with("profiles",$profiles)
                ->with("skills",$skills)
                ->with("work_experience",$work_experience)
                ->with("userPorfoliosCategories",$userPorfoliosCategories)
                ->with("userPorfolios",$userPorfolios)
                ->with("settings",$settings)


            ;    

        }


}
