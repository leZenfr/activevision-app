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
        Schema::create('computerlog', function (Blueprint $table) {
            $table->bigIncrements('computerLogId');
            $table->string('identifierIdLog')->nullable();
            $table->string('computerAccountChange')->nullable();
            $table->string('targetUserName')->nullable();
            $table->string('targetDomainName')->nullable();
            $table->string('targetSid')->nullable();
            $table->string('subjectUserSid')->nullable();
            $table->string('subjectUserName')->nullable();
            $table->string('subjectDomainName')->nullable();
            $table->string('subjectLogonId')->nullable();
            $table->string('privilegeList')->nullable();
            $table->string('samAccountName')->nullable();
            $table->string('displayName')->nullable();
            $table->string('userPrincipalName')->nullable();
            $table->string('homeDirectory')->nullable();
            $table->string('homePath')->nullable();
            $table->string('scriptPath')->nullable();
            $table->string('profilePath')->nullable();
            $table->string('userWorkstations')->nullable();
            $table->string('passwordLastSet')->nullable();
            $table->string('accountExpires')->nullable();
            $table->string('primaryGroupId')->nullable();
            $table->string('allowedToDelegateTo')->nullable();
            $table->string('oldUacValue')->nullable();
            $table->string('newUacValue')->nullable();
            $table->string('userAccountControl')->nullable();
            $table->string('userParameters')->nullable();
            $table->string('sidHistory')->nullable();
            $table->string('logonHours')->nullable();
            $table->string('dnsHostName')->nullable();
            $table->string('servicePrincipalNames')->nullable();
            $table->string('service1')->nullable();

            $table->string('serverSid')->nullable();
            $table->string('serverName')->nullable();
            $table->string('serverIp')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('ComputerLog');
    }
};
