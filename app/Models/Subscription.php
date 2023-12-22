<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'email'];

    // Each subscription belongs to a website
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
