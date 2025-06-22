<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerLog extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'computerlog';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'computerLogId';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'identifierIdLog',
        'computerAccountChange',
        'targetUserName',
        'targetDomainName',
        'targetSid',
        'subjectUserSid',
        'subjectUserName',
        'subjectDomainName',
        'subjectLogonId',
        'privilegeList',
        'samAccountName',
        'displayName',
        'userPrincipalName',
        'homeDirectory',
        'homePath',
        'scriptPath',
        'profilePath',
        'userWorkstations',
        'passwordLastSet',
        'accountExpires',
        'primaryGroupId',
        'allowedToDelegateTo',
        'oldUacValue',
        'newUacValue',
        'userAccountControl',
        'userParameters',
        'sidHistory',
        'logonHours',
        'dnsHostName',
        'servicePrincipalNames',
        'service1',
        'hostname',
        'ipAddress',
    ];

    public function identifiedLog()
    {
        return $this->belongsTo(IdentifiedLog::class, 'identifierIdLog', 'idIdentifiedLog'); // Clé étrangère et clé primaire correctes
    }


}