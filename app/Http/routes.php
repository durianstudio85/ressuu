<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');
Route::get('/register', 'UserController@showUserRegistration');
Route::post('/register', 'UserController@saveUser');




Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/profile', 'HomeController@profile');
Route::get('/jobs', 'HomeController@jobs');
Route::get('/setting', 'HomeController@setting');
Route::get('/portfolio', 'HomeController@portfolio');
Route::get('/resume', 'HomeController@resume');
Route::get('/message', 'MessageController@message');
Route::get('/connection', 'HomeController@connection');
Route::get('/cvlist', 'HomeController@cvlist');



//edit/update
Route::get('/profile/edit', 'HomeController@edit');
Route::get('/resume/updateExperience/{id}', 'HomeController@updateExperience');
Route::get('/resume/updateEducation/{id}', 'HomeController@updateEducation');
Route::get('/resume/updateSkill/{id}', 'HomeController@updateSkill');
Route::post('/setting/updateSettings', 'HomeController@updateSettings');
Route::post('/portfolio/updatePortfolio', 'HomeController@updatePortfolio'); // portfolio

//add
Route::get('/profile/insert', 'HomeController@insertProfile');
Route::get('/resume/addExperience', 'HomeController@addExperience');
Route::get('/resume/addEducation', 'HomeController@addEducation');
Route::get('/resume/addSkill', 'HomeController@addSkill');
Route::get('/resume/addCertification', 'HomeController@addCertification');
Route::post('/portfolio/addPortfolio', 'HomeController@addPortfolio');
Route::get('/home/follow', 'HomeController@follow');




//Route::get('/register', 'HomeController@addUser');




//delete
Route::get('/resume/deleteExperience/{id}', 'HomeController@deleteExperience');
Route::get('/resume/deleteEducation/{id}', 'HomeController@deleteEducation');
Route::get('/resume/deleteSkill/{id}', 'HomeController@deleteSkill');
Route::get('/resume/deleteCertification/{id}', 'HomeController@deleteCertification');
Route::get('/portfolio/deletePortfolio/{id}', 'HomeController@deletePortfolio'); // portfolio





/*cv output */
Route::get('/cv/{id}', 'CvController@cvdetails');

Route::get('/previewcv/{themename}/{id}', 'CvController@previewcv');

Route::post('/apply/upload', 'HomeController@uploadPicture');




/* fb integration */



Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');


Route::get('auth/twitter', 'Auth\AuthController@tredirectToProvider');
Route::get('auth/twitter/callback', 'Auth\AuthController@thandleProviderCallback');






/*admin */
Route::get('/admin', 'AdminController@index');
Route::post('/admin/fetchadmin', 'AdminController@fetchadmin');
Route::get('/admin/home', 'AdminController@adminHome');
Route::get('/admin/logout', 'AdminController@logoutAdmin');


Route::get('/admin/home', 'AdminController@adminHome');
Route::get('/admin/users', 'AdminController@adminUsers');
Route::get('/admin/ads', 'AdminController@adminAds');
Route::get('/admin/jobs', 'AdminController@adminJobs');
Route::get('/admin/settings', 'AdminController@adminSettings');


Route::post('/jobs/addJobs', 'AdminController@addJobs');
Route::post('/jobs/editJobs', 'AdminController@editJobs');
Route::get('/jobs/deleteJobs/{id}', 'AdminController@deleteJobs');

Route::post('/jobs/applyJobs', 'HomeController@applyJobs');
Route::post('/jobs/applyJobsinNotificaton', 'HomeController@applyJobsinNotificaton');

Route::get('/jobs/deleteJobNotification/{id}', 'HomeController@deleteJobNotification');

Route::post('/settings/editSettings', 'AdminController@editSettings');

Route::post('/ads/addAds/dashboard', 'AdminController@adsNewUserDashboard');
Route::post('/ads/updateAds/dashboard', 'AdminController@adsUpdateUserDashboard');

Route::post('/ads/addAds/profile', 'AdminController@adsNewUserProfile');
Route::post('/ads/updateAds/profile', 'AdminController@adsUpdateUserProfile');

Route::post('/ads/addAds/settings', 'AdminController@adsNewUserSettings');
Route::post('/ads/updateAds/settings', 'AdminController@adsUpdateUserSettings');

Route::post('/ads/addAds/adminAds', 'AdminController@adsNewAdmin');
Route::post('/ads/updateAds/adminAds', 'AdminController@adsUpdateAdmin');

/* message */

Route::post('/message/send', 'MessageController@messageSend');

Route::post('/message/sendtoClient', 'MessageController@messageSendtoClient');

Route::post('/message/delete', 'MessageController@messageDelete');

/* users */

Route::get('/follow/users/{id}', 'HomeController@follow_users');
Route::post('/follow/deleteUserNotification', 'HomeController@deleteUserNotification');

Route::get('/follow/accept/{id}', 'HomeController@acceptFollower');
Route::get('/follow/remove/{id}', 'HomeController@removeFollower');
Route::get('/follow/decline/{id}', 'HomeController@declineFollower');
Route::get('/unfollow/users/{id}', 'HomeController@unFollowUsers');

Route::get('/like/users/{id}', 'HomeController@likeUsersCV');
Route::get('/view/users/{id}', 'HomeController@viewUsersCV');

Route::post('/portfolio/updateCoverPhoto/', 'HomeController@updateCoverPhoto');

Route::get('/cancel/application/{id}', 'HomeController@cancelApplication');



Route::get('/all/usernotification/', 'UsersNotifications@allUserNotification');
Route::get('/all/messagenotification/', 'UsersNotifications@allMessageNotification');
Route::get('/all/jobNotification/', 'UsersNotifications@allJobNotification');


