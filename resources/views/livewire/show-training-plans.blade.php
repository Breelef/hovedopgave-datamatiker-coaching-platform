<div>
    <x-age-group-dropdown :ageGroups="$ageGroups" :selectedAgeGroupId="$selectedAgeGroupId" />
    @if($trainingPlans && !$trainingPlans->isEmpty())
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
        <h1>Ingen Træningsplaner</h1>
    @endif
</div>
