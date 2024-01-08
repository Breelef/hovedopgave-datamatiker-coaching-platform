<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@isset($title){{ $title . ' - ' }}@endisset{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        @if(auth()->check() && ! empty(auth()->user()->club) && isset(auth()->user()->club->theme_settings['primary_color']))
        <style type="text/css">
            .bg-vestegns-deep-blues { background-color: {{ auth()->user()->club->theme_settings['primary_color'] }} !important }

            .bg-primary-color { background-color: {{ auth()->user()->club->theme_settings['primary_color'] }} !important }
            .bg-primary-color-hover:hover { background-color: {{ auth()->user()->club->theme_settings['primary_color_hover'] }} !important }
            .bg-primary-color-hover-bg { background-color: {{ auth()->user()->club->theme_settings['primary_color_hover'] }} !important }
            .text-primary-color { color: {{ auth()->user()->club->theme_settings['primary_color'] }} !important }
            .bg-secondary-color { background-color: {{ auth()->user()->club->theme_settings['secondary_color'] }} !important }
            .text-secondary-color { color: {{ auth()->user()->club->theme_settings['secondary_color'] }} !important }
            .border-secondary-color { border-color: {{ auth()->user()->club->theme_settings['secondary_color'] }} !important }
        </style>
        @else
        <style type="text/css">
            .bg-vestegns-deep-blues { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color }} !important }

            .bg-primary-color { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color }} !important }
            .bg-primary-color-hover:hover { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color_hover }} !important }
            .bg-primary-color-hover-bg { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color_hover }} !important }
            .text-primary-color { color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color }} !important }
            .bg-secondary-color { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_secondary_color }} !important }
            .text-secondary-color { color: {{ app(App\Settings\GeneralSettings::class)->theme_secondary_color }} !important }
            .border-secondary-color { border-color: {{ app(App\Settings\GeneralSettings::class)->theme_secondary_color }} !important }
        </style>
        @endif
    </head>
    <body class="font-sans antialiased">

        <div x-data="{open: false }">
  <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
  <div x-show="open" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
    <!--
      Off-canvas menu backdrop, show/hide based on off-canvas menu state.

      Entering: "transition-opacity ease-linear duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "transition-opacity ease-linear duration-300"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div x-show="open" :class="{ 'opacity-100': open, 'opacity-0': !open }" class="fixed inset-0 bg-gray-900/80 transition-opacity ease-linear duration-300"></div>

    <div :class="{ 'translate-x-0': open, '-translate-x-full': !open }" class="fixed inset-0 flex transition ease-in-out duration-300 transform -translate-x-full">
      <!--
        Off-canvas menu, show/hide based on off-canvas menu state.

        Entering: "transition ease-in-out duration-300 transform"
          From: "-translate-x-full"
          To: "translate-x-0"
        Leaving: "transition ease-in-out duration-300 transform"
          From: "translate-x-0"
          To: "-translate-x-full"
      -->
      <div class="relative mr-16 flex w-full max-w-xs flex-1">
        <!--
          Close button, show/hide based on off-canvas menu state.

          Entering: "ease-in-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "ease-in-out duration-300"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
          <button @click="open = false" type="button" class="-m-2.5 p-2.5">
            <span class="sr-only">Close sidebar</span>
            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-primary-color px-6 pb-4">
          <div class="flex h-16 shrink-0 justify-center">
            @if(auth()->check() && ! empty(auth()->user()->club) && ! empty(auth()->user()->club->logo))
            <img class="h-16" src="{{asset('storage/'.auth()->user()->club->logo)}}" alt="">
            @else
            <img class="h-16" src="{{asset('images/masterclass-gul.png')}}" alt="">
            @endif
          </div>
          <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
              <li>
                <ul role="list" class="-mx-2 space-y-1">
                        <x-nav-item
                            href="dashboard"
                            svg="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                            title="Dashboard"
                            active-routes="dashboard">
                        </x-nav-item>

                        <x-nav-item
                            href="exercises.index"
                            svg="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"
                            title="Øvelser"
                            active-routes="exercises.index,exercises.show,exercises.bookmarks,categories.index">
                        </x-nav-item>

                        @if(Route::currentRouteName() === 'exercises.index' || Route::currentRouteName() === 'exercises.show' || Route::currentRouteName() === 'exercises.bookmarks' || Route::currentRouteName() === 'categories.index')
                            <li>
                                <div class="bg-primary-color-hover-bg text-secondary-color rounded-md p-1">
                                    <x-nav-item-section
                                        href="exercises.index"
                                        svg="M9 5l7 7-7 7"
                                        title="Find øvelser">
                                    </x-nav-item-section>

                                    <x-nav-item-section
                                        href="categories.index"
                                        svg="M9 5l7 7-7 7"
                                        title="Kategorier">
                                    </x-nav-item-section>

                                    <x-nav-item-section
                                        href="exercises.bookmarks"
                                        svg="M9 5l7 7-7 7"
                                        title="Mine favoritter">
                                    </x-nav-item-section>
                                </div>
                            </li>
                        @endif
                        <x-nav-item
                            href="training-plans.index"
                            svg="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"
                            title="Årsplan"
                            active-routes="training-plans.index,training-plans.show,session-groups.show,training-sessions.show">
                        </x-nav-item>

                        <x-nav-item
                            href="guides.index"
                            svg="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                            title="Vejledninger"
                            active-routes="guides.index">
                        </x-nav-item>

                        <x-nav-item
                            href="clubs.index"
                            svg="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"
                            title="Samarbejdsklubber"
                            active-routes="clubs.index">
                        </x-nav-item>

