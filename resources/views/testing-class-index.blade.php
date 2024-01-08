<h1>Alle testing class objekter</h1>
<table>
    <tr>
        <th>Navn</th>
        <th>Nummer</th>
    </tr>

@foreach($testingClassObjects as $object)
        <tr>
            <td>{{$object->name}}</td>
            <td>{{$object->age}}</td>
        </tr>
@endforeach
</table>
