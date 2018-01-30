<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         // Using class based composers...
        View::composer('my_profile', 'App\Http\ViewComposers\ProfileComposer');

        // Using Closure based composers...
        View::composer('builder_invited', function($view)
        {
			$view->with('ViewComposerTestVariable1','rthfh');
        });
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
