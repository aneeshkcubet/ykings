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
    
    Route::post('user/options/goaloptions', [
        'as' => 'user.options.goaloptions',
        'uses' => 'Api\UsersController@getUserGoalOptions'
    ]);
    
    Route::post('user/options/updategoaloptions', [
        'as' => 'user.options.updategoaloptions',
        'uses' => 'Api\UsersController@updateUserGoalOptions'
    ]);
    
    Route::post('user/options/physiqueoptions', [
        'as' => 'user.options.physiqueoptions',
        'uses' => 'Api\UsersController@getUserPhysiqueOptions'
    ]);
    
    Route::post('user/options/updatephysiqueoptions', [
        'as' => 'user.options.updatephysiqueoptions',
        'uses' => 'Api\UsersController@updateUserPhysiqueOptions'
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
    
    Route::post('coach/getmusclegroups', [
        'as' => 'coach.getmusclegroups',
        'uses' => 'Api\CoachesController@getMuscleGroups'
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

        Route::post('create', array('as' => 'admin.user.postcreate', 'uses' => 'Admin\UsersController@postCreate'));

        Route::get('{userId}/edit', array('as' => 'admin.user.update', 'uses' => 'Admin\UsersController@getEdit'));

        Route::post('{userId}/edit', array('as' => 'admin.user.postedit', 'uses' => 'Admin\UsersController@postEdit'));

        Route::get('{userId}', array('as' => 'admin.user.show', 'uses' => 'Admin\UsersController@show'));

        Route::get('{userId}/delete', array('as' => 'admin.user.delete', 'uses' => 'Admin\UsersController@getDelete'));

        Route::get('{userId}/confirm-delete-user', array('as' => 'admin.confirm-delete.user', 'uses' => 'Admin\UsersController@getModalDelete'));

        Route::get('{userId}/setfeatured', array('as' => 'admin.user.setfeatured', 'uses' => 'Admin\UsersController@setFeatured'));

        Route::get('{userId}/unsetfeatured', array('as' => 'admin.user.unsetfeatured', 'uses' => 'Admin\UsersController@unsetFeatured'));
    });

    # Exercise Management
    Route::group(array('prefix' => 'exercises'), function () {
        Route::get('/', array('as' => 'admin.exercises', 'uses' => 'Admin\ExerciseController@getIndex'));

        Route::get('create', array('as' => 'admin.exercise.create', 'uses' => 'Admin\ExerciseController@getCreate'));

        Route::post('create', array('as' => 'admin.exercise.postcreate', 'uses' => 'Admin\ExerciseController@postCreate'));

        Route::get('{exerciseId}/edit', array('as' => 'admin.exercise.edit', 'uses' => 'Admin\ExerciseController@getEdit'));

        Route::post('{exerciseId}/edit', array('as' => 'admin.exercise.postedit', 'uses' => 'Admin\ExerciseController@postEdit'));

        Route::get('{exerciseId}', array('as' => 'admin.exercise.show', 'uses' => 'Admin\ExerciseController@show'));

        Route::get('{exerciseId}/delete', array('as' => 'admin.exercise.delete', 'uses' => 'Admin\ExerciseController@getDelete'));

        Route::get('{exerciseId}/confirm-delete-exercise', array('as' => 'admin.confirm-delete.exercise', 'uses' => 'Admin\ExerciseController@getModalDelete'));
    });
    
    # HIIT Management
    Route::group(array('prefix' => 'hiits'), function () {
        Route::get('/', array('as' => 'admin.hiits', 'uses' => 'Admin\HiitController@getIndex'));

        Route::get('create', array('as' => 'admin.hiit.create', 'uses' => 'Admin\HiitController@getCreate'));

        Route::post('create', array('as' => 'admin.hiit.postcreate', 'uses' => 'Admin\HiitController@postCreate'));

        Route::get('{hiitId}/edit', array('as' => 'admin.hiit.edit', 'uses' => 'Admin\HiitController@getEdit'));

        Route::post('{hiitId}/edit', array('as' => 'admin.hiit.postedit', 'uses' => 'Admin\HiitController@postEdit'));

        Route::get('{hiitId}', array('as' => 'admin.hiit.show', 'uses' => 'Admin\HiitController@show'));

        Route::get('{hiitId}/delete', array('as' => 'admin.hiit.delete', 'uses' => 'Admin\HiitController@getDelete'));

        Route::get('{hiitId}/confirm-delete-hiit', array('as' => 'admin.confirm-delete.hiit', 'uses' => 'Admin\HiitController@getModalDelete'));
    });

    # Workout Management
    Route::group(array('prefix' => 'workouts'), function () {

        Route::get('/', array('as' => 'admin.workouts', 'uses' => 'Admin\WorkoutController@getIndex'));

        Route::get('create', array('as' => 'admin.workout.create', 'uses' => 'Admin\WorkoutController@getCreate'));

        Route::post('create', array('as' => 'admin.workout.postcreate', 'uses' => 'Admin\WorkoutController@postCreate'));

        Route::get('{workoutId}/edit', array('as' => 'admin.workout.edit', 'uses' => 'Admin\WorkoutController@getEdit'))->where('workoutId', '[0-9]+');

        Route::post('{workoutId}/edit', array('as' => 'admin.workout.postedit', 'uses' => 'Admin\WorkoutController@postEdit'))->where('workoutId', '[0-9]+');

        Route::get('{workoutId}', array('as' => 'admin.workout.show', 'uses' => 'Admin\WorkoutController@show'))->where('workoutId', '[0-9]+');

        Route::get('{workoutId}/delete', array('as' => 'admin.workout.delete', 'uses' => 'Admin\WorkoutController@getDelete'))->where('workoutId', '[0-9]+');

        Route::get('{workoutId}/confirm-delete-workout', array('as' => 'admin.confirm-delete.workout', 'uses' => 'Admin\WorkoutController@getModalDelete'))->where('workoutId', '[0-9]+');

        #Workout Exercise Management        
        Route::get('workoutexercise/create/{workoutId}', array('as' => 'admin.workout.workoutexercise.create', 'uses' => 'Admin\WorkoutController@getExerciseCreate'));

        Route::post('workoutexercise/create/{workoutId}', array('as' => 'admin.workout.workoutexercise.postcreate', 'uses' => 'Admin\WorkoutController@postExerciseCreate'));

        Route::get('workoutexercise/{workoutExerciseId}/edit', array('as' => 'admin.workout.workoutexercise.edit', 'uses' => 'Admin\WorkoutController@getExerciseEdit'));

        Route::post('workoutexercise/{workoutExerciseId}/edit', array('as' => 'admin.workout.workoutexercise.postedit', 'uses' => 'Admin\WorkoutController@postExerciseEdit'));

        Route::get('workoutexercise/{workoutExerciseId}/delete', array('as' => 'admin.workout.workoutexercise.delete', 'uses' => 'Admin\WorkoutController@getExerciseDelete'));
    });
    
    # Skill Management
    Route::group(array('prefix' => 'skills'), function () {
        Route::get('/', array('as' => 'admin.skills', 'uses' => 'Admin\SkillController@getIndex'));

        Route::get('create', array('as' => 'admin.skill.create', 'uses' => 'Admin\SkillController@getCreate'));

        Route::post('create', array('as' => 'admin.skill.postcreate', 'uses' => 'Admin\SkillController@postCreate'));

        Route::get('{skillId}/edit', array('as' => 'admin.skill.edit', 'uses' => 'Admin\SkillController@getEdit'));

        Route::post('{skillId}/edit', array('as' => 'admin.skill.postedit', 'uses' => 'Admin\SkillController@postEdit'));

        Route::get('{skillId}', array('as' => 'admin.skill.show', 'uses' => 'Admin\SkillController@show'));

        Route::get('{skillId}/delete', array('as' => 'admin.skill.delete', 'uses' => 'Admin\SkillController@getDelete'));

        Route::get('{skillId}/confirm-delete-skill', array('as' => 'admin.confirm-delete.skill', 'uses' => 'Admin\SkillController@getModalDelete'));
    });
    
    # Feed Management
    Route::group(array('prefix' => 'feeds'), function () {
        Route::get('/', array('as' => 'admin.feeds', 'uses' => 'Admin\FeedController@getIndex'));

        Route::get('{feedId}', array('as' => 'admin.feed.edit', 'uses' => 'Admin\FeedController@getEdit'));

        Route::post('{feedId}/edit', array('as' => 'admin.feed.postedit', 'uses' => 'Admin\FeedController@postEdit'));

        Route::get('{feedId}/delete', array('as' => 'admin.feed.delete', 'uses' => 'Admin\FeedController@getDelete'));

        Route::get('{feedId}/confirm-delete-feed', array('as' => 'admin.confirm-delete.feed', 'uses' => 'Admin\FeedController@getModalDelete'));
        
        Route::get('comment/{commentId}/edit', array('as' => 'admin.feed.comment.edit', 'uses' => 'Admin\FeedController@getEdit'));

        Route::post('comment/{commentId}/edit', array('as' => 'admin.feed.comment.postedit', 'uses' => 'Admin\FeedController@postEdit'));

        Route::get('comment/{commentId}/delete', array('as' => 'admin.feed.comment.delete', 'uses' => 'Admin\FeedController@getCommentDelete'));
    });
    
    # Coach Management
    Route::group(array('prefix' => 'coaches'), function () {
        Route::get('/', array('as' => 'admin.coaches', 'uses' => 'Admin\CoachController@getIndex'));
        
        Route::get('{coachId}', array('as' => 'admin.coach.delete', 'uses' => 'Admin\CoachController@getDelete'));

        Route::get('{coachId}/delete', array('as' => 'admin.coach.delete', 'uses' => 'Admin\CoachController@getDelete'));

        Route::get('{coachId}/confirm-delete-coach', array('as' => 'admin.confirm-delete.coach', 'uses' => 'Admin\CoachController@getModalDelete'));

    });
    
    # Warmup Exercise Management
    Route::group(array('prefix' => 'warmups'), function () {
        Route::get('/', array('as' => 'admin.warmups', 'uses' => 'Admin\WarmupController@getIndex'));

        Route::get('create', array('as' => 'admin.warmup.create', 'uses' => 'Admin\WarmupController@getCreate'));

        Route::post('create', array('as' => 'admin.warmup.postcreate', 'uses' => 'Admin\WarmupController@postCreate'));

        Route::get('{warmupId}/edit', array('as' => 'admin.warmup.edit', 'uses' => 'Admin\WarmupController@getEdit'));

        Route::post('{warmupId}/edit', array('as' => 'admin.warmup.postedit', 'uses' => 'Admin\WarmupController@postEdit'));

        Route::get('{warmupId}', array('as' => 'admin.warmup.show', 'uses' => 'Admin\WarmupController@show'));

        Route::get('{warmupId}/delete', array('as' => 'admin.warmup.delete', 'uses' => 'Admin\WarmupController@getDelete'));

        Route::get('{warmupId}/confirm-delete-warmup', array('as' => 'admin.confirm-delete.warmup', 'uses' => 'Admin\WarmupController@getModalDelete'));
    });
});
