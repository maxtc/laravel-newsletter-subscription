<?php

namespace Maxtc\LaravelNewsletterSubscription\Tests;

use Orchestra\Testbench\TestCase;
use Maxtc\LaravelNewsletterSubscription\LaravelNewsletterSubscriptionServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelNewsletterSubscriptionServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
