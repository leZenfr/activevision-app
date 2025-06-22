<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('serveurs', function (Blueprint $table) {
            $table->uuid('serveur_sid')->primary();
            $table->string('hostname');
            $table->string('ip_address');
            $table->string('location');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('serveurs');
    }
};
