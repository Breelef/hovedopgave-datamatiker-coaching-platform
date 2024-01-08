<x-guest-layout>
    <div class="bg-vestegns-deep-blues">
        <x-authentication-card>

            <x-slot name="logo">
                <div class="flex mt-3 justify-center">
                    <img class="h-32 w-36" src="{{asset('images/masterclass-gul.png')}}" alt="{{ config('app.name') }}">
                </div>
            </x-slot>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-lys-sol-over-vestegnen"/>
                    <x-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-lys-sol-over-vestegnen"/>
                    <x-input id="password" class="block mt-1 w-full text-black" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4 hidden">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" checked="checked" name="remember" />
                        <span class="ml-2 text-sm text-lys-sol-over-vestegnen">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-lys-sol-over-vestegnen hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                        <x-action-button
                            title="Log In"
                            type="submit"
                            value="Submit">
                        </x-action-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
