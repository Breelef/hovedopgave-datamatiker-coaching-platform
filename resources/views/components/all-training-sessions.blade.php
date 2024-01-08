<div class="px-4 sm:px-6 lg:px-8">
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="flex flex-wrap -mx-2 items-center">
                    @foreach($sessionGroup->trainingSessions as $trainingSession)
                        <div class="@if($size) {{$size}} @endif px-2 mb-4">
                            <div x-data="{ url: '{{ route('training-sessions.show', $trainingSession) }}' }" @click="window.location = url" class="cursor-pointer border rounded p-4 hover:bg-gray-100 transition ease-in-out duration-150">
                                <h2 class="text-lg font-semibold text-gray-900 sm:pl-6 lg:pl-8 mb-3">{{ $trainingSession->name }}</h2>
                                @foreach($trainingSession->exercises as $exercise)
                                    <div class="py-2">
                                        <span class="text-sm font-medium text-gray-600">{{ $exercise->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
