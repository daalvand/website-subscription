<?php

namespace App\Service;

use App\Contracts\PostEmailService as PostEmailServiceContract;
use App\Jobs\SendPostEmailJob;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Support\Collection;

class PostEmailService implements PostEmailServiceContract
{
    /**
     * @inheritDoc
     */
    public function sendEmailsForPost(Post $post): void
    {
        $subscriptions = $this->getUnsentSubscriptions($post);
        foreach ($subscriptions as $subscription) {
            $this->sendEmailForSubscription($post, $subscription);
        }
    }

    /**
     * Get unsent subscriptions for the given post.
     *
     * @param Post $post
     * @return Collection
     */
    private function getUnsentSubscriptions(Post $post): Collection
    {
        $allSubscriptions = $post->website->subscriptions;
        $sentSubscriptions = $post->sentToSubscriptions;
        return $allSubscriptions->reject(function ($subscription) use ($sentSubscriptions) {
            return $sentSubscriptions->contains('id', $subscription->id);
        });
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
