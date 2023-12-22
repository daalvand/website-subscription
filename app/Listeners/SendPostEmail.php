<?php

namespace App\Listeners;

use App\Contracts\PostEmailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostCreated;

class SendPostEmail implements ShouldQueue
{
    use InteractsWithQueue;

    private PostEmailService $postEmailService;

    public function __construct(PostEmailService $postEmailService)
    {
        $this->postEmailService = $postEmailService;
    }

    public function handle(PostCreated $event): void
    {
        $this->postEmailService->sendEmailsForPost($event->getPost());
    }
}
