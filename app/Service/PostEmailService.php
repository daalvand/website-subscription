<?php

namespace App\Service;

use App\Contracts\PostEmailService as PostEmailServiceContract;
use App\Jobs\SendPostEmailJob;
use App\Models\Post;
use App\Models\Subscription;


class PostEmailService implements PostEmailServiceContract
{

    /**
     * @inheritDoc
     */
    public function sendEmailsForPost(Post $post): void
    {
        foreach ($post->website->subscriptions as $subscription) {
            $this->sendEmailForSubscription($post, $subscription);
        }
    }

    /**
     * Send an email for the given post to a specific subscriber.
     *
     * @param Post $post
     * @param Subscription $subscription
     * @return void
     */
    private function sendEmailForSubscription(Post $post, Subscription $subscription): void
    {
        if (!$post->sentToSubscriptions()->where('email', $subscription->email)->exists()) {
            SendPostEmailJob::dispatch($post, $subscription);
        }
    }
}
