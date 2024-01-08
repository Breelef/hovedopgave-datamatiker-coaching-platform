<div>
    <legend class="block font-medium mb-1">{{$title}}</legend>
    <input type="{{$type}}" name="{{$name}}" id="{{$id}}" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-vestegns-deep-blues sm:text-sm sm:leading-6" @if($min && $max) min="{{$min}}" max="{{$max}}" @endif placeholder="{{$placeholder}}" value="{{$value}}">
</div>
