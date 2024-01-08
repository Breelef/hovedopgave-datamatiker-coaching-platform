<select name="age_groups"
        id="age_groups"
        wire:model="selectedAgeGroupId"
        wire:change="handleAgeGroupChange"
        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-vestegns-deep-blues sm:max-w-xs sm:text-sm sm:leading-6">
    <option value="">Vælg årgang</option>
    @foreach($ageGroups as $age)
        <option value="{{$age->id}}" @if($age->id == $selectedAgeGroupId) selected @endif>{{ $age->name }}</option>
    @endforeach
</select>
