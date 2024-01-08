
<div class="mt-4">
    <label for="club">Hvilken klub hører du til?</label>
    <select id="club" name="club_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mb-4 mt-2 text-black">
        @foreach($clubs as $club)
            <option value="{{$club->id}}">{{$club->name}}</option>
        @endforeach
    </select>

    <label for="ageGroup">Hvilken aldersgruppe hører du til?</label>
    <select id="ageGroup" name="age_group_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-2 text-black">
        @foreach($ageGroups as $ageGroup)
            <option value="{{$ageGroup->id}}">{{$ageGroup->name}}</option>
        @endforeach
    </select>
</div>
