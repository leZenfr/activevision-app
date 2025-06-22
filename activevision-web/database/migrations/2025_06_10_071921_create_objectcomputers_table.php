<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('objectcomputers', function (Blueprint $table) {
            $table->string('objectSid')->primary();
            $table->integer('logonCount')->nullable();
            $table->string('operatingSystem')->nullable();
            $table->text('distinguishedName')->nullable();
            $table->string('userAccountControl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectcomputers');
    }
};
