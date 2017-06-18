<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','WelcomeController@getInstitute');

Route::get('/login','WelcomeController@index');

Route::get('/register','WelcomeController@index');

Route::post('/login','WelcomeController@login')->name('login_user');

Route::post('/register','WelcomeController@register')->name('register_user');

Route::get('/programmes/{id}','AjaxController@programmes');

Route::get('/confirm/{token}','WelcomeController@activate');

Route::post('/forgotpassword','WelcomeController@forgotPassword')->name('forgotPassword');

Route::post('/contactus','WelcomeController@contactUs')->name('contactUs');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/home','HomeController@index')->name('home');

    Route::get('/allfriends','FriendsController@allFriends');

    Route::get('/pendingfriends','FriendsController@pendingFriends');

    Route::get('/requestedfriends','FriendsController@requestedFriends');

    Route::get('/searchprofile','HomeController@searchProfile')->name('searchProfile');

    Route::get('/searchinterest','EditProfileController@searchInterest')->name('searchInterest');

    /*Route::get('/search','HomeController@getResult')->name('searchResult');*/

    Route::post('/deletephotos','AjaxController@deletephoto');
    
    Route::get('/logout','WelcomeController@logout')->name('logout_user');

    Route::get('/profile/{regno}','ProfileController@profile')->name('profile');

    Route::get('/editprofile','EditProfileController@index')->name('editProfile');

    Route::put('/editprofile','EditProfileController@updateProfile')->name('editProfile');

    Route::post('/profile','ProfileController@updateAvatar')->name('ProfileAvatar');

    Route::get('/profile/{regno}/deactivate','ProfileController@deactivateIndex')->name('deactivateAccount');

    Route::post('/profile/{regno}/deactivate','ProfileController@deactivate')->name('deactivateAccount');

    Route::get('/changepassword','EditProfileController@changePasswordIndex')->name('changePassword');

    Route::put('/changepassword','EditProfileController@changePassword')->name('changePassword');

    Route::get('/addfriend/{regno}','HomeController@addFriend')->name('addFriend');

    Route::get('/unfriend','HomeController@unFriend')->name('unFriend');

    Route::get('/pendingrequest','HomeController@pendingRequest')->name('pendingRequest');

    Route::get('/deleterequest/{regno}','FriendsController@deleteRequest')->name('deleteRequest');

});