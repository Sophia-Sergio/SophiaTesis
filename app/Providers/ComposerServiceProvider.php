<?php

namespace Sophia\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //View::composer(['layout.user', 'carrera.index'], 'Sophia\Http\ViewComposers\ProfileComposer');
        View::composers([
            'Sophia\Http\ViewComposers\ProfileComposer' => ['*'],
            'Sophia\Http\ViewComposers\ActionComposer' => ['*']
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