{{--              <li>--}}
{{--                <div class="text-xs font-semibold leading-6 text-secondary-color">Dine hold</div>--}}
{{--                <ul role="list" class="-mx-2 mt-2 space-y-1">--}}
{{--                    <li>--}}
{{--                        <a href="#" class="text-secondary-color   group group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">--}}
{{--                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-secondary-color bg-primary-color text-[0.625rem] font-medium text-secondary-color">U</span>--}}
{{--                            <span class="truncate">U-13</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#" class="text-secondary-color   group group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">--}}
{{--                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-secondary-color bg-primary-color text-[0.625rem] font-medium text-secondary-color">VS</span>--}}
{{--                            <span class="truncate">Vilkårlig Spiller</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#" class="text-secondary-color   group group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">--}}
{{--                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-secondary-color bg-primary-color text-[0.625rem] font-medium text-secondary-color">BM</span>--}}
{{--                            <span class="truncate">Brøndby Masterclass</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--              </li>--}}
                        <x-nav-item
                            href="profile.show"
                            svg="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"
                            title="Indstillinger"
                            active-routes="profile.show"
                            svgSecondary="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                        </x-nav-item>
                    </ul>
                </li>
            </ul>
         </nav>
       </div>
     </div>
   </div>
 </div>

 <!-- Static sidebar for desktop -->
  <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-primary-color px-6 pb-4">
      <div class="flex h-16 mt-3 shrink-0 justify-center">
        @if(auth()->check() && ! empty(auth()->user()->club) && ! empty(auth()->user()->club->logo))
        <img class="h-16" src="{{asset('storage/'.auth()->user()->club->logo)}}" alt="">
        @else
        <img class="h-16" src="{{asset('images/masterclass-gul.png')}}" alt="">
        @endif
      </div>
      <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
          <li>
            <ul role="list" class="-mx-2 space-y-1">
                <x-nav-item
                    href="dashboard"
                    svg="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                    title="Dashboard"
                    active-routes="dashboard">
                </x-nav-item>
                <x-nav-item
                    href="exercises.index"
                    svg="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"
                    title="Øvelser"
                    active-routes="exercises.index,exercises.show,exercises.bookmarks,categories.index">
                </x-nav-item>
                @if(Route::currentRouteName() === 'exercises.index' || Route::currentRouteName() === 'exercises.show' || Route::currentRouteName() === 'exercises.bookmarks' || Route::currentRouteName() === 'categories.index')
                <li>
                    <div class="bg-primary-color-hover-bg text-secondary-color rounded-md p-1">
                    <x-nav-item-section
                    href="exercises.index"
                    svg="M9 5l7 7-7 7"
                    title="Find øvelser">
                    </x-nav-item-section>

                    <x-nav-item-section
                        href="categories.index"
                        svg="M9 5l7 7-7 7"
                        title="Kategorier">
                    </x-nav-item-section>

                    <x-nav-item-section
                        href="exercises.bookmarks"
                        svg="M9 5l7 7-7 7"
                        title="Mine favoritter">
                    </x-nav-item-section>
                    </div>
                </li>
                @endif
                <x-nav-item
                    href="training-plans.index"
                    svg="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"
                    title="Årsplan"
                    active-routes="training-plans.index,training-plans.show,session-groups.show,training-sessions.show">
                </x-nav-item>
                <x-nav-item
                    href="guides.index"
                    svg="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                    title="Vejledninger"
                    active-routes="guides.index">
                </x-nav-item>
                <x-nav-item
                    href="clubs.index"
                    svg="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"
                    title="Samarbejdsklubber"
                    active-routes="clubs.index">
                </x-nav-item>
            </ul>
          </li>
{{--          <li>--}}
{{--            <div class="text-sm font-semibold leading-6 text-secondary-color">Dine hold</div>--}}
{{--            <ul role="list" class="-mx-2 mt-2 space-y-1">--}}
{{--              <li>--}}
{{--                <a href="#" class="text-secondary-color   group group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold bg-primary-color-hover">--}}
{{--                  <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-secondary-color bg-primary-color text-[0.625rem] font-medium text-secondary-color">U</span>--}}
{{--                  <span class="truncate">U-13</span>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--                <li>--}}
{{--                    <a href="#" class="text-secondary-color   group group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold bg-primary-color-hover">--}}
{{--                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-secondary-color bg-primary-color text-[0.625rem] font-medium text-secondary-color">VS</span>--}}
{{--                        <span class="truncate">Vilkårlig Spiller</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#" class="text-secondary-color   group group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold bg-primary-color-hover">--}}
{{--                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-secondary-color bg-primary-color text-[0.625rem] font-medium text-secondary-color">BM</span>--}}
{{--                        <span class="truncate">Brøndby Masterclass</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--          </li>--}}
{{--          <li class="mt-auto">--}}
{{--            <a href="{{ route('profile.show') }}" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 group--}}
{{--            {{Route::currentRouteName() === 'profile.show' ? 'bg-secondary-color text-primary-color'  : 'text-secondary-color bg-primary-color-hover'  }}">--}}
{{--              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />--}}
{{--              </svg>--}}
{{--              Indstillinger--}}
{{--            </a>--}}
{{--          </li>--}}
            <div class="-mx-2 mt-auto">
                <x-nav-item
                    href="profile.show"
                    svg="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"
                    title="Indstillinger"
                    active-routes="profile.show"
                    svgSecondary="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                </x-nav-item>
            </div>

        </ul>
      </nav>
    </div>
  </div>

  <div class="lg:pl-72">
    <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
      <button @click="console.log('Button clicked!'); open = true" type="button" class="-m-2.5 p-2.5 z-41 text-gray-700 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>

      <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <form class="relative flex flex-1" action="#" method="GET">

        </form>
        <div class="flex items-center gap-x-4 lg:gap-x-6">

          <!-- Profile dropdown -->
          <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="open.toString()" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              <span class="hidden lg:flex lg:items-center">
                  @if(auth()->check())
                      <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ auth()->user()->name }}</span>
                  @endif
              </span>
                <svg class="hidden flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <!--
              Dropdown menu, show/hide based on menu state.

              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
            <div x-show="open" class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <!-- Active: "bg-gray-50", Not Active: "" -->
              <a href="{{ route('profile.show') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Profiloplysninger</a>
              @can('access admin panel')
              <a href="{{ route('filament.admin.pages.dashboard') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Admin</a>
              @endcan
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('logout') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log af</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <main class="py-10">
      <div class="px-4 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>
</div>






        @stack('modals')

        @livewireScripts
        <script src="{{asset("js/imageHandling.js")}}"></script>
    </body>
</html>
