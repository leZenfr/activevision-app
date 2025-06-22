<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'event';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'idEvent';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'titre', // Nom de l'événement
        'description', // Description de l'événement
        'created_at',
        'updated_at',
    ];

    /**
     * Relation avec le modèle IdentifiedLog.
     */
    public function identifiedLogs()
    {
        return $this->hasMany(IdentifiedLog::class, 'idEvent', 'idEvent');
    }
}