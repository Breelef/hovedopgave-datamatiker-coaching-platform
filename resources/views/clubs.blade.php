<x-app-layout>
    <ul role="list" class="grid grid-cols-2 gap-x-1 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-6 xl:gap-x-1 ml-10">
        @foreach($clubs as $club)
            <li class="relative">
                <div class="group aspect-h-7 aspect-w-8 overflow-hidden rounded-lg focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <a href="{{$club->website}}" target="blank" rel="noopener noreferrer" class="inline-block">
                        <img src="{{asset('images/masterclass-gul.png')}}" alt="club logo" class="pointer-events-none object-cover group-hover:opacity-75 h-40">
                    </a>
                </div>
                <p class="pointer-events-none mt-2 block truncate text-xl font-bold">{{$club->name}}</p>
            </li>
        @endforeach
    </ul>
</x-app-layout>
