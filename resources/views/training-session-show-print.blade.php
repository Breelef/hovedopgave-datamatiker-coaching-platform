<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<h1>Træningsprogram: <span>{{$trainingSession->sessionGroup->trainingPlan->name}}</span></h1>
@php
    $trainingSessionTime = 0;
    foreach($trainingSession->exercises as $exercise){
         $trainingSessionTime += $exercise->pivot->duration;
    }
@endphp
<h2>Tema: <span>{{$trainingSession->sessionGroup->name}}</span> Tid: <span>{{$trainingSessionTime}}</span></h2>
@foreach($trainingSession->exercises as $exercise)
    <div class="max-w-[850px] mx-auto">
        <div class="w-full mt-8 mb-16">
            <h3 class="text-4xl font-semibold text-center"> {{$exercise->name}}</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4">
            <div class="col-span-1 px-3 order-1 sm:order-2">
                <h4 class="mb-3 text-xl font-semibold">Praktisk information</h4>
                <p class="mb-2"><span class="font-semibold">Aldersgruppe:</span> {{$exercise->age_from}} - {{$exercise->age_to}} år</p>
                <p class="font-semibold">Materialer:</p>
                @foreach($exercise->equipment as $equipment)
                    <div class="flex flex-row items-center">
                        <img src="{{ $equipment->base64Image }}" alt="Equipment Image" style="width: 100px; height: 100px;">
                        <p class="px-2"> {{$equipment->pivot->quantity}} - <span>{{$equipment->name}}</span></p>
                    </div>
                @endforeach
                <div class="my-2">
                    <p class=""><span class="font-semibold">Antal af spillere: </span> {{$exercise->players_from}} - {{$exercise->players_to}}</p>
                </div>
                <div class="">
                    <p class=""><span class="font-semibold">Øvelsestid: </span> {{$exercise->duration_from}} - {{$exercise->duration_to}}</p>
                </div>
            </div>
            <div class="col-span-2 px-3 order-2 sm:order-1">
                <div>
                    <img src="{{ $exercise->base64Image }}" alt="Exercise Image">
                </div>
                @foreach($exercise->description as $section)
                    <div>
                        <h4 class="mb-3 text-xl font-semibold">{{$section['title']}} </h4>
                        {!! $section['content'] !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr style="border-top: 2px solid black;" />
@endforeach
</body>
</html>
