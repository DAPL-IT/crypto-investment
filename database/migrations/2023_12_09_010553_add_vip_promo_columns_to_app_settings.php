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
        Schema::table('app_settings', function (Blueprint $table) {
            $table->string('vip_promo_image_dir')->nullable()->after('background_image_file_name');
            $table->string('vip_promo_image_file_name')->nullable()->after('vip_promo_image_dir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn('vip_promo_image_dir');
            $table->dropColumn('vip_promo_image_file_name');
        });
    }
};
