<?php

namespace App\Jobs;

use App\Mail\PostPublished;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostEmailJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const DEFAULT_QUEUE_NAME = 'send_post_email_job';
    private Post $post;
    private Subscription $subscription;

    public function __construct(Post $post, Subscription $subscription)
    {
        $this->post = $post;
        $this->subscription = $subscription;
        $this->onQueue(self::DEFAULT_QUEUE_NAME);
    }

    public function handle(): void
    {
        Mail::to($this->subscription->email)->send(new PostPublished($this->post));
        $this->post->sentToSubscriptions()->attach($this->subscription->id, ['sent_at' => now()]);
    }

    public function uniqueId(): string
    {
        return 'send_post_email_' . $this->post->id . '_' . $this->subscription->id;
    }
}
