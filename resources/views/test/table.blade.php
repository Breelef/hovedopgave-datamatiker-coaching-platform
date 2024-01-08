<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->

</head>
<body class="antialiased">

<div>

    <div class="mt-10 p-10">

        <div class="w-full mx-auto text-center">
            <h1 class="text-3xl mb-4">Træningsplan</h1>
            <div class="lowercase text-sm md:text-base">
                <div class="flex gap-1 my-1">
                    <div class="text-xs p-2 bg-gray-100" style="width: 30%">
                        <span class="block font-bold">Runde 1</span>
                        <span class="text-xxs">30 minutter</span>
                    </div>
                    <div class="text-xs p-2 bg-gray-100" style="width: 30%">
                        <span class="block font-bold">Runde 2</span>
                        <span class="text-xxs">30 minutter</span>
                    </div>
                    <div class="text-xs p-2 bg-gray-100" style="width: 20%">
                        <span class="block font-bold">Runde 3</span>
                        <span class="text-xxs">20 minutter</span>
                    </div>
                    <div class="text-xs p-2 bg-gray-100"  style="width: 20%">
                        <span class="block font-bold">Runde 4</span>
                        <span class="text-xxs">20 minutter</span>
                    </div>
                    <div class="text-xs p-2 bg-gray-100"  style="width: 20%">
                        <span class="block font-bold">Runde 4</span>
                        <span class="text-xxs">20 minutter</span>
                    </div>
                </div>
                <div class="flex gap-1 my-1">
                    <div style="width: 30%">
                        <div class="flex items-center h-full training-1 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 KAOS</div>
                        </div>
                    </div>
                    <div style="width: 30%">
                        <div class="flex items-center h-full training-2 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 MED SCORINGSZONE</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-3 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">SCHALKE-ØVELSEN MED FINTER</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-4 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">2V1 MED TRE AKTIONER</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-4 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">2V1 MED TRE AKTIONER</div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-1 my-1">
                    <div style="width: 30%">
                        <div class="flex items-center h-full training-2 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 MED SCORINGSZONE</div>
                        </div>
                    </div>
                    <div style="width: 30%">
                        <div class="flex items-center h-full training-3 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">SCHALKE-ØVELSEN MED FINTER</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-4 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">2V1 MED TRE AKTIONER</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-1 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 KAOS</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-1 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 KAOS</div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-1 my-1">
                    <div style="width: 30%">
                        <div class="flex items-center h-full training-3 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">SCHALKE-ØVELSEN MED FINTER</div>
                        </div>
                    </div>
                    <div style="width: 30%">
                        <div class="flex items-center h-full training-4 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">2V1 MED TRE AKTIONER</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-1 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 KAOS</div>
                        </div>
                    </div>
                    <div style="width: 20%">
                        <div class="flex items-center h-full training-2 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 MED SCORINGSZONE</div>
                        </div>
                    </div><div style="width: 20%">
                        <div class="flex items-center h-full training-2 py-4 text-center">
                            <div class="w-full text-ellipsis overflow-hidden">1V1-2V2 MED SCORINGSZONE</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

</body>
</html>
