<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentifiedLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('identifiedlog', function (Blueprint $table) {
            $table->bigIncrements('idIdentifiedLog'); // Clé primaire

            $table->unsignedBigInteger('idEvent'); // Clé étrangère
            $table->foreign('idEvent')->references('idEvent')->on('event')->onDelete('cascade');

            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identified_log');
    }
}
