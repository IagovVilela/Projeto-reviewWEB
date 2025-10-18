<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('review_page_id')->constrained()->cascadeOnDelete();
            $table->integer('rating'); // 1-5
            $table->string('whatsapp', 20);
            $table->text('comment')->nullable();
            $table->text('feedback')->nullable();
            $table->boolean('is_positive')->default(false);
            $table->boolean('redirected_to_google')->default(false);
            $table->timestamp('notified_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            $table->index('company_id');
            $table->index('rating');
            $table->index('is_positive');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

