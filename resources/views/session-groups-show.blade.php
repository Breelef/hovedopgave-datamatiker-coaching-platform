<x-app-layout>
    <div>
        <div class="w-full mt-8 mb-16">
            <h1 class="text-4xl font-semibold text-center mb-3">{{$sessionGroup->getDurationAsWeekStringAttribute()}}</h1>
            <h1 class="text-xl sm:text-3xl md:text-4xl font-medium text-center text-gray-600"> {{$sessionGroup->name}}</h1>
        </div>
        <x-all-training-sessions
        :sessionGroup="$sessionGroup"
        size="w-1/3"/>
    </div>
</x-app-layout>
