<?php

namespace Incraigulous\AdminZone;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Incraigulous\AdminZone\ViewComposers\FieldComposer;
use Incraigulous\AdminZone\ViewComposers\FieldElementComposer;
use Incraigulous\AdminZone\ViewComposers\LayoutComposer;
use Incraigulous\AdminZone\ViewComposers\RelatedEntryComposer;
use Spatie\BladeX\ComponentDirectory\NamespacedDirectory;
use Spatie\BladeX\Facades\BladeX;
use SplFileInfo;
use Illuminate\Support\Facades\Config;

class AdminZoneServiceProvider extends ServiceProvider
{
    public $componentDirectories = [
        'az' => 'adminzone::components/',
        'az-field' => 'adminzone::components/fields/'
    ];

    public function boot()
    {
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        if ($driver === 'mysql') {
            DB::statement("SET SESSION sql_mode = ''"); //TODO: Doing this for the searchable package. If they don't fix this issue by release, I should remove that package.
        }
        $this->publishes([
            __DIR__.'/../config/adminzone.php' => config_path('adminzone.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/assets' => resource_path('vendor/adminzone')
        ], 'assets');

        $this->publishes([
            __DIR__.'/../resources/assets/scss' => resource_path('vendor/adminzone/scss')
        ], 'scss');

        $this->publishes([
            __DIR__.'/../resources/assets/js' => resource_path('vendor/adminzone/js')
        ], 'js');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/adminzone'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/adminzone'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
            __DIR__ . '/../database/seeds'   => database_path('seeds'),
        ], 'database');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'adminzone');

        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/breadcrumbs.php');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->registerBladeXComponents();
        $this->registerViewComposers();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/adminzone.php', 'adminzone');

        AdminZone::register(Config::get('adminzone.menu'));
    }

    public function registerBladeXComponents()
    {
        foreach ($this->componentDirectories as $prefix => $directory) {
            $this->registerBladeXDirectory($prefix, $directory);
        }
    }

    public function registerBladeXDirectory($prefix, $directory)
    {
        $componentDirectory = new NamespacedDirectory($directory);

        collect(File::files($componentDirectory->getAbsoluteDirectory()))
            ->filter(function (SplFileInfo $file) {
                return ends_with($file->getFilename(), '.blade.php');
            })
            ->map(function (SplFileInfo $file) use ($componentDirectory) {
                return $componentDirectory->getViewName($file);
            })
            ->each(function (string $viewName) use($prefix) {
                $fileName = substr($viewName, strrpos($viewName, '/') + 1);
                $tag = $prefix . '-' . kebab_case($fileName);
                BladeX::component($viewName)->tag($tag);
            });
    }

    public function registerViewComposers()
    {
        View::composer(
            $this->getViewsInPath('adminzone::components/fields/'),
            FieldComposer::class
        );

        View::composer(
            'adminzone::layouts.layout',
            LayoutComposer::class
        );

        View::composer(
            $this->getViewsInPath('adminzone::elements/fields/'),
            FieldElementComposer::class
        );

        View::composer(
            'adminzone::components/related-entry',
            RelatedEntryComposer::class
        );
    }

    public function getViewsInPath($path)
    {
        $directory = new NamespacedDirectory($path);

        return collect(File::files($directory->getAbsoluteDirectory()))
            ->filter(function (SplFileInfo $file) {
                return ends_with($file->getFilename(), '.blade.php');
            })
            ->map(function (SplFileInfo $file) use ($directory) {
                return str_replace('/', '.', $directory->getViewName($file));
            })->toArray();
    }


}
