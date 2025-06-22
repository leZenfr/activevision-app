<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupLog extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'grouplog';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'groupLogId';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'identifierIdLog',
        'targetUserName',
        'targetDomainName',
        'targetSid',
        'subjectUserSid',
        'subjectUserName',
        'subjectLogonId',
        'privilegeList',
        'samAccountName',
        'sidHistory',
        'serverSid',
        'hostname',
        'ipAddress',
        'memberName',
        'memberSid',
        'groupTypeChange',
    ];

    /**
     * Relation avec le modèle IdentifiedLog.
     */
    public function identifiedLog()
    {
        return $this->belongsTo(IdentifiedLog::class, 'identifierIdLog', 'idIdentifiedLog');
    }
}