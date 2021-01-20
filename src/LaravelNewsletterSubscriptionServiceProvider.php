<?php

namespace Maxtc\LaravelNewsletterSubscription;

use Illuminate\Support\ServiceProvider;
use Maxtc\LaravelNewsletterSubscription\HashIdsSubscriptionCodeGenerator;

class LaravelNewsletterSubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-newsletter-subscription');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-newsletter-subscription');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // if ($this->app->runningInConsole()) {
        //     $this->publishes([
        //         __DIR__.'/../config/config.php' => config_path('laravel-newsletter-subscription.php'),
        //     ], 'config');

        //     // Publishing the views.
        //     /*$this->publishes([
        //         __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-newsletter-subscription'),
        //     ], 'views');*/

        //     // Publishing assets.
        //     /*$this->publishes([
        //         __DIR__.'/../resources/assets' => public_path('vendor/laravel-newsletter-subscription'),
        //     ], 'assets');*/

        //     // Publishing the translation files.
        //     /*$this->publishes([
        //         __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-newsletter-subscription'),
        //     ], 'lang');*/

        //     // Registering package commands.
        //     // $this->commands([]);
        // }

    $this->app->make('Illuminate\Database\Eloquent\Factory')
        ->load(__DIR__ . '/../../database/factories');

    $this->mergeConfigFrom(
        __DIR__ . '/../../config/newsletter_subscription.php', 'newsletter_subscription'
    );

    $this->publishes([
        __DIR__ . '/../../config/newsletter_subscription.php' => config_path('newsletter_subscription.php'),
    ], 'newsletter-subscription-config');

    $this->publishes([
        __DIR__ . '/../../resources/views' => resource_path('views/vendor/maxtc'),
    ], 'newsletter-subscription-views');

    $this->publishes([
        __DIR__.'/../../resources/lang' => resource_path('lang/vendor/maxtc'),
    ], 'newsletter-subscription-translations');

    $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
    $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'maxtc');
    $this->loadTranslationsFrom(__DIR__.'/../../resources/lang/', 'maxtc');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('subscription-code-generator', function() {
            return new HashIdsSubscriptionCodeGenerator(config('app.key'));
        });
        // // Automatically apply the package configuration
        // $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-newsletter-subscription');

        // // Register the main class to use with the facade
        // $this->app->singleton('laravel-newsletter-subscription', function () {
        //     return new LaravelNewsletterSubscription;
        // });
    }
}
