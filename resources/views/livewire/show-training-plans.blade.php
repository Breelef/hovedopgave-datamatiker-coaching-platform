<div>
    @if($trainingPlans && !$trainingPlans->isEmpty())
        <x-age-group-dropdown :ageGroups="$ageGroups" :selectedAgeGroupId="$selectedAgeGroupId" />
        @foreach($trainingPlans as  $trainingPlan)
            <div>
                <div class="w-full mt-8 mb-16">
                    <h1 class="text-4xl font-semibold text-center"> {{$trainingPlan->name}}</h1>
                </div>
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="min-w-full border-separate border-spacing-0">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Periode</th>
                                        <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Navn</th>
                                        <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Træningsplan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trainingPlan->sessionGroups as $sessionGroup)
                                        <tr x-data="{ url: '{{ route('session-groups.show', $sessionGroup) }}' }" @click="window.location = url" class="cursor-pointer hover:bg-gray-200 transition ease-in-out duration-150">
                                            <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                {{$sessionGroup->getDurationAsWeekStringAttribute()}}</td>
                                            <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{$sessionGroup->name}}</td>
                                            <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                                                {{$trainingPlan->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center mt-40">
            <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
            </svg>

            <h3 class="mt-2 text-sm font-semibold text-gray-900">Ingen Træningsplaner</h3>
            <p class="mt-1 text-sm text-gray-500">Der er ingen træningsplaner der bliver vist lige nu.</p>
            <p class="mt-1 text-sm text-gray-500">Klik på den aldersgruppe du gerne vil se træningsplanen for i dropdown menuen</p>
            <div class="flex flex-col items-center justify-center text-center mt-6">
                <x-age-group-dropdown :ageGroups="$ageGroups" :selectedAgeGroupId="$selectedAgeGroupId" />
            </div>
        </div>
    @endif
</div>
