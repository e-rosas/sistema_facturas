@extends('layouts.app', ['title' => 'Productos'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Editar producto'])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Productos</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary">Regresar a la lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('items.update', $item) }}"  autocomplete="off">
                            @csrf
                            @method('patch')
                            <h6 class="heading-small text-muted mb-4">Datos del producto</h6>
                            <div class="pl-lg-4">
                                <div class="form-row">
                                    {{--  item--}}
                                    <input type="hidden"  readonly  name="item_id" id="input-item_id" value="{{ $item->id }}" class="form-control"
                                     required>
                                    {{--  Code --}}
                                    <div class="col-md-2 col-auto form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-code">Código SAT (interno)</label>
                                        <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                                        placeholder="Código" value="{{ $item->code }}">
                                    
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>
                                {{--  Descripcion  --}}
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">Description</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                    placeholder="Descripción" value="{{ $item->description }}" required>
                                
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Descripcion  --}}
                                <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-descripcion">Descripción</label>
                                    <input type="text" name="descripcion" id="input-descripcion" class="form-control form-control-alternative{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" 
                                    placeholder="Descripción" value="{{ $item->descripcion }}" required>

                                    @if ($errors->has('descripcion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-row">
                                    {{--  SAT --}}
                                    <div class="col-md-6 col-auto form-group{{ $errors->has('SAT') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-SAT">Código SAT (opcional)</label>
                                        <input type="text" name="SAT" id="input-SAT" class="form-control form-control-alternative{{ $errors->has('SAT') ? ' is-invalid' : '' }}" 
                                        placeholder="Código" value="{{ $item->SAT }}">

                                        @if ($errors->has('SAT'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('SAT') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    
                                    {{--  total_price  --}}
                                    <div class="col-md-4 col-auto form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-total_price">Precio total</label>
                                        <input type="numeric" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" 
                                        placeholder="Precio total" value="{{ $item->price }}" required>
                                    
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  Discount  --}}
                                    <div class="col-md-4 col-auto form-group{{ $errors->has('discounted_price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-discounted_price">Precio con descuento</label>
                                        <input type="numeric" name="discounted_price" id="input-discounted_price" class="form-control form-control-alternative{{ $errors->has('discounted_price') ? ' is-invalid' : '' }}" 
                                        placeholder="Precio con descuento" value="{{ $item->discounted_price }}" required>
                                    
                                        @if ($errors->has('discounted_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('discounted_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- tax --}}
                                    <div class="col-md-3 custom-control custom-checkbox">                                   
                                        <input type="checkbox" name="tax" id="custom-product-tax" class="custom-control-input" {{ $item->tax ? 'checked' : '' }}>        
                                        <label class="custom-control-label" for="custom-product-tax">IVA</label>       
                                    </div>
                                    {{--  category --}}
                                    <input type="hidden"  readonly  name="category_id" id="input-category_id" value="{{ $item->category_id }}" class="form-control"
                                     required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4 btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection