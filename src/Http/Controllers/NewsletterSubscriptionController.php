<?php

namespace Maxtc\LaravelNewsletterSubscription\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maxtc\LaravelNewsletterSubscription\Jobs\SendNewsletterSubscriptionConfirmation;
use Maxtc\LaravelNewsletterSubscription\NewsletterSubscription;

class NewsletterSubscriptionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate(['email'=>'required|email']);
        $existingSubscription = NewsletterSubscription::withTrashed()->whereEmail($data['email'])->first();

        if ($existingSubscription) {
            if ($existingSubscription->trashed()) {
                $existingSubscription->restore();
                SendNewsletterSubscriptionConfirmation::dispatch($existingSubscription);
            }
        } else {
            $subscription = NewsletterSubscription::create(['email'=>$data['email']]);
            SendNewsletterSubscriptionConfirmation::dispatch($subscription);
        }

        return redirect()->back()
            ->with(config('newsletter_subscription.session_message_key'), trans('maxtc::newsletter_subscription.subscribe', ['email' => $data['email']]));
    }

    /**
     * @param $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($hash)
    {
        $subscription = app('subscription-code-generator')->decode($hash);
        $subscription->delete();

        return redirect()->back()
            ->with(config('newsletter_subscription.session_message_key'), trans('riverskies::newsletter_subscription.unsubscribe', ['email' => $subscription->email]));
    }
}
