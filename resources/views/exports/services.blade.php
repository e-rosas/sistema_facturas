<h1>test</h1>
@foreach ($categories as $category)
<table>
    <thead>
    <tr>
        <th>{{ $category->nombre }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($category->services2 as $service)
        <tr>
            <td>{{ $service->descripcion }}</td>
            <td>{{ $service->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endforeach

