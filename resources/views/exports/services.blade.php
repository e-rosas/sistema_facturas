@foreach ($categories as $category)
<table>
    <thead>
    <tr>
        @if ($en)
        <th>{{ $category->name }}</th>
        @else
        <th>{{ $category->nombre }}</th>
        @endif
      
    </tr>
    </thead>
    <tbody>
    @foreach($category->services2 as $service)
        <tr>
            <td>{{ $service->code }}</td>
            @if ($en)
            <td>{{ $service->description }}</td>
            @else
            <td>{{ $service->descripcion }}</td>
            @endif
            
            <td>{{ $service->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endforeach

