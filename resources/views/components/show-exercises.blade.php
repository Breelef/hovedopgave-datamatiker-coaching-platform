<ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
    @foreach($exercises as $exercise)
        <li class="relative">
            <a href="{{ route('exercises.show', $exercise) }}">
                <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 min-h-[175px] max-h-[175px]">
                    <img src="{{asset('storage/' . $exercise->image)}}" alt="Exercise image" class="pointer-events-none object-cover group-hover:opacity-75">
                </div>
                <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">
                    {{$exercise->name}}</p>
                <p class="pointer-events-none block text-sm font-medium text-gray-500">{{$exercise->activity_type}}</p>
            </a>
        </li>
    @endforeach
</ul>
