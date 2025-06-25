<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'Utilisateur AD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations générales -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Informations de l'utilisateur</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Informations générales (à gauche) -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow col-span-2 md:col-span-1">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Informations générales</h4>
                            <p><strong>SID :</strong> <span class="text-gray-700">{{ $objectUser->objectSid }}</span></p>
                            <p><strong>Nom :</strong> <span class="text-gray-700">{{ $objectUser->displayName }}</span></p>
                            <p><strong>Email :</strong> <span class="text-gray-700">{{ $objectUser->userPrincipalName }}</span></p>
                            <p><strong>Nom SAM :</strong> <span class="text-gray-700">{{ $objectUser->sAMAccountName }}</span></p>
                            <p><strong>Titre :</strong> <span class="text-gray-700">{{ $objectUser->title }}</span></p>
                            <p><strong>Code Postal :</strong> <span class="text-gray-700">{{ $objectUser->postalCode }}</span></p>
                            <p><strong>Adresse :</strong> <span class="text-gray-700">{{ $objectUser->streetAddress }}</span></p>
                            <p><strong>Entreprise :</strong> <span class="text-gray-700">{{ $objectUser->company }}</span></p>
                            <p><strong>Manager :</strong> <span class="text-gray-700">{{ $objectUser->manager }}</span></p>
                        </div>

                        <!-- Informations sur les mots de passe (en haut à droite) -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Informations sur les mots de passe</h4>
                            <p><strong>Dernière tentative de mot de passe incorrect :</strong> <span class="text-gray-700">{{ $objectUser->badPasswordTime ? $objectUser->badPasswordTime->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Dernière connexion :</strong> <span class="text-gray-700">{{ $objectUser->lastLogon ? $objectUser->lastLogon->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Verrouillage :</strong> <span class="text-gray-700">{{ $objectUser->lockoutTime ? $objectUser->lockoutTime->format('d/m/Y H:i') : 'Aucun' }}</span></p>
                        </div>

                        <!-- Gestion du compte (en bas à droite) -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Gestion du compte</h4>
                            <p><strong>Expiration du compte :</strong> <span class="text-gray-700">{{ $objectUser->accountExpires ? $objectUser->accountExpires->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Dernière modification :</strong> <span class="text-gray-700">{{ $objectUser->whenChanged ? $objectUser->whenChanged->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Mot de passe changé le :</strong> <span class="text-gray-700">{{ $objectUser->pwdLastSet}}</span></p>
                            <p><strong>Date de création :</strong> <span class="text-gray-700">{{ $objectUser->whenCreated ? $objectUser->whenCreated->format('d/m/Y H:i') : 'Inconnue' }}</span></p>
                            <p><strong>Contrôle du compte utilisateur :</strong> <span class="text-gray-700">{{ $objectUser->userAccountControl ? 'Activé' : 'Désactivé' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Encadré pour les logs liés à l'utilisateur -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4 text-indigo-600">Logs liés à l'utilisateur</h3>

                    <!-- Liste déroulante pour choisir le nombre de logs par page -->
                    <form method="GET" action="{{ route('objectusers.show', $objectUser->objectSid) }}" class="mb-4">
                        <label for="per_page" class="block text-sm font-medium text-gray-700">Nombre de logs par page :</label>
                        <select name="per_page" id="per_page" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>

                    @if ($userLogs->isNotEmpty())
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nom de l'Événement</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userLogs as $log)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->identifiedLog->event->titre ?? 'Non spécifié' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $log->identifiedLog->event->description ?? 'Non spécifiée' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Liens de pagination -->
                        <div class="mt-4">
                            {{ $userLogs->appends(['per_page' => request('per_page')])->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">Aucun log trouvé pour cet utilisateur.</p>
                    @endif
                </div>
            </div>

            <!-- Encadré pour le graphique des événements -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4 text-indigo-600">Graphique des événements</h3>
                    <canvas id="eventsChart" class="w-full h-64"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('eventsChart').getContext('2d');

            const eventDates = @json($eventDates); // Les dates des événements
            const eventTitles = @json($eventTitles); // Les titres des événements

            const data = {
                labels: eventDates, // Les dates sur l'axe X
                datasets: [{
                    label: 'Événements',
                    data: eventDates.map(() => 1), // Une valeur constante pour chaque événement
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    pointStyle: 'circle',
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Couleur des points
                }]
            };

            const config = {
                type: 'line', // Type de graphique
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return eventTitles[context.dataIndex]; // Affiche le titre de l'événement au survol
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Dates'
                            }
                        },
                        y: {
                            display: false // Cache l'axe Y car il n'est pas nécessaire
                        }
                    }
                }
            };

            new Chart(ctx, config);
        });
    </script>
</x-app-layout>