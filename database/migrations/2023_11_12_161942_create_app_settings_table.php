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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->autoIncrement();
            $table->string('app_name')->default('App Name');
            $table->string('icon_dir')->nullable();
            $table->string('icon_file_name')->nullable();
            $table->string('background_image_dir')->nullable();
            $table->string('background_image_file_name')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'app_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
