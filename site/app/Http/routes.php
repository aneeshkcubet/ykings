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



Route::group(['prefix' => 'api'], function() {
    Route::resource('authenticate', 'Api\AuthenticateController', ['only' => ['index']]);
    Route::get('authenticate', 'Api\AuthenticateController@authenticate');
    Route::get('users', 'Api\AuthenticateController@index');

    Route::post('user/get', [
        'as' => 'user.get',
        'uses' => 'Api\UsersController@getUser'
    ]);

    Route::post('user/login', [
        'as' => 'user.login',
        'uses' => 'Api\UsersController@login'
    ]);

    Route::post('user/update', [
        'as' => 'user.update',
        'uses' => 'Api\UsersController@update'
    ]);

    Route::post('user/videos', [
        'as' => 'user.videos',
        'uses' => 'Api\UserVideosController@GetUserVideos'
    ]);

    Route::post('user/video/delete', [
        'as' => 'user.video.delete',
        'uses' => 'Api\UserVideosController@deleteUserVideo'
    ]);

    Route::post('user/logout', [
        'as' => 'user.logout',
        'uses' => 'Api\UsersController@logout'
    ]);

    Route::post('user', [
        'as' => 'user.signup',
        'uses' => 'Api\UsersController@postRegister'
    ]);

    Route::get('verify', [
        'as' => 'confirmation_path',
        'uses' => 'Api\UsersController@confirm'
    ]);

    Route::post('password/email', [
        'as' => 'password.email',
        'uses' => 'Api\PasswordController@postEmail'
    ]);

    Route::post('user/settings', [
        'as' => 'user.settings',
        'uses' => 'Api\UserSettingsController@userSettings'
    ]);

    Route::post('user/feedlist', [
        'as' => 'feeds.list',
        'uses' => 'Api\FeedController@userFeeds'
    ]);

    Route::post('social/facebookLogin', [
        'as' => 'facebook.login',
        'uses' => 'Api\SocialController@facebookLogin'
    ]);

    Route::post('feeds/create', [
        'as' => 'feeds.create',
        'uses' => 'Api\FeedController@createFeeds'
    ]);

    Route::post('feeds/list', [
        'as' => 'feeds.list',
        'uses' => 'Api\FeedController@listFeeds'
    ]);

    Route::post('feeds/feedDetails', [
        'as' => 'feeds.details',
        'uses' => 'Api\FeedController@feedsDetails'
    ]);

    Route::post('feeds/claps', [
        'as' => 'feeds.clap',
        'uses' => 'Api\FeedController@clapFeed'
    ]);

    Route::post('feeds/comments', [
        'as' => 'feeds.comments',
        'uses' => 'Api\FeedController@loadComments'
    ]);

    Route::post('follow/add', [
        'as' => 'follow.add',
        'uses' => 'Api\UserFollowsController@follow'
    ]);
    
    Route::post('follow/unfollow', [
        'as' => 'follow.unfollow',
        'uses' => 'Api\UserFollowsController@unFollow'
    ]);
    
    Route::post('follow/get', [
        'as' => 'follow.get',
        'uses' => 'Api\UserFollowsController@getFollowers'
    ]);
    
    Route::post('follow/follows', [
        'as' => 'follow.follows',
        'uses' => 'Api\UserFollowsController@getMyFollowings'
    ]);
});

// Authentication routes...
Route::get('auth/login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'login_path'
]);

Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/admin', ['middleware' => 'auth', function () {
        return view('home');
    }]);

Route::get('/', function () {
    return view('welcome');
});
