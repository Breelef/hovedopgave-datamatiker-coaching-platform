<li>
    <a href="{{ route($href) }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold
                {{ $isActive() ? 'bg-secondary-color text-primary-color'  : 'text-secondary-color bg-primary-color-hover' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{$svg}}" />
            @if($svgSecondary)
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{$svgSecondary}}"></path>
            @endif
        </svg>
        {{$title}}
    </a>
</li>
