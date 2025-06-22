<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('compte_interfaces', function (Blueprint $table) {
            $table->string('login')->primary();
            $table->string('hashed_password');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('compte_interfaces');
    }
};
