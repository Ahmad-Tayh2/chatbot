<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- JSON Upload Section -->
        <div class="mb-12 p-6 bg-white rounded-lg shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Import Questions from JSON</h2>
            
            <form method="POST" action="{{ route('questions.import') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="json_file" :value="__('JSON File')" />
                    <input type="file" name="json_file" id="json_file" 
                        class="block mt-1 w-full text-sm text-gray-600
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-indigo-50 file:text-indigo-700
                            hover:file:bg-indigo-100"
                        accept="application/json" required
                    >
                    <x-input-error :messages="$errors->get('json_file')" class="mt-2" />
                    <x-input-error :messages="$errors->get('json_errors')" class="mt-2" />
                    <p class="mt-2 text-sm text-gray-500">
                        Upload a JSON file following the required format. Max 5MB.
                    </p>
                </div>

                <x-primary-button>
                    {{ __('Import Questions') }}
                </x-primary-button>
            </form>
        </div>
    <form method="POST" action="{{ route('questions.store') }}" class="max-w-2xl mx-auto p-6">
        @csrf
    
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create New FAQ Entry</h2>
    
        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <!-- Category -->
            <div class="mt-4">
                <x-input-label for="category" :value="__('Category')" />
                <select id="category" name="category" required
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select a Category</option>
                    @foreach([
                        'Informations Générales sur l\'Établissement',
                        'Programmes et Cours',
                        'Admission et Inscription',
                        'Vie Étudiante',
                        'Ressources Académiques',
                        'Services de Carrière',
                        'Santé et Bien-être',
                        'Technologie et Innovation',
                        'Politiques et Règlements',
                        'Événements et Actualités',
                        'Site Web et Plateformes en Ligne',
                        'Stages et Expériences Professionnelles',
                        'Professeurs et Encadrement',
                        'Clubs Étudiants et Associations',
                        'Services Administratifs et Carte Étudiante'
                    ] as $category)
                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
    
            <!-- Question -->
            <div class="mt-4">
                <x-input-label for="question" :value="__('Question')" />
                <x-text-input id="question" class="block mt-1 w-full" 
                    type="text" 
                    name="question" 
                    :value="old('question')" 
                    required />
                <x-input-error :messages="$errors->get('question')" class="mt-2" />
            </div>
    
            <!-- Answer -->
            <div class="mt-4">
                <x-input-label for="answer" :value="__('Answer')" />
                <textarea id="answer" 
                    name="answer"
                    required
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('answer') }}</textarea>
                <x-input-error :messages="$errors->get('answer')" class="mt-2" />
            </div>
        </div>
    
        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Create Question') }}
            </x-primary-button>
        </div>
    </form>
    </div>
</x-app-layout>