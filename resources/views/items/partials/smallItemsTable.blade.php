{{-- Table of items --}}
<div  class="table-responsive">
    <table id="items_table" class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->description}}</td>                  
                    <td>{{ $item->price}}</td>
                    <td>{{ $item->quantity}}</td>
                    <td>{{ $item->total_discounted_price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
