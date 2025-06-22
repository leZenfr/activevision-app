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
        Schema::create('objectgroup', function (Blueprint $table) {
            $table->string('objectSid')->primary(); // Clé primaire
            $table->text('member')->nullable(); // Membres du groupe
            $table->text('distinguishedName')->nullable(); // DN du groupe
            $table->timestamp('whenChanged')->nullable(); // Dernière modification
            $table->timestamp('whenCreated')->nullable(); // Date de création
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectgroup');
    }
};