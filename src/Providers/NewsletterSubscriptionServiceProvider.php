<?php

namespace Maxtc\LaravelNewsletterSubscription\Providers;

use Illuminate\Support\ServiceProvider;
use Maxtc\LaravelNewsletterSubscription\HashIdsSubscriptionCodeGenerator;

class NewsletterSubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('Illuminate\Database\Eloquent\Factory')
            ->load(__DIR__ . '/../../database/factories');

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/newsletter_subscription.php', 'newsletter_subscription'
        );

        $this->publishes([
            __DIR__ . '/../../config/newsletter_subscription.php' => config_path('newsletter_subscription.php'),
        ], 'newsletter-subscription-config');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/Maxtc'),
        ], 'newsletter-subscription-views');

        $this->publishes([
            __DIR__.'/../../resources/lang' => resource_path('lang/vendor/Maxtc'),
        ], 'newsletter-subscription-translations');

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'Maxtc');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang/', 'Maxtc');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('subscription-code-generator', function() {
            return new HashIdsSubscriptionCodeGenerator(config('app.key'));
        });
    }
}
