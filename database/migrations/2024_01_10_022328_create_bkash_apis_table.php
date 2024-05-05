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
        Schema::create('bkash_apis', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('bkash_password');
            $table->string('bkash_app_key');
            $table->string('bkash_app_secret');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkash_apis');
    }
};
