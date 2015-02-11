<?php
namespace Help;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider {



    public function register()
    {
        // Registering 'helper class'
        $this->app['helper'] = $this->app->share(function($app)
        {
            return new Help\Helper;
        });

        // dynamic creating Alias, so that you do not have to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('MyHelper', 'Help\Facade\Helper');
        });
    }

}
?>