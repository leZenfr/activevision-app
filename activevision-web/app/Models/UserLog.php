<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'userlog';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'userLogId';

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
     * Relation avec le modèle IdentifiedLog.
     */
    public function identifiedLog()
    {
        return $this->belongsTo(IdentifiedLog::class, 'identifierIdLog', 'idIdentifiedLog'); // Clé étrangère et clé primaire correctes
    }
}