<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Ordinateurs AD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Ordinateurs</h3>

                    <!-- Moteur de recherche -->
                    <form method="GET" action="{{ route('objectcomputers.search') }}" class="mb-6">
                        <div class="flex items-center space-x-4">
                            <!-- Champ de recherche -->
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Rechercher..." 
                                class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm w-full"
                            />

                            <!-- Bouton de recherche -->
                            <button 
                                type="submit" 
                                class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                                Rechercher
                            </button>
                        </div>
                    </form>

                    <!-- Tableau des ordinateurs -->
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">SID</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Système d'exploitation</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nombre de connexions</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($objectComputers as $computer)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $computer->objectSid }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $computer->operatingSystem ?? 'Non spécifié' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $computer->logonCount ?? 'Non spécifié' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('objectcomputers.show', $computer->objectSid) }}" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">
                                        Aucun ordinateur trouvé.
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