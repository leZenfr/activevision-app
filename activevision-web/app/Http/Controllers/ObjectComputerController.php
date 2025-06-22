<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectComputer;

use App\Models\ComputerLog;

class ObjectComputerController extends Controller
{
    /**
     * Affiche la liste des ordinateurs.
     */
    public function index()
    {
        $objectComputers = ObjectComputer::all(); // Récupère tous les ordinateurs
        return view('objectcomputer', compact('objectComputers')); // Passe les données à la vue
    }

    public function search(Request $request)
{
    $query = ObjectComputer::query();

    if ($request->filled('search')) {
        $searchTerm = '%' . $request->search . '%';

        // Recherche sur plusieurs colonnes
        $query->where(function ($q) use ($searchTerm) {
            $q->where('objectSid', 'LIKE', $searchTerm)
              ->orWhere('operatingSystem', 'LIKE', $searchTerm)
              ->orWhere('logonCount', 'LIKE', $searchTerm);
        });
    }

    $objectComputers = $query->get();
    return view('objectcomputer', compact('objectComputers'));
}

    /**
     * Affiche les détails d'un ordinateur.
     */
    public function show($objectSid)
    {
        $objectComputer = ObjectComputer::where('objectSid', $objectSid)->firstOrFail();
    
        // Récupérer les logs associés à l'ordinateur
        $computerLogs = ComputerLog::with('identifiedLog.event')
            ->where('targetSid', $objectSid)
            ->get();
    
        // Préparer les données pour le graphique
        $eventDates = $computerLogs->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        });
    
        $eventTitles = $computerLogs->map(function ($log) {
            return $log->identifiedLog->event->titre ?? 'Non spécifié';
        });
    
        return view('objectcomputer-detail', compact('objectComputer', 'eventDates', 'eventTitles'));
    }
}