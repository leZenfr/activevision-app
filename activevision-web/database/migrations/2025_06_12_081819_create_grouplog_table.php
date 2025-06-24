<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grouplog', function (Blueprint $table) {
            $table->bigIncrements('groupLogId'); // PK
            $table->unsignedBigInteger('identifierIdLog'); // KE

            $table->string('targetUserName')->nullable();
            $table->string('targetDomainName')->nullable();
            $table->string('targetSid')->nullable();

            $table->string('subjectUserSid')->nullable();
            $table->string('subjectUserName')->nullable();
            $table->string('subjectDomainName')->nullable();
            $table->string('subjectLogonId')->nullable();

            $table->text('privilegeList')->nullable();
            $table->string('samAccountName')->nullable();
            $table->text('sidHistory')->nullable();

            $table->string('serverSid')->nullable();
            $table->string('hostname')->nullable();
            $table->string('ipAddress')->nullable();

            $table->string('memberName')->nullable();
            $table->string('memberSid')->nullable();
            $table->string('groupTypeChange')->nullable();

            $table->timestamps();

            // Foreign key possible ici
            // $table->foreign('identifiedLog')->references('id')->on('autre_table');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('GroupLog');
    }
};

