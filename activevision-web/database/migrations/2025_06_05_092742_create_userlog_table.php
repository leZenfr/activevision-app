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
        Schema::create('userlog', function (Blueprint $table) {
            $table->bigIncrements('userLogId'); // Clé primaire
            $table->string('identifierIdLog')->index(); // Clé étrangère potentielle
            $table->string('dummy')->nullable();

            $table->string('targetUserName')->nullable();
            $table->binary('targetSid')->nullable();

            $table->binary('subjectUserSid')->nullable();
            $table->string('subjectUserName')->nullable();
            $table->string('subjectDomainName')->nullable();
            $table->string('subjectLogonId')->nullable();

            $table->string('privilegeList')->nullable();
            $table->string('sAMAccountName')->nullable();
            $table->string('displayName')->nullable();
            $table->string('userPrincipalName')->nullable();

            $table->string('homeDirectory')->nullable();
            $table->string('homePath')->nullable();
            $table->string('scriptPath')->nullable();
            $table->string('profilePath')->nullable();
            $table->string('userWorkstations')->nullable();

            $table->timestamp('passwordLastSet')->nullable();
            $table->timestamp('accountExpires')->nullable();

            $table->string('primaryGroupId')->nullable();
            $table->string('allowedToDelegateTo')->nullable();
            $table->string('oldUacValue')->nullable();
            $table->string('newUacValue')->nullable();
            $table->integer('userAccountControl')->nullable();

            $table->text('userParameters')->nullable();
            $table->text('sidHistory')->nullable();

            $table->integer('logonHours')->nullable();
            $table->binary('serverSid')->nullable();
            $table->string('hostname')->nullable();
            $table->string('ipAddress')->nullable();

            $table->string('oldTargetUserName')->nullable();
            $table->string('newTargetUserName')->nullable();

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserLog');
    }
};