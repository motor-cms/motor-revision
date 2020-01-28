<?php

namespace Motor\Revision\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class MotorServiceProvider
 * @package Motor\Revision\Providers
 */
class MotorServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->config();
        $this->routes();
        $this->routeModelBindings();
        $this->translations();
        $this->views();
        $this->navigationItems();
        $this->permissions();
        $this->migrations();
        $this->publishResourceAssets();
        $this->components();
        merge_local_config_with_db_configuration_variables('motor-media');
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(__DIR__ . '/../../config/motor-media.php', 'motor-media');
    }


    /**
     * Set assets to be published
     */
    public function publishResourceAssets()
    {
//        $assets = [
//            __DIR__ . '/../../public/plugins/jstree' => public_path('plugins/jstree'),
//        ];
//
//        $this->publishes($assets, 'motor-media-install');
    }


    /**
     * Set migration path
     */
    public function migrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }


    /**
     * Merge permission config file
     */
    public function permissions()
    {
        $config = $this->app[ 'config' ]->get('motor-backend-permissions', []);
        $this->app[ 'config' ]->set(
            'motor-backend-permissions',
            array_replace_recursive(require __DIR__.'/../../config/motor-backend-permissions.php', $config)
        );
    }


    /**
     * Set routes
     */
    public function routes()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../../routes/web.php';
            require __DIR__.'/../../routes/api.php';
        }
    }


    /**
     * Set configuration files for publishing
     */
    public function config()
    {
        //$this->publishes([
        //    __DIR__ . '/../../config/motor-backend-project.php'          => config_path('motor-backend-project.php'),
        //], 'motor-backend-install');
    }


    /**
     * Set translation path
     */
    public function translations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'motor-revision');

        $this->publishes([
            __DIR__.'/../../resources/lang' => resource_path('lang/vendor/motor-revision'),
        ], 'motor-revision-translations');
    }


    /**
     * Set view path
     */
    public function views()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'motor-revision');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/motor-revision'),
        ], 'motor-revision-views');
    }


    /**
     * Add route model bindings
     */
    public function routeModelBindings()
    {
        Route::bind('ticket', function ($id) {
            return \Motor\Revision\Models\Ticket::findOrFail($id);
        });
        Route::bind('airport', function ($id) {
            return \Motor\Revision\Models\Airport::findOrFail($id);
        });
        Route::bind('traveler', function ($id) {
            return \Motor\Revision\Models\Traveler::findOrFail($id);
        });
        Route::bind('shuttle', function ($id) {
            return \Motor\Revision\Models\Shuttle::findOrFail($id);
        });
        Route::bind('ride', function ($id) {
            return \Motor\Revision\Models\Ride::findOrFail($id);
        });
        Route::bind('sponsor', function ($id) {
            return \Motor\Revision\Models\Sponsor::findOrFail($id);
        });
        Route::bind('hotel', function ($id) {
            return \Motor\Revision\Models\Hotel::findOrFail($id);
        });
        Route::bind('component_ticket', function ($id) {
            return \Motor\Revision\Models\Component\ComponentTicket::findOrFail($id);
        });
    }


    /**
     * Merge backend navigation items from configuration file
     */
    public function navigationItems()
    {
        $config = $this->app[ 'config' ]->get('motor-backend-navigation', []);
        $this->app[ 'config' ]->set(
            'motor-backend-navigation',
            array_replace_recursive(require __DIR__.'/../../config/motor-backend-navigation.php', $config)
        );
    }

    public function components()
    {
        $config = $this->app['config']->get('motor-cms-page-components', []);
        $this->app['config']->set(
            'motor-cms-page-components',
            array_replace_recursive(require __DIR__ . '/../../config/motor-cms-page-components.php', $config)
        );
    }
}
