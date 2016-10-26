<?php namespace App\Http\Controllers\Admin;

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
use App\Media;
use App\User;
use Yajra\Datatables\Datatables;

class MediaController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * User index page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getIndex()
    {
        // Grab all the users
        $medias = Media::all();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        // Show the page
        return View('admin.media.index', compact('medias', 'user'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $posts = Media::select('medias.*');
        return Datatables::of($posts)
                ->addColumn('action', function ($list) {
                    $html = '<a href="' . route('admin.media.show', $list->id) . '"><i class="glyphicon glyphicon-eye-open" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Media Details"></i></a>'
                        . '<a href="' . route('admin.confirm-delete.media', $list->id) . '" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="glyphicon glyphicon-remove" data-name="media-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete media">
                                    </i>
                                </a>';
                    return $html;
                })
                ->editColumn('content', function ($list) {
                    return '<img width="100%" src="' . asset('uploads/images/media/small/' . $list->path) . '" alt="' . $list->name . '" />';
                })
                ->blacklist(['action'])
                ->make(true);
    }

    /**
     * User create form processing.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.media.create', compact('user'));
    }

    /**
     * User create form processing.
     * @since 12/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {

            $accepableTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/pjpeg', 'image/x-png'];

            //Check for valid image type
            if (!in_array($_FILES['image']['type'], $accepableTypes)) {
                $error = 'Please upload a png or jpg or gif image.';
                return Redirect::back()->withInput()->with('error', $error);
            }
        }

        $media = Media::create([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'path' => ''
        ]);

        //If user uploaded image

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

            $image = Image::make($_FILES['image']['tmp_name']);



            $image->encode('jpeg');

            $image->save(config('image.mediaOriginalPath') . 'media_' . $media->id . '_' . time() . '.jpg');

            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save(config('image.mediaLargePath') . 'media_' . $media->id . '_' . time() . '.jpg');

            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save(config('image.mediaMediumPath') . 'media_' . $media->id . '_' . time() . '.jpg');

            $image->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save(config('image.mediaSmallPath') . 'media_' . $media->id . '_' . time() . '.jpg');

            DB::table('medias')->where('id', $media->id)->update(['path' => 'media_' . $media->id . '_' . time() . '.jpg']);
        }

        // Redirect to the home page with success message

        return Redirect::route("admin.medias")->with('success', 'Successfully created media.');
    }

    /**
     * User View page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function show($id)
    {
        // Get the user information
        $media = Media::where('id', $id)->first();

        if (is_null($media)) {

            // Prepare the error message
            $error = 'Media does not exists';

            // Redirect to the user management page
            return Redirect::route('admin.medias')->with('error', $error);
        }

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.media.show', compact('media', 'user'));
    }

    /**
     * User Delete
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $media = Media::where('id', $id)->first();

        DB::table('medias')->where('id', $media->id)->delete();

        return Redirect::route("admin.medias")->with('success', 'Successfully deleted media.');
    }

    /**
     * User Delete
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'medias';

        $entity = 'media';

        $confirm_route = $error = null;

        $media = Media::where('id', $id)->first();

        $confirm_route = route('admin.media.delete', ['id' => $media->id]);

        if (is_null($media)) {
            $error = 'Media does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
