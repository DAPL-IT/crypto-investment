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
        Schema::create('user_transaction_briefs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('total_earning')
                ->nullable()->default(0.0);
            $table->double('total_deposit')
                ->nullable()->default(0.0);
            $table->double('total_withdraw')
                ->nullable()->default(0.0);
            $table->unsignedInteger('total_successful_transaction')
                ->nullable()->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_transaction_briefs');
    }
};
