<div class="flex items-center">
    <input id="{{$id}}" name="{{$name}}" value="{{$value}}" type="checkbox" @if($ifCondition) checked @endif class="h-4 w-4 rounded border-gray-300 text-primary-color focus:vestegns-deep-blues">
    <label for="{{$id}}" class="ml-3 text-sm text-gray-600">{{$title}}</label>
</div>
