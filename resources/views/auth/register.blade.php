<x-guest-layout>
    <div class="bg-vestegns-deep-blues">
        <x-authentication-card>
            <x-slot name="logo">
                <div class="flex mt-3 justify-center">
                    <img class="h-32 w-36" src="{{asset('images/masterclass-gul.png')}}" alt="{{ config('app.name') }}">
                </div>
            </x-slot>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Navn') }}" class="text-lys-sol-over-vestegnen" />
                    <x-input id="name" class="block mt-1 w-full text-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <livewire:get-clubs />

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-lys-sol-over-vestegnen" />
                    <x-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-lys-sol-over-vestegnen" />
                    <x-input id="password" class="block mt-1 w-full text-black" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-lys-sol-over-vestegnen" />
                    <x-input id="password_confirmation" class="block mt-1 w-full text-black" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-lys-sol-over-vestegnen hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-action-button
                        title="Register"
                        type="submit"
                        value="Submit">
                    </x-action-button>
                </div>
            </form>
        </x-authentication-card>
    </div>

</x-guest-layout>
