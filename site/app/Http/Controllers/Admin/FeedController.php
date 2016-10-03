<?php

namespace App\Http\Controllers\Admin;

use Validator,
    Hash,
    Mail,
    Auth,
    Image,
    Redirect,
    DB,
    Input,
    Lang;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Settings;
use App\User;
use App\Profile;
use App\Feeds;
use App\Images;
use App\Clap;
use App\Comment;
use App\Exerciseuser;
use App\Workoutuser;
use App\Follow;
use App\Workout;
use App\Exercise;
use App\Hiit;
use App\Hiituser;
use Yajra\Datatables\Datatables;

class FeedController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Feed Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles feeds,workout,exercise.
      |
     */

    public function __construct() {
        $this->middleware('admin');
    }

    public function getIndex() {
        $feeds = array();
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        return View('admin.feed.index', compact('feeds', 'user'));
    }

    public function anyData() {
        $feeds = DB::table('feeds')
                ->join('user_profiles', 'feed.user_id', '=', 'user_profiles.user_id')
                ->select(['feeds.id,feeds.feed_text,user_profiles.user_id', 'user_profiles.first_name', 'user_profiles.last_name', 'user_profiles.image', 'user_profiles.quote', 'user_profiles.gender']);

        return Datatables::of(Feeds::with(['profile']))
                        ->edit_column('image', function ($list) {
                            if (!empty($list->image)) {
                                return '<img width="50" height="50" src="/uploads/images/feed/small/' . $list->image . '" />';
                            } else {
                                return '<img width="50" height="50" src="/img/feed_placeholder.png" />';
                            }
                        })
                        ->edit_column('comments', function ($comments) {
                            $feeds = $this->AdditionalFeedsDetailsTest($comments);


                            if ($feeds["comment_count"] > 0) {
                                $htmlComments = '<table class="table table-bordered" width="100%">
                                              <thead>
                                              <tr class="filters">
                                              <th width="70%">Comment</th>
                                              <th width="20%">Author</th>
                                              <th width="10%">Actions</th>
                                              </tr></thead><tbody>';

                                foreach ($feeds["comments"] AS $feedsVals) {
                                    $htmlComments.=
                                            '<tr>'
                                            . '<td>' .
                                            $feedsVals['comment_text'] .
                                            '</td>
                                               <td>
                                              <a href="" title=' . $feedsVals['profile']['first_name'] . $feedsVals['profile']['last_name'] . '>';
                                    if ($feedsVals['profile']['image'] != '') {
                                        $htmlComments.=' <img width="30" height="30" src="/uploads/images/profile/small/' . $feedsVals['profile']['image'] . '" />';
                                    } else {
                                        if ($feedsVals['profile']['gender'] < 2) {
                                            $htmlComments.='<img width="30" height="30" src="/img/avatar04.png" />';
                                        } else {
                                            $htmlComments.='<img width="30" height="30" src="/img/avatar3.png" />';
                                        }
                                    }

                                    $htmlComments .='<br/>' . $feedsVals['profile']['first_name'] . $feedsVals['profile']['last_name'] . '
                                      </a>
                                      </td>
                                      <td>
                                         <a href=\'' . route("admin.feed.comment.delete", $feedsVals['id']) . '\' data-toggle="modal" data-target="#delete_confirm">
                                            <i class="glyphicon glyphicon-remove" >
                                            </i>
                                        </a>
                                       </td>
                                      </tr>';
                                }
                                $htmlComments .= "</tbody></table>";
                            } else {
                                $htmlComments = 'No Comments';
                            }
                            return $htmlComments;
                        })
                        ->edit_column('author', function($author) {
                            $htmlAuthor = ' <a href="" title="' . $author['profile']['first_name'] . " " . $author['profile']['last_name'] . '">';
                            if ($author['profile']['image'] != '') {
                                $htmlAuthor.='<img width="50" height="50" src="/uploads/images/profile/small/' . $author['profile']['image'] . '" />';
                            } else {
                                if ($author['profile']['gender'] < 2) {
                                    $htmlAuthor.='<img width="30" height="30" src="/img/avatar04.png" />';
                                } else {
                                    $htmlAuthor.='<img width="30" height="30" src="/img/avatar3.png" />';
                                }
                            }
                            $htmlAuthor.=' <br />
                             ' . $author['profile']['first_name'] . $author['profile']['last_name'] . '
                                </a>';
                            return $htmlAuthor;
                        })
                        ->edit_column('claps', function($claps) {
                            return Clap::clapCount($claps->id, 'feed');
                        })
                        ->add_column('action', function($action) {
                            $htmlActions = '<td>                                               
                                            <a href=\'' . route("admin.confirm-delete.feed", $action['id']) . '\' data-toggle="modal" data-target="#delete_confirm">
                                            <i class="glyphicon glyphicon-remove" data-name="comment-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete comment.">
                                            </i>
                                            </a>
                                            </td></tr></tbody></table>';
                            return $htmlActions;
                        })
                        ->blacklist(['action', 'claps', 'comments', 'author'])
                        ->make(true);
    }

    /**
     * $htmlComments.='</td><td>                                               
      <a href="' . $feeds['id'] . '/confirm-delete-feed" data-toggle="modal" data-target="#delete_confirm">
      <i class="glyphicon glyphicon-remove" data-name="comment-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete comment.">
      </i>
      </a>
      </td></tr></tbody></table>';
     */
