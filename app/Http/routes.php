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


//edit/update
Route::get('/profile/edit', 'HomeController@edit');
Route::get('/resume/updateExperience/{id}', 'HomeController@updateExperience');
Route::get('/resume/updateEducation/{id}', 'HomeController@updateEducation');
Route::get('/resume/updateSkill/{id}', 'HomeController@updateSkill');
Route::post('/setting/updateSettings', 'HomeController@updateSettings');

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





/*cv output */
Route::get('/cv/{id}', 'CvController@cvdetails');

Route::get('/previewcv/{themename}/{id}', 'CvController@previewcv');

Route::post('/apply/upload', 'HomeController@uploadPicture');

//image upload
//Route::get('/portfolio/addPortfolio', function() {
//  return View::make('pages.upload');
//});
//Route::post('apply/upload', 'ApplyController@upload');



// Route::get('/fbauth/{auth?}', 'HomeController@getFacebooklogin');
// Route::get('/redirect', 'SocialAuthController@redirect');
// Route::get('/callback', 'SocialAuthController@callback');






/* fb integration */



Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');