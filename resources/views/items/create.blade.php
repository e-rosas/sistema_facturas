@extends('layouts.app', ['title' => 'Productos'])

@section('content')
    @include('layouts.headers.header', ['title' => 'Registrar nuevo producto'])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-auto">
                                <h3 class="mb-0">Productos</h3>
                            </div>
                            <div class="col-md-4 col-auto text-right">
                                <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary">Regresar a la lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('items.store') }}"  autocomplete="off">
                            @csrf                          
                            <h6 class="heading-small text-muted mb-4">Datos del producto</h6>
                            <div class="pl-lg-4">
                                <div class="form-row">
                                    {{--  Code --}}
                                    <div class="col-md-4 col-auto form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-code">Código</label>
                                        <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                                        placeholder="Código" value="{{ old('code') }}">
                                    
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  Descripcion  --}}
                                    <div class="col-md-8 col-auto form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-description">Descripción</label>
                                        <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                        placeholder="Descripción" value="{{ old('description') }}" required>
                                    
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    {{--  price  --}}
                                    <div class="col-md-4 col-auto form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-price">Precio</label>
                                        <input type="numeric" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" 
                                        placeholder="Precio" value="{{ old('price') }}" required>
                                    
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
                                        placeholder="Precio con descuento" value="{{ old('discounted_price') }}" required>
                                    
                                        @if ($errors->has('discounted_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('discounted_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>                              
                                </div>
                                <div class="form-row">
                                    {{--  Category  --}}
                                    <div class="form-group col-auto col-md-4">
                                        <label for="category_id" class="col-form-label">Categoría</label>
                                        <select class="custom-select form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        </select>                  
                                        @if ($errors)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Tax  --}}
                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">                                   
                                    <input type="checkbox" name="tax" id="input-tax" class="custom-control-input">        
                                    <label class="custom-control-label" for="input-tax">IVA Aplicable</label>       
                                </div>
                                
                                <div class="row">
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