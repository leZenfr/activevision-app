<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenue sur ActiveVision') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Événements au fil des années</h3>
                    <canvas id="eventsBarChart" class="w-full h-48"></canvas> <!-- Hauteur réduite -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('eventsBarChart').getContext('2d');

            // Données dynamiques passées depuis le contrôleur
            const eventYears = @json($eventYears); // Les années des événements
            const eventCounts = @json($eventCounts); // Le nombre d'événements par année

            const data = {
                labels: eventYears, // Les années sur l'axe X
                datasets: [{
                    label: 'Nombre d\'événements',
                    data: eventCounts, // Nombre d'événements par année
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'bar', // Type de graphique
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.raw} événements`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Années'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Nombre d\'événements'
                            },
                            beginAtZero: true
                        }
                    }
                }
            };

            new Chart(ctx, config);
        });
    </script>
</x-app-layout>