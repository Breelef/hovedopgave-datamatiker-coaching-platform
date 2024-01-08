<x-app-layout :title="'Øvelsesbank'">
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full mb-16">
                <h1 class="text-4xl font-semibold text-center">Øvelsesbank - Mine favoritter</h1>
            </div>

            <div class="border-t border-gray-200 py-5 mt-5">
                @if($exercises->count() > 0)
                    <x-show-exercises
                        :exercises="$exercises"/>
                @else
                <div class="text-center">

                    <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>

                  <h3 class="mt-2 text-sm font-semibold text-gray-900">Ingen favoritter</h3>
                  <p class="mt-1 text-sm text-gray-500">Du har ikke tilføjet nogle øvelser til dine favoritter.</p>
                  <p class="mt-1 text-sm text-gray-500">Klik på en øvelse, og tryk på knappen "Tilføj til favoritter" for at tilføje øvelser favoritter.</p>
                  <div class="mt-6">
                    <a href="{{ route('exercises.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-color border border-transparent rounded-md font-semibold text-xs text-secondary-color uppercase tracking-widest focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-vestegns-deep-blues focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="ro" class="-ml-0.5 mr-1.5 h-5 w-5" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                      Find øvelser
                    </a>
                  </div>
                </div>

                @endif
            </div>
        </div>
    </div>
</x-app-layout>

