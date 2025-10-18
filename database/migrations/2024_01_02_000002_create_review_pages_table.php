<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->uuid('public_token')->unique();
            $table->string('page_url')->unique();
            $table->integer('views_count')->default(0);
            $table->timestamps();
            
            $table->index('public_token');
            $table->index('company_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_pages');
    }
};

