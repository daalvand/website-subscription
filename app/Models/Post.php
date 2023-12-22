<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description'
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function getUrlAttribute(): string
    {
        return  $this->website->url . '/posts/' . $this->id;
    }

    public function subscriptions(): HasMany
    {
        return $this->website->subscriptions();
    }


    public function sentToSubscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class, 'post_email_logs')
            ->withPivot('sent_at')
            ->withTimestamps();
    }
}
