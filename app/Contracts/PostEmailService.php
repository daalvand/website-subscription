<?php

namespace App\Contracts;

use App\Models\Post;

interface PostEmailService
{
    /**
     * Send emails for the given post to its subscribers.
     *
     * @param Post $post
     * @return void
     */
    public function sendEmailsForPost(Post $post): void;
}
