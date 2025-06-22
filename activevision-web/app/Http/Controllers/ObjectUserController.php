<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectUser;

use App\Models\UserLog;

class ObjectUserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs AD.
     */
    public function index()
    {
        $objectUsers = ObjectUser::all(); // Récupère tous les utilisateurs AD
        return view('objectusers', compact('objectUsers')); // Passe les données à la vue
    }

    /**
     * Recherche des utilisateurs AD avec des filtres.
     */
    public function search(Request $request)
    {
        $query = ObjectUser::query();
    
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
    
            // Recherche sur plusieurs colonnes
            $query->where(function ($q) use ($searchTerm) {
                $q->where('objectSid', 'LIKE', $searchTerm)
                  ->orWhere('displayName', 'LIKE', $searchTerm)
                  ->orWhere('userPrincipalName', 'LIKE', $searchTerm)
                  ->orWhere('sAMAccountName', 'LIKE', $searchTerm)
                  ->orWhere('postalCode', 'LIKE', $searchTerm)
                  ->orWhere('company', 'LIKE', $searchTerm);
            });
        }
    
        $objectUsers = $query->get();
        return view('objectusers', compact('objectUsers'));
    }

    /**
     * Affiche les détails d'un utilisateur AD et ses événements.
     */
    public function show($objectSid, Request $request)
    {
        // Récupérer l'utilisateur
        $objectUser = ObjectUser::where('objectSid', $objectSid)->firstOrFail();
    
        $perPage = $request->input('per_page', 15);
        
        // Récupérer les logs utilisateur associés
        $query = UserLog::with('identifiedLog.event')
            ->where('targetSid', $objectSid); // Filtrer les logs pour cet utilisateur
    
        // Appliquer les filtres par date
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
    
        $userLogs = $query->paginate($perPage);
    
        // Préparer les données pour le graphique
        $eventDates = $userLogs->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        });
    
        $eventTitles = $userLogs->map(function ($log) {
            return $log->identifiedLog->event->titre ?? 'Non spécifié';
        });
    
        return view('objectuser-detail', compact('objectUser', 'userLogs', 'eventDates', 'eventTitles', 'perPage'));
    }
}