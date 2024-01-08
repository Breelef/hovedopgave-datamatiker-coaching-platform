<div>

    <x-age-group-dropdown :ageGroups="$ageGroups" :selectedAgeGroupId="$selectedAgeGroupId" />
    <div class="w-full mt-8 mb-16">
        @if($sessionGroup)
        <h1 class="text-4xl font-extrabold text-center mb-3">{{$ageGroup->name}}</h1>
            <div class="flex flex-row justify-center items-center">

                <x-svg-change-session :indexes="$indexes" index="{{$indexes['minIndex']}}" svg="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" wireMethod="getPreviousSession"/>
                <h1 class="text-2xl font-semibold text-center mb-3 mx-3">{{$sessionGroup->getDurationAsWeekStringAttribute()}}</h1>

                <x-svg-change-session :indexes="$indexes" index="{{$indexes['maxIndex']}}" svg="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" wireMethod="getNextSession"/>
            </div>
            <h1 class="text-xl sm:text-3xl md:text-4xl font-medium text-center text-gray-600"> {{$sessionGroup->name}}</h1>
    </div>
    <div>
        <x-all-training-sessions
        :sessionGroup="$sessionGroup"/>
        @else
            <h1 class="text-xl sm:text-3xl md:text-4xl font-medium text-center text-gray-600"> Ingen Træningsplan</h1>
        @endif
    </div>
</div>
