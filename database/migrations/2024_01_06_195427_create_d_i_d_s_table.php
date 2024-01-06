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
        Schema::create('d_i_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('number', 18);
            $table->unsignedBigInteger('score');
            $table->string('flagged', 8);
            $table->boolean('is_external')->default(false);
            $table->boolean('is_enabled')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_i_d_s');
    }
};