//    public function getIndex()
//    {
//        $feeds = Feeds::with(['profile'])->orderBy('created_at', 'DESC')->get();
//
//
//
//        if (count($feeds) > 0) {
//            $feeds = $this->AdditionalFeedsDetails($feeds);
//        }
//
////        echo '<pre>';
////        print_r($feeds->toArray());
////        die;
//
//
//        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
//        // Show the page
//        return View('admin.feed.index', compact('feeds', 'user'));
//    }

    /**
     * Function to get additional parameters in feeds.
     * @since 19/11/2015
     * @author ansa@cubettech.com
     * @return json
     */
    protected function AdditionalFeedsDetails($feeds) {
        foreach ($feeds as $fKey => $feed) {
//Clap count
            $feed->clap_count = Clap::clapCount($feed->id, 'feed');

//comments count
            $feed->comment_count = Comment::commentCount($feed->id, 'feed');

            $comments = Comment::where('parent_id', '=', $feed->id)
                    ->where('parent_type', 'feed')
                    ->orderBy('created_at', 'DESC')
                    ->with(['profile'])
                    ->get();


            $feed->comments = $comments->toArray();


            $image = Images::where('parent_id', $feed->id)->where('parent_type', '=', 2)->get();

            $feed->image = $image->toArray();

//To get Category
            if ($feed->item_type == 'workout') {

                $workout = Workout::where('id', '=', $feed->item_id)->first();

                if (!is_null($workout)) {
                    if ($workout->category == 1) {
                        $feed->category = "Strength";
                    } elseif ($workout->category == 2) {
                        $feed->category = "Cardio-strength";
                    }
                } else {
                    $feed->category = "";
                }
                $feed->item_name = $workout->name;

                $workoutUser = DB::table('workout_users')
                        ->where('feed_id', $feed->id)
                        ->first();

                if (!is_null($workoutUser)) {
                    $feed->duration = $workoutUser->time;
                    if ($workoutUser->is_coach == 1) {
                        if ($workoutUser->coach_rounds == $workout->rounds) {
                            $feed->intensity = 1;
                        } elseif ($workoutUser->coach_rounds > $workout->rounds) {
                            if (($workoutUser->coach_rounds % $workout->rounds) == 0) {
                                $feed->intensity = $workoutUser->coach_rounds / $workout->rounds;
                            } else {
                                $feed->intensity = ($workoutUser->coach_rounds / $workout->rounds) + 1;
                            }
                        }
                    } else {
                        $feed->intensity = $workoutUser->volume;
                    }
                } else {
                    $feed->duration = 0;
                }
            } elseif ($feed->item_type == 'exercise') {

                $exercise = Exercise::where('id', '=', $feed->item_id)->first();
                if (!is_null($exercise)) {
                    if ($exercise->category == 1) {
                        $feed->category = "Lean";
                    } elseif ($exercise->category == 2) {
                        $feed->category = "Athletic";
                    } elseif ($exercise->category == 3) {
                        $feed->category = "Strength";
                    }
                } else {
                    $feed->category = "";
                }
                $feed->item_name = $exercise->name;

                $exerciseUser = DB::table('exercise_users')
                        ->where('feed_id', $feed->id)
                        ->first();

                if (!is_null($exerciseUser)) {
                    $feed->duration = $exerciseUser->time;
                    $feed->intensity = $exerciseUser->volume;
                } else {
                    $feed->duration = 0;
                }
                $feed->unit = $exercise->unit;
            } elseif ($feed->item_type == 'hiit') {

                $hiit = Hiit::where('id', '=', $feed->item_id)->first();
                $feed->item_name = $hiit->name;

                $hiitUser = DB::table('hiit_users')
                        ->where('feed_id', $feed->id)
                        ->first();

                if (!is_null($hiitUser)) {
                    $feed->duration = $hiitUser->time;
                    $feed->intensity = $hiitUser->volume;
                } else {
                    $feed->duration = 0;
                }
            } else {
                $feed->category = "";
                $feed->item_name = "";
            }
            $feeds[$fKey] = $feed;
        }

        return $feeds;
    }

    protected function AdditionalFeedsDetailsTest($feed) {
// foreach ($feeds as $fKey => $feed) {
//Clap count
        $feed->clap_count = Clap::clapCount($feed->id, 'feed');

//comments count
        $feed->comment_count = Comment::commentCount($feed->id, 'feed');

        $comments = Comment::where('parent_id', '=', $feed->id)
                ->where('parent_type', 'feed')
                ->orderBy('created_at', 'DESC')
                ->with(['profile'])
                ->get();


        $feed->comments = $comments->toArray();


        $image = Images::where('parent_id', $feed->id)->where('parent_type', '=', 2)->get();

        $feed->image = $image->toArray();

//To get Category
        if ($feed->item_type == 'workout') {

            $workout = Workout::where('id', '=', $feed->item_id)->first();

            if (!is_null($workout)) {
                if ($workout->category == 1) {
                    $feed->category = "Strength";
                } elseif ($workout->category == 2) {
                    $feed->category = "Cardio-strength";
                }
            } else {
                $feed->category = "";
            }
            $feed->item_name = $workout->name;

            $workoutUser = DB::table('workout_users')
                    ->where('feed_id', $feed->id)
                    ->first();

            if (!is_null($workoutUser)) {
                $feed->duration = $workoutUser->time;
                if ($workoutUser->is_coach == 1) {
                    if ($workoutUser->coach_rounds == $workout->rounds) {
                        $feed->intensity = 1;
                    } elseif ($workoutUser->coach_rounds > $workout->rounds) {
                        if (($workoutUser->coach_rounds % $workout->rounds) == 0) {
                            $feed->intensity = $workoutUser->coach_rounds / $workout->rounds;
                        } else {
                            $feed->intensity = ($workoutUser->coach_rounds / $workout->rounds) + 1;
                        }
                    }
                } else {
                    $feed->intensity = $workoutUser->volume;
                }
            } else {
                $feed->duration = 0;
            }
        } elseif ($feed->item_type == 'exercise') {

            $exercise = Exercise::where('id', '=', $feed->item_id)->first();
            if (!is_null($exercise)) {
                if ($exercise->category == 1) {
                    $feed->category = "Lean";
                } elseif ($exercise->category == 2) {
                    $feed->category = "Athletic";
                } elseif ($exercise->category == 3) {
                    $feed->category = "Strength";
                }
            } else {
                $feed->category = "";
            }
            $feed->item_name = $exercise->name;

            $exerciseUser = DB::table('exercise_users')
                    ->where('feed_id', $feed->id)
                    ->first();

            if (!is_null($exerciseUser)) {
                $feed->duration = $exerciseUser->time;
                $feed->intensity = $exerciseUser->volume;
            } else {
                $feed->duration = 0;
            }
            $feed->unit = $exercise->unit;
        } elseif ($feed->item_type == 'hiit') {

            $hiit = Hiit::where('id', '=', $feed->item_id)->first();
            $feed->item_name = $hiit->name;

            $hiitUser = DB::table('hiit_users')
                    ->where('feed_id', $feed->id)
                    ->first();

            if (!is_null($hiitUser)) {
                $feed->duration = $hiitUser->time;
                $feed->intensity = $hiitUser->volume;
            } else {
                $feed->duration = 0;
            }
        } else {
            $feed->category = "";
            $feed->item_name = "";
        }
//$feeds[$fKey] = $feed;
//  }

        return $feed;
    }

    /**
     * Feed Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null) {
        $feed = Feeds::where('id', $id)->first();

        if (is_null($feed)) {

            $error = 'Feed does not exists!!';

            Redirect::route("admin.feeds")->with('error', $error);
        }

        Feeds::where('id', $id)->delete();

        Comment::where('parent_id', $id)->where('parent_type', '=', 'feed')->delete();

        Images::where('parent_id', $id)->where('parent_type', '=', 2)->delete();

        return Redirect::route("admin.feeds")->with('success', 'Successfully deleted feed.');
    }

    /**
     * Feed Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null) {
        $model = 'feeds';

        $confirm_route = $error = null;

        $entity = 'feed';

        $feed = Feeds::where('id', $id)->first();

        if (is_null($feed)) {
            $error = 'Feed does not exists!!';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.feed.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }

    /**
     * Feed Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCommentDelete($id = null) {
        $comment = Comment::where('id', $id)->first();

        if (is_null($comment)) {

            $error = 'Comment does not exists!!';

            Redirect::route("admin.feeds")->with('error', $error);
        }

        Comment::where('id', $id)->delete();


        return Redirect::route("admin.feeds")->with('success', 'Successfully deleted comment.');
    }

}
