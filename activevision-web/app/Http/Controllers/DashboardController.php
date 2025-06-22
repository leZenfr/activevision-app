<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class DashboardController extends Controller
{

    public function index()
    {
        // Récupérer les logs utilisateur groupés par année
        $userLogs = \App\Models\UserLog::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
    
        // Récupérer les logs ordinateur groupés par année
        $computerLogs = \App\Models\ComputerLog::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
    
        // Cumuler les résultats par année
        $combinedLogs = $userLogs->concat($computerLogs)
            ->groupBy('year')
            ->map(function ($logs, $year) {
                return $logs->sum('count');
            })
            ->sortKeys(); // Trier les années en ordre croissant
    
        // Préparer les données pour le graphique
        $eventYears = $combinedLogs->keys(); // Les années des événements
        $eventCounts = $combinedLogs->values(); // Le nombre total d'événements par année
    
        return view('dashboard', compact('eventYears', 'eventCounts'));
    }
}
