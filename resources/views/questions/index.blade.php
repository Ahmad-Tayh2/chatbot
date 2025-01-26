<x-app-layout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Search Form -->
      <div class="mb-8">
          <form method="GET" action="{{ route('questions.index') }}" class="flex gap-4">
              <x-text-input 
                  type="text" 
                  name="search" 
                  class="block w-full"
                  placeholder="Search questions or answers..."
                  value="{{ old('search', $search) }}"
              />
              <x-primary-button type="submit">
                  {{ __('Search') }}
              </x-primary-button>
              @if($search)
                  <a href="{{ route('questions.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                      Clear
                  </a>
              @endif
          </form>
      </div>

      <!-- FAQ List -->
      <div class="bg-white rounded-lg shadow">
          @forelse($questions as $category => $items)
              <div class="border-b last:border-b-0">
                  <h2 class="p-6 text-xl font-semibold bg-gray-50 text-gray-800">
                      {{ $category }}
                  </h2>
                  
                  <div class="divide-y">
                      @foreach($items as $question)
                          <div x-data="{ open: false }" class="group">
                              <button 
                                  @click="open = !open"
                                  class="w-full px-6 py-4 text-left hover:bg-gray-50 flex justify-between items-center"
                              >
                                  <span class="text-gray-700">{{ $question->question }}</span>
                                  <svg 
                                      class="w-5 h-5 transform transition-transform"
                                      :class="{ 'rotate-180': open }" 
                                      fill="none" 
                                      stroke="currentColor" 
                                      viewBox="0 0 24 24"
                                  >
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                  </svg>
                              </button>
                              
                              <div x-show="open" x-collapse class="px-6 pb-4 pt-2 bg-gray-50">
                                  <div class="prose max-w-none text-gray-600">
                                      {!! nl2br(e($question->answer)) !!}
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
              </div>
          @empty
              <div class="p-6 text-center text-gray-500">
                  No questions found matching your criteria.
              </div>
          @endforelse
      </div>
  </div>
</x-app-layout>