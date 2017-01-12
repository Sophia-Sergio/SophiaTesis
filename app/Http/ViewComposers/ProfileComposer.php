<?php

namespace Sophia\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Sophia\User as User;

class ProfileComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('currentUser', Auth::user());
    }

}