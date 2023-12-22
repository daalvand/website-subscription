<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function getUrlAttribute(): string
    {
        // Replace 'website.com' with the base URL of your websites
        return  $this->website->url . '/posts/' . $this->id;
    }

    public function subscribers()
    {
        return $this->website->subscribers();
    }


    public function sentToSubscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'post_email_logs')
            ->withPivot('sent_at')
            ->withTimestamps();
    }
}
