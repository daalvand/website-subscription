<?php

namespace App\Console\Commands;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Console\Command;

class SendPostEmailsCommand extends Command
{
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
    public function handle(): void
    {
        $posts = Post::latest()->whereDoesntHave('sentToSubscriptions')->get();
        foreach ($posts as $post) {
            event(new PostCreated($post));
        }
    }
}
