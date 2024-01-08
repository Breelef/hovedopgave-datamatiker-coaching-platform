@foreach($categories as $child)
    <li>
        <span wire:click="handleSVGClick({{ $child->id }})" class="cursor-pointer">
            <button type="button"

                    class="text-secondary-color group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                {{ $child->name }}

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
            </button>
        </span>
        @if($child->categories)
            <ul style="display: {{ in_array($child->id, $openMenus) ? 'block' : 'none' }}" class="mt-1 px-2">
                <li>
                    @include('livewire.category.recursive-category', ['categories' => $child->categories])
                </li>
            </ul>
        @endif
    </li>
@endforeach
