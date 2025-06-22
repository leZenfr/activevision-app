<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectUser extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'ObjectUsers';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'objectSid';

    /**
     * Indique que la clé primaire n'est pas auto-incrémentée.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Le type de la clé primaire.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'objectSid',
        'badPasswordTime',
        'lastLogon',
        'lockoutTime',
        'displayName',
        'userPrincipalName',
        'sAMAccountName',
        'title',
        'postalCode',
        'streetAddress',
        'company',
        'manager',
        'distinguishedName',
        'accountExpires',
        'whenChanged',
        'whenCreated',
        'userAccountControl',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'badPasswordTime' => 'datetime',
        'lastLogon' => 'datetime',
        'lockoutTime' => 'datetime',
        'accountExpires' => 'datetime',
        'whenChanged' => 'datetime',
        'whenCreated' => 'datetime',
    ];
}