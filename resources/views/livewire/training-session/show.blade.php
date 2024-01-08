<div>
    <div class="w-full mt-8 mb-16">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-center mb-3"> {{$trainingSession->sessionGroup->name}}</h1>
        <h1 class="text-xl sm:text-3xl md:text-4xl font-medium text-center text-gray-600"> {{$trainingSession->name}}</h1>
    </div>
    <div class="flex">
        <div class="flex-1 p-4">
            <div class="mb-4">
                <div class="flex flex-wrap space-x-4">
                    <div class="flex-1">
                        <label for="trainerCount" class="text-sm font-medium text-gray-700">Antal Trænere</label>
                        <input type="number" id="trainerCount" placeholder="Enter number of coaches" class="form-input block w-full" wire:model="trainerCount"/>
                    </div>
                    <div class="flex-1">
                        <label for="playerCount" class="text-sm font-medium text-gray-700">Antal Spillere</label>
                        <input type="number" id="playerCount" placeholder="Enter number of players" class="form-input block w-full" wire:model="playerCount"/>
                    </div>
                    <div class="flex-1">
                        <label for="duration" class="text-sm font-medium text-gray-700">Længde</label>
                        <input type="number" id="duration" placeholder="Enter duration" class="form-input block w-full" wire:model="sessionDuration"/>
                    </div>
                    <div class="flex-1">
                        <label for="selectView">Træningstype</label>
                        <select id= "selectView" class="form-select block w-full" wire:model="trainingType">
                            <option value="forløbstræning">Forløbstræning</option>
                            <option value="stationstræning">Stationstræning</option>
                        </select>
                    </div>
                    <div class="mt-auto">
                        <x-action-button title="Lav Træning" type="button" click="calculateSession"/>
                    </div>
{{--                    <button wire:click="calculateSession" type="button" class="rounded-md bg-primary-color mt-6 px-3.5 text-sm font-semibold text-secondary-color shadow-sm bg-primary-color-hover">Lav Træning</button>--}}
                    <button onclick="window.location.href='{{ route('training-sessions.print', $trainingSession) }}'" type="button" class="rounded-md bg-secondary-color mt-6 px-3.5 text-sm font-semibold text-primary-color shadow-sm bg-primary-color-hover">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 border border-gray-200">
        @if($trainingType === 'forløbstræning')
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 text-center text-xs font-medium text-gray-500 uppercase"></th>
                    @foreach($groups as $group)
                        <th scope="col" class="py-3 text-center text-xs font-medium text-gray-500 uppercase">
                            <div class="flex flex-col items-center justify-center">
                                {{ $group['name'] }}
                                <span>{{ $group['players'] }} spillere</span>
                            </div>
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @for($i = 0; $i < $trainingSession->exercises->count(); $i++)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Runde {{ $i + 1 }} <br>
                            <span>{{($sessionDuration ?: 90) / $trainingSession->exercises->count()}} minutter</span>
                        </td>
                        @foreach($groups as $group)
                            @php
                                $exercise = $trainingSession->exercises[$i] ?? null;
                            @endphp
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if($exercise)
                                    <a href="{{ route('exercises.show', $exercise) }}" class="block w-full h-full flex justify-center items-center">
                                        <div class="overflow-hidden rounded-lg bg-white shadow border-b border-gray-200 min-w-[10rem] max-w-[10rem] min-h-[6rem] max-h-[6rem]">
                                            <div class="px-2 py-3 sm:px-4 sm:py-5 text-center overflow-hidden">
                                                <p class="text-sm sm:text-base md:text-lg whitespace-nowrap overflow-ellipsis">{{$exercise->name}}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endfor
                </tbody>
            </table>
        @endif
        @if($trainingType === 'stationstræning')
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase"></th>
                    @foreach($groups as $group)
                        <th scope="col" class="py-3 text-center text-xs font-medium text-gray-500 uppercase">
                            <div class="flex flex-col items-center justify-center">
                                {{ $group['name'] }}
                                <span>{{ $group['players'] }} spillere</span>
                            </div>
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-400">
                @for($i = 0; $i < $trainingSession->exercises->count(); $i++)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Runde {{ $i + 1 }} <br>
                            <span>{{($sessionDuration ?: 90) / $trainingSession->exercises->count()}} minutter</span>
                        </td>
                        @foreach($groups as $group)
                            @php
                                $exercise = $groupedExercises[$group['name']][$i] ?? null;
                            @endphp
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if($exercise)
                                    <a href="{{ route('exercises.show', $exercise) }}" class="block w-full h-full flex justify-center items-center">
                                        <div class="overflow-hidden rounded-lg bg-white shadow border-b border-gray-200 min-w-[10rem] max-w-[10rem] min-h-[6rem] max-h-[6rem]">
                                            <div class="px-2 py-3 sm:px-4 sm:py-5 text-center overflow-hidden">
                                                <p class="text-sm sm:text-base md:text-lg whitespace-nowrap overflow-ellipsis">{{$exercise->name}}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endfor
                </tbody>
            </table>
        @endif
    </div>
    <div class="flex mt-3">
        <div class="flex-1 max-w-7xl mr-3 sm:px-6 lg:px-8 border">
            <h1 class="text-center text-2xl font-semibold mt-2 underline">Anbefalinger</h1>
            @if($playerRecommendation != "")
                <p><span class="underline text-lg mt-7">Spillere</span>: {{$playerRecommendation}}</p>
            @endif
        </div>
        <div class="flex-3">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left font-semibold uppercase">Udstyr</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Navn</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Antal</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($equipmentList as $equipment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{asset('storage/' . $equipment['image'])}}" alt="Equipment Image" class="w-16 h-16 object-cover">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-semibold">{{$equipment['name']}}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-semibold">{{$equipment['quantity']}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
