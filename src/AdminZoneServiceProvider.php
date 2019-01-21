<?php

namespace Incraigulous\AdminZone;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Incraigulous\AdminZone\ViewComposers\FieldComposer;
use Incraigulous\AdminZone\ViewComposers\LayoutComposer;
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
        $this->publishes([
            __DIR__.'/../config/adminzone.php' => config_path('adminzone.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/adminzone'),
            __DIR__.'/../resources/assets' => resource_path('vendor/adminzone')
        ], 'assets');

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/adminzone'),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'adminzone');

        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

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
        $componentDirectory = new NamespacedDirectory('adminzone::components/fields/');

        $views = collect(File::files($componentDirectory->getAbsoluteDirectory()))
            ->filter(function (SplFileInfo $file) {
                return ends_with($file->getFilename(), '.blade.php');
            })
            ->map(function (SplFileInfo $file) use ($componentDirectory) {
                return str_replace('/', '.', $componentDirectory->getViewName($file));
            })->toArray();

        View::composer(
            $views,
            FieldComposer::class
        );

        View::composer(
            'adminzone::layouts.layout',
            LayoutComposer::class
        );
    }


}
