<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Log Utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Informations du Log</h3>

                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Champ</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Log ID</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $log->userLogId }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Nom de l'Événement</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $log->identifiedLog->event->titre ?? 'Non spécifié' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Description de l'Événement</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $log->identifiedLog->event->description ?? 'Non spécifiée' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Nom de l'Entité</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $log->targetUserName ?? 'Non spécifié' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">SID de l'Entité</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $log->targetSid ?? 'Non spécifié' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Adresse IP</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $log->serverIp ?? 'Non spécifiée' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Date</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>