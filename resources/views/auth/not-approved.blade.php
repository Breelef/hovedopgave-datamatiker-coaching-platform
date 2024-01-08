<x-guest-layout>
    <div class="bg-vestegns-blues bg-cover" style="background-image: url({{ asset('images/background.jpeg') }});">
        <x-authentication-card>

            <x-slot name="logo">
                <div class="flex mt-3 justify-center">
                    <img class="w-32" src="{{asset('images/masterclass-gul.png')}}" alt="{{ config('app.name') }}">
                </div>
            </x-slot>

            <div class="p-4">
                <div class="font-bold rounded-full bg-gray-200 items-center justify-center mx-auto mb-4 h-32 w-32">

                    <svg class="m-auto content-center text-black h-32 w-16" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 7.5C15 7.5 15.5 7.5 16 8.5C16 8.5 17.5882 6 19 5.5" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 7C22 9.76142 19.7614 12 17 12C14.2386 12 12 9.76142 12 7C12 4.23858 14.2386 2 17 2C19.7614 2 22 4.23858 22 7Z" stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M2 10H2.75H2ZM10.4706 2.75C10.8848 2.75 11.2206 2.41421 11.2206 2C11.2206 1.58579 10.8848 1.25 10.4706 1.25V2.75ZM10.4706 22V22.75V22ZM2 14H1.25H2ZM11.5294 22V21.25V22ZM18.7595 20.8284L19.2745 21.3737L18.7595 20.8284ZM20.7499 14.4189C20.7501 14.0047 20.4145 13.6687 20.0003 13.6685C19.5861 13.6683 19.2501 14.0039 19.2499 14.4181L20.7499 14.4189ZM11.5294 21.25H10.4706V22.75H11.5294V21.25ZM2.75 14L2.75 10H1.25L1.25 14H2.75ZM2.75 10C2.75 8.09197 2.75178 6.74077 2.89758 5.71661C3.03964 4.71864 3.30515 4.14213 3.75546 3.71683L2.72552 2.62631C1.93534 3.37259 1.5806 4.32468 1.41255 5.50521C1.24822 6.65957 1.25 8.13679 1.25 10H2.75ZM10.4706 1.25C8.49411 1.25 6.94044 1.24858 5.72885 1.40242C4.49987 1.55847 3.50965 1.88575 2.72552 2.62631L3.75546 3.71683C4.21182 3.28582 4.84011 3.02731 5.91779 2.89047C7.01286 2.75142 8.454 2.75 10.4706 2.75V1.25ZM10.4706 21.25C8.454 21.25 7.01286 21.2486 5.91779 21.1095C4.84011 20.9727 4.21182 20.7142 3.75546 20.2832L2.72552 21.3737C3.50965 22.1142 4.49987 22.4415 5.72884 22.5976C6.94043 22.7514 8.4941 22.75 10.4706 22.75V21.25ZM1.25 14C1.25 15.8632 1.24822 17.3404 1.41255 18.4948C1.5806 19.6753 1.93534 20.6274 2.72552 21.3737L3.75546 20.2832C3.30515 19.8579 3.03964 19.2814 2.89758 18.2834C2.75178 17.2592 2.75 15.908 2.75 14H1.25ZM11.5294 22.75C13.5059 22.75 15.0596 22.7514 16.2712 22.5976C17.5001 22.4415 18.4904 22.1143 19.2745 21.3737L18.2445 20.2832C17.7882 20.7142 17.1599 20.9727 16.0822 21.1095C14.9871 21.2486 13.546 21.25 11.5294 21.25V22.75ZM19.2499 14.4181C19.2491 16.1827 19.2356 17.4394 19.0858 18.3947C18.9401 19.3239 18.6785 19.8734 18.2445 20.2832L19.2745 21.3737C20.0343 20.6561 20.392 19.7476 20.5677 18.6271C20.7393 17.5328 20.7491 16.1482 20.7499 14.4189L19.2499 14.4181Z" fill="#141B34"/>
                        <path d="M7 13H11" stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M7 17L15 17" stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>

                </div>

                <h2 class="text-2xl font-bold mb-4 text-center">Afventer godkendelse</h2>
                <p class="mb-4">Din konto afventer at blive godkendt af din klub.</p>
                <p class="mb-4">Så snart din konto er godkendt, vil vi underrette dig via <span class="font-bold">e-mail</span>. Derefter kan du begynde at udforske alt det, som [Website Name] har at tilbyde.</p>
                <p class="mb-4">Hvis du har spørgsmål, er du velkommen til at kontakte os på [Support Email Address].</p>
                <p>Tak fordi du oprettede dig. Vi glæder os til at have dig med ombord!</p>
            </div>

        </x-authentication-card>
    </div>
</x-guest-layout>
