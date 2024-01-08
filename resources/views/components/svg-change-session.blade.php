@if($indexes['currentIndex'] != $index)
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer mb-2" wire:click="{{$wireMethod}}">
        <path stroke-linecap="round" stroke-linejoin="round" d="{{$svg}}" />
    </svg>
@endif
