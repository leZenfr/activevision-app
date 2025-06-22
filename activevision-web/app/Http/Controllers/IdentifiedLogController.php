<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentifiedLog;

class IdentifiedLogController extends Controller
{
    /**
     * Affiche la liste des logs identifiés.
     */
    public function index()
    {
        $identifiedLogs = IdentifiedLog::with('event')->get(); // Charge les logs avec les événements associés
        return view('identifiedlogs', compact('identifiedLogs')); // Passe les données à la vue
    }

    /**
     * Affiche les détails d'un log identifié.
     */
    public function show($idEvent)
    {
        $log = IdentifiedLog::with('event')->findOrFail($id); // Charge le log avec l'événement associé
        return view('identifiedlog-detail', compact('log')); // Passe les données à la vue
    }
}