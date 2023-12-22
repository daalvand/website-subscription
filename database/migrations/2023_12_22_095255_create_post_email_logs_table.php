<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_email_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('subscriber_id')->constrained('subscribers');
            $table->unique(['post_id', 'subscriber_id']);
            $table->timestamp('sent_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_email_logs');
    }
};
