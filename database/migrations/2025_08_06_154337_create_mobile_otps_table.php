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
        Schema::create('mobile_otps', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_number', 15);
            $table->string('otp_value', 10);
            $table->timestamp('expires_at');
            $table->unique(['mobile_number', 'otp_value']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_otps');
    }
};
