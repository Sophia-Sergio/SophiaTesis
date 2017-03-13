<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;

use Requests;
use Illuminate\Support\Facades\App;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notification.index');
    }

    public function postNotify(Request $request)
    {
        $notifyText = e($request->input('notify_text'));

        $pusher = App::make('pusher');

        $pusher->trigger( 'test-channel',
            'test-event',
            array('text' => $notifyText));

        // TODO: Get Pusher instance from service container

        // TODO: The notification event data should have a property named 'text'

        // TODO: On the 'notifications' channel trigger a 'new-notification' event
    }
}
