<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Groupe AD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations générales -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Informations du groupe</h3>
                    
                    <ul class="list-disc pl-5 mb-6">
                        <li><strong>SID :</strong> {{ $objectGroup->objectSid }}</li>
                        <li><strong>Nom :</strong> {{ $objectGroup->samAccountName ?? 'Non spécifié' }}</li>
                        <li><strong>DN :</strong> {{ $objectGroup->distinguishedName ?? 'Non spécifié' }}</li>
                        <li><strong>Date de création :</strong> {{ $objectGroup->whenCreated ? $objectGroup->whenCreated->format('d/m/Y H:i') : 'Inconnue' }}</li>
                        <li><strong>Dernière modification :</strong> {{ $objectGroup->whenChanged ? $objectGroup->whenChanged->format('d/m/Y H:i') : 'Jamais' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Encadré pour les logs liés au groupe -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h3 class="text-xl font-bold mb-4 text-indigo-600">Logs liés au groupe</h3>

                    <!-- Liste déroulante pour choisir le nombre de logs par page -->
                    <form method="GET" action="{{ route('objectgroups.show', $objectGroup->objectSid) }}" class="mb-4">
                        <label for="per_page" class="block text-sm font-medium text-gray-700">Nombre de logs par page :</label>
                        <select name="per_page" id="per_page" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>

                    @if ($groupLogs->isNotEmpty())
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nom de l'Événement</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nom du membre</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Adresse IP</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Type de changement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupLogs as $log)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->identifiedLog->event->titre ?? 'Non spécifié' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->memberName ?? 'Non spécifié' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->ipAddress ?? 'Non spécifiée' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->groupTypeChange ?? 'Non spécifié' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Liens de pagination -->
                        <div class="mt-4">
                            {{ $groupLogs->appends(['per_page' => request('per_page')])->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">Aucun log trouvé pour ce groupe.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>