<?php

namespace App\Console\Commands;

use App\Contracts\PostEmailService;
use App\Models\Post;
use Illuminate\Console\Command;

class SendPostEmailsCommand extends Command
{
    public const NEW_POSTS_DURATION = 600;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-post-emails-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(PostEmailService $service): void
    {
        $posts = Post::latest()
            ->where('created_at', '>=', now()->subSeconds(self::NEW_POSTS_DURATION))
            ->get();

        foreach ($posts as $post) {
            $service->sendEmailsForPost($post);
        }
    }
}
