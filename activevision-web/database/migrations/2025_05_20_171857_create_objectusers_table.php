<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ObjectUsers', function (Blueprint $table) {
            $table->char('objectSid', 64)->primary();
            $table->timestamp('badPasswordTime')->nullable();
            $table->timestamp('lastLogon')->nullable();
            $table->timestamp('lockoutTime')->nullable();
            $table->string('displayName')->nullable();
            $table->string('userPrincipalName')->nullable();
            $table->string('sAMAccountName')->nullable();
            $table->string('title')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('streetAddress')->nullable();
            $table->string('company')->nullable();
            $table->string('manager')->nullable();
            $table->string('distinguishedName')->nullable();
            $table->timestamp('accountExpires')->nullable();
            $table->timestamp('whenChanged')->nullable();
            $table->timestamp('whenCreated')->nullable();
            $table->integer('userAccountControl')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ObjectUsers');
    }
};
