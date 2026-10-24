<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('templates', 'views_count')) {
            Schema::table('templates', function (Blueprint $table) {
                $table->unsignedBigInteger('views_count')->default(0)->after('is_active');
            });
        }

        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->string('event_type', 50)->index(); // template_view, login, register
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->foreignId('template_id')->nullable()->constrained('templates')->nullOnDelete();
                $table->string('subject')->nullable();
                $table->text('description')->nullable();
                $table->string('ip_address', 64)->nullable();
                $table->string('user_agent', 512)->nullable();
                $table->string('url', 512)->nullable();
                $table->boolean('is_telegram_sent')->default(false);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('system_settings')) {
            Schema::create('system_settings', function (Blueprint $table) {
                $table->id();
                $table->string('key', 100)->unique();
                $table->text('value')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('system_settings');

        if (Schema::hasColumn('templates', 'views_count')) {
            Schema::table('templates', function (Blueprint $table) {
                $table->dropColumn('views_count');
            });
        }
    }
};
