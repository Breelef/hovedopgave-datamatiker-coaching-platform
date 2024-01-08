{{--<div class="flex">--}}
    <div class="w-1/5">
        <h1 class="font-medium mx-auto pt-10 pb-4 text-2xl">Kategorier</h1>
        <div class="bg-primary-color rounded-2xl">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <ul role="list" class="mx-2 space-y-1">
                        @foreach($parentCategories as $parent)
                            <li class="my-2">
                                <span wire:click="handleSVGClick({{ $parent->id }})" class="cursor-pointer">
                                    <button type="button" class="text-secondary-color group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold" aria-controls="sub-menu-1" aria-expanded="false"
                                         >
                                    {{ $parent->name }}
                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </span>
                                @if($parent->categories)
                                    <ul style="display: {{ in_array($parent->id, $openMenus) ? 'block' : 'none' }}" class="mt-1 px-2">
                                        <li>
                                            @include('livewire.category.recursive-category', ['categories' => $parent->categories])
                                        </li>
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
{{--    <div class="w-4/5 mx-3">--}}
{{--        <div class="w-full mb-16">--}}
{{--            <h1 class="text-4xl font-semibold text-center">Øvelsesbank</h1>--}}
{{--        </div>--}}
{{--        <div class="border-t border-gray-200 py-5 mt-5">--}}
{{--            @if($exercises && $exercises->isNotEmpty())--}}
{{--                <x-show-exercises--}}
{{--                :exercises="$exercises"/>--}}
{{--            @else--}}
{{--                <div class="text-center">--}}
{{--                    <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />--}}
{{--                    </svg>--}}

{{--                    <h3 class="mt-2 text-lg font-semibold text-gray-900">Søg på Øvelser via kategori</h3>--}}
{{--                    <p class="mt-1 text-lg text-gray-500">Du kan kategorierne til at finde de ønskede øvelser</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

