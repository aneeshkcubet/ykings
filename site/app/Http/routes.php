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

    //UsersController
    Route::post('user', [
        'as' => 'user.signup',
        'uses' => 'Api\UsersController@postRegister'
    ]);
    
    //UsersController
    Route::post('user/history/recent', [
        'as' => 'user.history.recent',
        'uses' => 'Api\UsersController@getUserRecentHistory'
    ]);
    
    //UsersController
    Route::post('user/history/exercise', [
        'as' => 'user.history.exercise',
        'uses' => 'Api\UsersController@getUserExerciseHistory'
    ]);
    
    //UsersController
    Route::post('user/history/workout', [
        'as' => 'user.history.workout',
        'uses' => 'Api\UsersController@getUserWorkoutHistory'
    ]);
    
    //UsersController
    Route::post('user/history/hiit', [
        'as' => 'user.history.hiit',
        'uses' => 'Api\UsersController@getUserHiitHistory'
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

    Route::post('social/facebookDisconnect', [
        'as' => 'facebook.disconnect',
        'uses' => 'Api\SocialController@facebookDisconnect'
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
    Route::post('feeds/notification', [
        'as' => 'feeds.notification',
        'uses' => 'Api\FeedController@notification'
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

    Route::post('workout/addstar', [
        'as' => 'workout.addstar',
        'uses' => 'Api\WorkoutsController@addStar'
    ]);

    //SearchController
    Route::post('/search/searchUser', [
        'as' => 'user.search',
        'uses' => 'Api\SearchController@userSearch'
    ]);
    //UserSettingsController
    Route::post('user/settings', [
        'as' => 'user.settings',
        'uses' => 'Api\UserSettingsController@userSettings'
    ]);
    Route::post('/user/getsettings', [
        'as' => 'user.getsettings',
        'uses' => 'Api\UserSettingsController@getUserSettings'
    ]);
    Route::post('/user/updateDeviceToken', [
        'as' => 'user.updateDeviceToken',
        'uses' => 'Api\UserSettingsController@updateDeviceToken'
    ]);
    //SkillsController
    Route::post('/skills/list', [
        'as' => 'skill.list',
        'uses' => 'Api\SkillsController@loadSkills'
    ]);

    Route::post('/skills/getlevelskills', [
        'as' => 'skill.getlevelskills',
        'uses' => 'Api\SkillsController@getLevelSkills'
    ]);

    Route::post('/skills/lockskill', [
        'as' => 'skill.lockskill',
        'uses' => 'Api\SkillsController@lockSkill'
    ]);

    Route::post('/skills/unlockskill', [
        'as' => 'skill.unlockskill',
        'uses' => 'Api\SkillsController@unlockSkill'
    ]);

    Route::post('/coach/getfundumentals', [
        'as' => 'coach.getfundumentals',
        'uses' => 'Api\CoachesController@getFundumentals'
    ]);

    Route::post('/coach/getdescription', [
        'as' => 'coach.getdescription',
        'uses' => 'Api\CoachesController@getDescription'
    ]);


    Route::post('/coach/preparecoach', [
        'as' => 'coach.preparecoach',
        'uses' => 'Api\CoachesController@prepareCoach'
    ]);
    
    Route::post('/coach/get', [
        'as' => 'coach.get',
        'uses' => 'Api\CoachesController@getCoach'
    ]);
    
    Route::post('/coach/finishday', [
        'as' => 'coach.finishday',
        'uses' => 'Api\CoachesController@finishCoachDayWorkouts'
    ]);
    
    Route::post('/coach/update', [
        'as' => 'coach.update',
        'uses' => 'Api\CoachesController@updateCoach'
    ]);

    //MessageController
    Route::post('/user/listNotifications', [
        'as' => 'user.listNotifications',
        'uses' => 'Api\MessageController@listNotifications'
    ]);
    Route::post('/message/updateReadStatus', [
        'as' => 'message.updateReadStatus',
        'uses' => 'Api\MessageController@updateReadStatus'
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
//Admin Routes
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [
        'as' => 'admin.index',
        'uses' => 'Admin\AdminController@index'
    ]);
    Route::get('/login', [
        'as' => 'admin.getlogin',
        'uses' => 'Admin\AdminController@getLogin'
    ]);
    Route::post('/login', [
        'as' => 'admin.postlogin',
        'uses' => 'Admin\AdminController@postLogin'
    ]);
    Route::get('/logout', [
        'as' => 'admin.logout',
        'uses' => 'Admin\AdminController@logout'
    ]);

    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'admin.users', 'uses' => 'Admin\UsersController@getIndex'));
        
        Route::get('create', array('as' => 'admin.user.create', 'uses' => 'Admin\UsersController@getCreate'));
        
        Route::post('create', array('as' => 'admin.user.postcreate', 'uses'=>'Admin\UsersController@postCreate'));
        
        Route::get('{userId}/edit', array('as' => 'admin.user.update', 'uses' => 'Admin\UsersController@getEdit'));
        
        Route::post('{userId}/edit', array('as' => 'admin.user.postedit', 'uses'=>'Admin\UsersController@postEdit'));
        
        Route::get('{userId}', array('as' => 'admin.user.show', 'uses' => 'Admin\UsersController@show'));
        
        Route::get('{userId}/delete', array('as' => 'admin.user.delete', 'uses' => 'Admin\UsersController@getDelete'));
        
        Route::get('{userId}/confirm-delete', array('as' => 'admin.confirm-delete.user', 'uses' => 'Admin\UsersController@getModalDelete'));
        
        Route::get('{userId}/setfeatured', array('as' => 'admin.user.setfeatured', 'uses' => 'Admin\UsersController@setFeatured'));
        
        Route::get('{userId}/unsetfeatured', array('as' => 'admin.user.unsetfeatured', 'uses' => 'Admin\UsersController@unsetFeatured'));
    });

    # Exercise Management
    Route::group(array('prefix' => 'exercise'), function () {
        Route::get('/', array('as' => 'admin.exercises', 'uses' => 'Admin\ExerciseController@getIndex'));
        Route::get('create', array('as' => 'admin.exercise.create', 'uses' => 'Admin\ExerciseController@getCreate'));
        Route::post('create', 'Admin\ExerciseController@postCreate');
        Route::get('{exerciseId}/edit', array('as' => 'admin.exercise.update', 'uses' => 'Admin\ExerciseController@getEdit'));
        Route::post('{exerciseId}/edit', 'Admin\ExerciseController@postEdit');
        Route::get('{exerciseId}', array('as' => 'admin.exercise.show', 'uses' => 'Admin\ExerciseController@show'));
        Route::get('{exerciseId}/delete', array('as' => 'admin.exercise.delete', 'uses' => 'Admin\ExerciseController@getDelete'));
        Route::get('{exerciseId}/confirm-delete', array('as' => 'admin.confirm-delete.exercise', 'uses' => 'Admin\ExerciseController@getModalDelete'));
    });
    
    # Workout Management
    Route::group(array('prefix' => 'workout'), function () {
        Route::get('/', array('as' => 'admin.workouts', 'uses' => 'Admin\WorkoutController@getIndex'));
        Route::get('create', array('as' => 'admin.workout.create', 'uses' => 'Admin\WorkoutController@getCreate'));
        Route::post('create', 'Admin\WorkoutController@postCreate');
        Route::get('{workoutId}/edit', array('as' => 'admin.workout.update', 'uses' => 'Admin\WorkoutController@getEdit'));
        Route::post('{workoutId}/edit', 'Admin\WorkoutController@postEdit');
        Route::get('{workoutId}', array('as' => 'admin.workout.show', 'uses' => 'Admin\WorkoutController@show'));
        Route::get('{workoutId}/delete', array('as' => 'admin.workout.delete', 'uses' => 'Admin\WorkoutController@getDelete'));
        Route::get('{workoutId}/confirm-delete', array('as' => 'admin.confirm-delete.workout', 'uses' => 'Admin\WorkoutController@getModalDelete'));
    });
});
