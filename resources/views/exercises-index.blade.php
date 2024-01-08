<x-app-layout :title="'Øvelsesbank'">
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full mb-16">
                    <h1 class="text-4xl font-semibold text-center">Øvelsesbank</h1>
                </div>

                <form method="GET" action="/exercises?filter">
                    <div class="grid grid-cols-4 grid-rows-1 gap-4 text-sm">

                        <x-dropdown-select-filters
                        title="Træningstype"
                        name="exercise_type"
                        :options="[
                            'football'=>'Fodbold',
                            'fitness'=>'Fitness'
                        ]"
                        :selectedOption="app('request')->input('exercise_type')"/>


                        <x-dropdown-select-filters
                        title="Årgang"
                        name="age_groups"
                        :options="$ageGroups->pluck('name', 'age')->toArray()"
                        :selectedOption="app('request')->input('age_groups')"
                        defaultText="Vælg Årgang"/>

                        <x-input-filters
                        title="Spillere"
                        type="number"
                        name="players"
                        id="filter-players"
                        placeholder="Antal spillere"
                        value="{{app('request')->input('players') }}"
                        min="1"
                        max="100"
                        />

                        <x-input-filters
                        title="Søgning"
                        type="text"
                        name="search"
                        id="filter-search"
                        placeholder="Indtast Søgeord"
                        value="{{app('request')->input('search')}}"/>

                        <div>
                            <legend class="block font-medium mb-1">Øvelsestype</legend>
                            <div class="space-y-1">
                                <x-checkbox-filters
                                id="activity_type-0"
                                name="activity_type[]"
                                value="spil"
                                ifCondition="{{is_array(app('request')->input('activity_type')) && in_array('spil', app('request')->input('activity_type'))}}"
                                title="Spil"/>

                                <x-checkbox-filters
                                    id="activity_type-1"
                                    name="activity_type[]"
                                    value="øvelse"
                                    ifCondition="{{is_array(app('request')->input('activity_type')) && in_array('øvelse', app('request')->input('activity_type'))}}"
                                    title="Øvelse"/>
                            </div>
                        </div>

                        <div>
                            <legend class="block font-medium mb-1">Mental</legend>
                            <div class="space-y-1">
                                @foreach($tags as $tag)
                                <x-checkbox-filters
                                id="mental-{{ $tag->id }}"
                                name="mental[]"
                                value="{{$tag->id}}"
                                ifCondition="{{is_array(app('request')->input('mental')) && in_array($tag->id, app('request')->input('mental'))}}"
                                title="{{$tag->name}}"/>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-action-button
                            title="Vis Øvelser"
                            type="submit"
                            value="Submit">
                        </x-action-button>
                    </div>
                </form>
                <div class="flex">
                    <div class="border-t border-gray-200 py-5 mt-5 w-4/5">
                        @if($exercises && $exercises->isNotEmpty())
                            <x-show-exercises
                                :exercises="$exercises"/>
                        @else
                            <div class="text-center">
                                <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>

                                <h3 class="mt-2 text-lg font-semibold text-gray-900">Søg på Øvelser</h3>
                                <p class="mt-1 text-lg text-gray-500">Du kan bruge filteret til at filtrere øvelser</p>
                                <p class="mt-1 text-lg text-gray-500">Klik på knappen for at få øvelser fra øvelsesbanken</p>
                                <x-action-button title="Vis Øvelser" type="button"></x-action-button>
                                @endif
                            </div>
                    </div>
                </div>

        </div>
    </div>
</x-app-layout>
