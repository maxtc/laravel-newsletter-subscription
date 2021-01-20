<?php

namespace Maxtc\LaravelNewsletterSubscription;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Maxtc\LaravelNewsletterSubscription\Skeleton\SkeletonClass
 */
class LaravelNewsletterSubscriptionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-newsletter-subscription';
    }
}
