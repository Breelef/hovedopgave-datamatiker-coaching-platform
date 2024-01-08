<x-app-layout :title="'Vejledninger'">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full mb-16">
            <h1 class="text-4xl font-semibold text-center">Vejledninger</h1>
        </div>
        <div class="flex">
            <div class="border-t border-gray-200 py-5 mt-5 w-full">
                @if($guides && $guides->isNotEmpty())
                    <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                        @foreach($guides as $guide)
                            <li class="relative">
                                <a href="{{ route('guides.show', $guide) }}">
                                    <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 min-h-[175px] max-h-[175px]">
                                        <img src="{{asset('storage/' . $guide->image)}}" alt="Guide image" class="pointer-events-none object-cover w-full  group-hover:opacity-75">
                                    </div>
                                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">
                                        {{$guide->title}}</p>
                                    <p class="pointer-events-none block text-sm font-medium text-gray-500">{{$guide->updated_at}}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center">
                        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                        <h3 class="mt-2 text-lg font-semibold text-gray-900">Ingen vejledninger i databasen</h3>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
