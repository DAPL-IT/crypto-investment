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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 50)->unique();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->boolean('is_active')
                ->default(true)
                ->comment('0=blocked_user, 1=unblocked_user');
            $table->boolean('is_online')
                ->default(false)
                ->comment('0=not_online, 1=online');
            $table->string('account_type')->default('user');
            //inviter_id should not be referenced by FK, because if inviter deletes his id it will cause problem
            $table->unsignedBigInteger('inviter_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'username', 'account_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
