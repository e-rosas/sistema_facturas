@extends('layouts.app', ['title' => 'Productos'])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Productos</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('items.create') }}" class="btn btn-sm btn-primary">Registrar nuevo producto</a>
                            </div>
                        </div>
                    </div>

                    <form  method="post" action="{{ route('items.searchIndex') }}" >
                        @csrf
                        <div class="form-group col-md-12 col-auto">
                            <label for="example-search-input" class="form-control-label">Buscar</label>
                            <input name="search" class="form-control" type="search" required placeholder="Buscar..." id="search">
                        </div>
                    </form>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Descuento</th>
                                    <th scope="col">IVA</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col"></th>
                                    {{-- <th scope="col"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td data-container="body" data-toggle="tooltip" data-placement="bottom" 
                                            title="{{ $item->clave() }}">{{ $item->code }}</td>
                                        <td data-container="body" data-toggle="tooltip" data-placement="bottom" 
                                            title="{{ $item->description }}">{{ $item->descripcion }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->discounted_price }}</td>
                                        <td>{{ $item->iva() }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td class="td-actions text-right">
                                            <a  rel="tooltip"  class="btn btn-info btn-sm btn-icon"  type="button" href="{{ route('items.edit', $item) }}">
                                                <i class="fas fa-pencil-alt fa-2"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $items->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection