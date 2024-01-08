<x-app-layout :title="$exercise->name">

    <div class="aspect-video">
        <iframe src="https://www.youtube.com/embed/{{ $exercise->video_url }}?modestbranding=1&rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
    </div>

    <div class="mt-4 text-right">
        <livewire:user-exercise-bookmark :exercise="$exercise"/>

        <button type="button" class="inline-flex items-center gap-x-1.5 rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            <svg class="-ml-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
            </svg>
            Udskriv
        </button>
    </div>

    <div class="max-w-[850px] mx-auto">
        <div class="w-full mt-8 mb-16">
            <h1 class="text-4xl font-semibold text-center"> {{$exercise->name}}</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4">
            <div class="col-span-2 px-3 order-2 sm:order-1">
                @foreach($exercise->description as $section)
                    <div>
                        <h2 class="mb-3 text-xl font-semibold">{{$section['title']}} </h2>
                        {!! $section['content'] !!}
                    </div>
                @endforeach

                @can('access admin panel')
                <div class="mt-4"><a href="{{ route('filament.admin.resources.exercises.edit', $exercise) }}" class="text-red-500 underline">Rediger øvelse</a></div>
                @endcan
            </div>
            <div class="col-span-1 px-3 order-1 sm:order-2">
                <h1 class="mb-3 text-xl font-semibold">Praktisk information</h1>
                    <x-exercise-info-text pClass="mb-2" title="Aldersgruppe:" from="{{$exercise->age_from}}" to="{{$exercise->age_to}}" endText="år"/>
                    @if($exercise->equipment->count() > 0)
                    <p class="font-semibold">Materialer:</p>
                    @foreach($exercise->equipment as $equipment)
                        <div class="flex flex-row items-center">
                            <img src="{{asset('storage/' . $equipment->image)}}" alt="Equipment Image" class="w-16 h-16 object-cover">
                            <p class="px-2"> - {{$equipment->pivot->quantity}}</p>
                            <p> {{$equipment->name}} </p>
                        </div>
                    @endforeach
                    @endif
                <x-exercise-info-text divClass="my-2" title="Antal Spillere:" from="{{$exercise->players_from}}" to="{{$exercise->players_to}}"/>
                <x-exercise-info-text title="Øvelsestid:" from="{{$exercise->duration_from}}" to="{{$exercise->duration_to}}" endText="min"/>
                <div class="col-span-1">
                    <img src="{{asset('storage/' . $exercise->image)}}" alt="Exercise image" class="h-72 w-full object-contain cursor-pointer" id="openModal">
                </div>
                <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="h-3/4">
                        <button class="absolute top-0 right-0 p-4" id="closeModal"></button>
                        <img src="{{asset('storage/' . $exercise->image)}}" alt="Exercise image" class="w-full h-full object-contain">
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
