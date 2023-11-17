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
        Schema::create('deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('amount')->nullable()->default(0.0);
            $table->tinyInteger('deposit_status')
                ->nullable()
                ->comment('0=Rejected, 1=Approved, 2=>Pending')
                ->default(2);
            $table->string('screenshot_dir');
            $table->text('screenshot_file_name');
            $table->unsignedMediumInteger('payment_gateway_id');
            $table->string('transaction_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('payment_gateway_id')
                ->on('payment_gateways')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
