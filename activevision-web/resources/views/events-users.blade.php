<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Événements des Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Logs Utilisateur</h3>

                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Log ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nom de l'Événement</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Utilisateur</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Adresse IP</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($userLogs as $log)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $log->userLogId }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $log->identifiedLog->event->titre ?? 'Non spécifié' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $log->sAMAccountName ?? 'Non spécifié' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $log->serverIp ?? 'Non spécifiée' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('events.users.show', $log->userLogId) }}" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">
                                        Aucun log utilisateur trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>