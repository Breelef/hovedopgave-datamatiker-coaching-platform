<div>
    <div class="w-full mt-8 mb-8">
        @if($sessionGroup)
            <div class="flex flex-col items-center justify-center text-center">
                <x-age-group-dropdown :ageGroups="$ageGroups" :selectedAgeGroupId="$selectedAgeGroupId" />
            </div>
            <div class="flex flex-row justify-center items-center">

                <x-svg-change-session :indexes="$indexes" index="{{$indexes['minIndex']}}" svg="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" wireMethod="getPreviousSession"/>
                <h1 class="text-2xl font-semibold text-center mb-3 mx-3">{{$sessionGroup->getDurationAsWeekStringAttribute()}}</h1>

                <x-svg-change-session :indexes="$indexes" index="{{$indexes['maxIndex']}}" svg="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" wireMethod="getNextSession"/>
            </div>
            <h1 class="text-xl sm:text-3xl md:text-4xl font-medium text-center text-gray-600"> {{$sessionGroup->name}}</h1>
    </div>
    <div>
        <div class="flex items-center justify-center">
            <div class="w-full max-w-4xl mx-auto">
                <x-all-training-sessions :sessionGroup="$sessionGroup"/>
            </div>
        </div>

    @else
            <div class="text-center mt-12">
                <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>

                <h3 class="mt-2 text-xl font-semibold text-gray-900">Ingen Træningsplaner</h3>
                <p class="mt-1 text-sm text-gray-500">Der er ingen træningsplaner der bliver vist lige nu.</p>
                <p class="mt-1 text-sm text-gray-500">Klik på den aldersgruppe du gerne vil se træningsplanen for i dropdown menuen</p>
                <div class="flex flex-col items-center justify-center text-center mt-6">
                    <x-age-group-dropdown :ageGroups="$ageGroups" :selectedAgeGroupId="$selectedAgeGroupId" />
                </div>
            </div>
        @endif
    </div>
</div>
