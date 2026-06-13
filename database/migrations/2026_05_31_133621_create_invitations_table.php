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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete();
            
            $table->string('title');
            $table->string('slug')->unique();
            
            $table->date('event_date');
            $table->time('event_time');
            
            $table->string('location');
            $table->text('address')->nullable();
            $table->text('google_maps_url')->nullable();
            
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            
            $table->string('status')->default('draft'); // draft, published, expired
            $table->timestamp('published_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
