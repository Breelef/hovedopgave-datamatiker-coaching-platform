<x-app-layout :title="'Øvelsesbank'">
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full mb-16">
                <h1 class="text-4xl font-semibold text-center">{{$category->name}}</h1>
                <p class="text-xl text-gray-500 font-medium text-center">Øvelser</p>
            </div>
            <form method="GET" action="/categories/{{$category->slug}}?filter">
                <div class="grid grid-cols-4 grid-rows-1 gap-4 text-sm">

                    <div>
                        <legend class="block font-medium mb-1">Træningstype</legend>
                        <select name="exercise_type" id="exercise_type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-vestegns-deep-blues sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="football" @if(app('request')->input('exercise_type') == 'football') selected @endif>Fodbold</option>
                            <option value="fitness" @if(app('request')->input('exercise_type') == 'fitness') selected @endif>Fitness</option>
                        </select>
                    </div>

                    <div>
                        <legend class="block font-medium mb-1">Årgang</legend>
                        <select name="age_groups" id="age_groups" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-vestegns-deep-blues sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="" @if(empty(app('request')->input('age_groups'))) selected @endif>Vælg årgang</option>
                            @foreach($ageGroups as $ageGroup)
                                <option value="{{ $ageGroup->age }}" @if(app('request')->input('age_groups') == $ageGroup->age) selected @endif>{{ $ageGroup->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <legend class="block font-medium mb-1">Spillere</legend>
                        <input type="number" name="players" id="filter-players" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-vestegns-deep-blues sm:text-sm sm:leading-6" placeholder="Antal spillere" min="1" max="100" value="{{ app('request')->input('players') }}">
                    </div>

                    <div>
                        <legend class="block font-medium mb-1">Søgning</legend>
                        <input type="text" name="search" id="filter-search" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-vestegns-deep-blues sm:text-sm sm:leading-6" placeholder="Indtast søgeord" value="{{ app('request')->input('search') }}">
                    </div>

                    <div>
                        <legend class="block font-medium mb-1">Øvelsestype</legend>
                        <div class="space-y-1">
                            <div class="flex items-center">
                                <input id="activity_type-0" name="activity_type[]" value="spil" type="checkbox" @if(is_array(app('request')->input('activity_type')) && in_array('spil', app('request')->input('activity_type'))) checked @endif class="h-4 w-4 rounded border-gray-300 text-primary-color focus:vestegns-deep-blues">
                                <label for="activity_type-0" class="ml-3 text-sm text-gray-600">Spil</label>
                            </div>
                            <div class="flex items-center">
                                <input id="activity_type-1" name="activity_type[]" value="øvelse" type="checkbox" @if(is_array(app('request')->input('activity_type')) && in_array('øvelse', app('request')->input('activity_type'))) checked @endif class="h-4 w-4 rounded border-gray-300 text-primary-color focus:vestegns-deep-blues">
                                <label for="activity_type-1" class="ml-3 text-sm text-gray-600">Øvelse</label>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="mt-4"><button type="submit" value="Submit" class="inline-flex items-center px-4 py-2 bg-primary-color border border-transparent rounded-md font-semibold text-xs text-secondary-color uppercase tracking-widest focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-vestegns-deep-blues focus:ring-offset-2 transition ease-in-out duration-150">Vis Øvelser</button></div>
            </form>


            <div class="border-t border-gray-200 py-5 mt-5">

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
            </div>
        </div>
    </div>
</x-app-layout>
