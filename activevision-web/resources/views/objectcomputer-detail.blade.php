<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'Ordinateur AD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Informations de l'ordinateur</h3>

                    <ul class="list-disc pl-5">
                        <li><strong>SID :</strong> {{ $objectComputer->objectSid }}</li>
                        <li><strong>Système d'exploitation :</strong> {{ $objectComputer->operatingSystem ?? 'Non spécifié' }}</li>
                        <li><strong>Nombre de connexions :</strong> {{ $objectComputer->logonCount ?? 'Non spécifié' }}</li>
                        <li><strong>DN :</strong> {{ $objectComputer->distinguishedName ?? 'Non spécifié' }}</li>
                        <li><strong>Contrôle du compte :</strong> {{ $objectComputer->userAccountControl ?? 'Non spécifié' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>