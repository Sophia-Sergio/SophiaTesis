<?php
namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ActivityController extends Controller
{
    var $pusher;
    var $user;

    public function __construct()
    {
        $this->pusher = App::make('pusher');
        //$this->setUser();
    }

    /**
     * Serve the example activities view
     */
    public function index()
    {
        // If there is no user, redirect to GitHub login
        if(!Auth::user())
        {
            return redirect('auth/github?redirect=/activities');
        }

        // TODO: provide some useful text
        $activity = [
            'text' => '...',
            'username' => Auth::user()->getFullName(),
            'avatar' => 'http://lorempixel.com/100/100/',
            'id' => str_random()
        ];

        // TODO: trigger event
        $this->pusher->trigger('activities', 'user-visit', $activity);

        return view('activity.index');
    }

    /**
     * A new status update has been posted
     * @param Request $request
     */
    public function postStatusUpdate(Request $request)
    {
        $statusText = e($request->input('status_text'));

        // TODO: trigger event
    }

    /**
     * Like an exiting activity
     * @param $id The ID of the activity that has been liked
     */
    public function postLike($id)
    {
        // TODO: trigger event
    }
}
