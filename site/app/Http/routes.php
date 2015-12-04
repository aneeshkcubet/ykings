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
    //UsersController
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
    Route::post('user/logout', [
        'as' => 'user.logout',
        'uses' => 'Api\UsersController@logout'
    ]);
    Route::post('user/resendverify', [
        'as' => 'user.resendverify',
        'uses' => 'Api\UsersController@resendVerifyEmail'
    ]);
    //UserVideosController
    Route::post('user/videos', [
        'as' => 'user.videos',
        'uses' => 'Api\UserVideosController@GetUserVideos'
    ]);
    Route::post('user/video/delete', [
        'as' => 'user.video.delete',
        'uses' => 'Api\UserVideosController@deleteUserVideo'
    ]);
    //UserSettingsController
    Route::post('user/settings', [
        'as' => 'user.settings',
        'uses' => 'Api\UserSettingsController@userSettings'
    ]);
    //UsersController
    Route::post('user', [
        'as' => 'user.signup',
        'uses' => 'Api\UsersController@postRegister'
    ]);
    Route::get('verify', [
        'as' => 'confirmation_path',
        'uses' => 'Api\UsersController@confirm'
    ]);
    //PasswordController
    Route::post('password/email', [
        'as' => 'password.email',
        'uses' => 'Api\PasswordController@postEmail'
    ]);
    //SocialController
    Route::post('/social/facebookSignUp', [
        'as' => 'facebook.signup',
        'uses' => 'Api\SocialController@facebookSignUp'
    ]);

    Route::post('social/facebookLogin', [
        'as' => 'facebook.login',
        'uses' => 'Api\SocialController@facebookLogin'
    ]);
    Route::post('social/facebookUpdate', [
        'as' => 'facebook.update',
        'uses' => 'Api\SocialController@facebookUpdate'
    ]);
    //FeedController
    Route::post('feeds/create', [
        'as' => 'feeds.create',
        'uses' => 'Api\FeedController@createFeeds'
    ]);
    Route::post('user/feedlist', [
        'as' => 'feeds.list',
        'uses' => 'Api\FeedController@userFeeds'
    ]);
    Route::post('feeds/list', [
        'as' => 'feeds.list',
        'uses' => 'Api\FeedController@listFeeds'
    ]);
    Route::post('feeds/feedDetails', [
        'as' => 'feeds.details',
        'uses' => 'Api\FeedController@feedsDetails'
    ]);
    Route::post('feeds/clap', [
        'as' => 'feeds.clap',
        'uses' => 'Api\FeedController@clapFeed'
    ]);
    Route::post('feeds/unclap', [
        'as' => 'feeds.unclap',
        'uses' => 'Api\FeedController@unclapFeed'
    ]);
    //CommentsController
    Route::post('feeds/comments', [
        'as' => 'feeds.comments',
        'uses' => 'Api\CommentsController@loadComments'
    ]);

    Route::post('feeds/addComment', [
        'as' => 'feeds.addComment',
        'uses' => 'Api\CommentsController@addFeedComment'
    ]);
    Route::post('feeds/deleteComment', [
        'as' => 'feeds.comments',
        'uses' => 'Api\CommentsController@deleteComment'
    ]);
    //UserFollowsController
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
    //UserFriendsController
    Route::post('connect/connectFriends', [
        'as' => 'connect.phone',
        'uses' => 'Api\UserFriendsController@connectFriends'
    ]);
    Route::post('connect/inviteFriends', [
        'as' => 'connect.invite',
        'uses' => 'Api\UserFriendsController@inviteFriends'
    ]);
    //SubscriptionsController
    Route::post('subscription/update', [
        'as' => 'subscription.update',
        'uses' => 'Api\SubscriptionsController@updateSubscription'
    ]);
    //ExercisesController
    Route::post('exercise/list', [
        'as' => 'exercise.list',
        'uses' => 'Api\ExercisesController@loadExercises'
    ]);

    Route::post('exercise/get', [
        'as' => 'exercise.get',
        'uses' => 'Api\ExercisesController@getExercise'
    ]);

    Route::post('exercise/getwithusers', [
        'as' => 'exercise.get',
        'uses' => 'Api\ExercisesController@getExerciseWithUsers'
    ]);
    //WorkoutsController
    Route::post('workout/list', [
        'as' => 'workout.list',
        'uses' => 'Api\WorkoutsController@loadWorkouts'
    ]);

    Route::post('workout/getlevels', [
        'as' => 'workout.getlevels',
        'uses' => 'Api\WorkoutsController@getWorkoutWithLevels'
    ]);
    Route::post('workout/getexercises', [
        'as' => 'workout.getexercises',
        'uses' => 'Api\WorkoutsController@getWorkoutWithExercises'
    ]);
    //SearchController
    Route::post('/search/searchUser', [
        'as' => 'user.search',
        'uses' => 'Api\SearchController@userSearch'
    ]);
    //UserSettingsController
    Route::post('/user/getsettings', [
        'as' => 'user.getsettings',
        'uses' => 'Api\UserSettingsController@getUserSettings'
    ]);
    Route::post('/user/getsettings', [
        'as' => 'user.getsettings',
        'uses' => 'Api\UserSettingsController@getUserSettings'
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
