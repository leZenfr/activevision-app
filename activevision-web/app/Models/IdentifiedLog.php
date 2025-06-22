<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentifiedLog extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'identifiedlog';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'idEvent', // Clé étrangère vers la table events
        'created_at',
        'updated_at',
    ];

    /**
     * Relation avec le modèle Event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'idEvent', 'idEvent'); // Clé étrangère et clé primaire correctes
    }
}