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
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 100);
            $table->string('name_slug', 250);
            $table->string('code', 250)->nullable();
            $table->string('qrcode_dir')->nullable();
            $table->string('qrcode_file_name')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'name_slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};
