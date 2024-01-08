<div>
    <legend class="block font-medium mb-1">{{$title}}</legend>
    <select name="{{$name}}" id="{{$name}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-vestegns-deep-blues sm:max-w-xs sm:text-sm sm:leading-6">
        @if($defaultText)
            <option value="" @if(empty($selectedOption)) selected @endif>{{$defaultText}}</option>
        @endif
        @foreach($options as $key => $value)
            <option value="{{$key}}" @if($key == $selectedOption) selected @endif>{{$value}}</option>
        @endforeach
    </select>
</div>
