<?php

namespace Maxtc\LaravelNewsletterSubscription\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maxtc\LaravelNewsletterSubscription\NewsletterSubscription;

class NewsletterSubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var NewsletterSubscription
     */
    public $subscription;

    /**
     * Create a new message instance.
     *
     * @param NewsletterSubscription $subscription
     */
    public function __construct(NewsletterSubscription $subscription)
    {
        $this->subscription = $subscription;
        $this->subject('Thanks for signing up to our newsletter!');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return config('newsletter_subscription.mail') == 'markdown'
            ? $this->markdown('maxtc::mails.newsletter-subscription-confirmation')
            : $this->view('maxtc::mails.newsletter-subscription-confirmation');
    }
}
