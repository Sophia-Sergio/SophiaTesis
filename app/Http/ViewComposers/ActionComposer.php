<?php

namespace Sophia\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Sophia\User as User;

class ActionComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //http://stackoverflow.com/questions/29549660/get-laravel-5-controller-name-in-view
        $action = app('request')->route()->getAction();

        if (isset($action['controller'])) {
            $controller = class_basename($action['controller']);
            $response = explode('@', $controller);
            $view->with('actionData', $response);
        }
    }

}