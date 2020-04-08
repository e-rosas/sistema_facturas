<div class="modal fade bd-example-modal-lg" id="modal-service" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">{{ __('Information') }}</h5>

                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form method="post" action="{{ route('service.update') }}"  autocomplete="off">
                            @csrf
                            @method('patch')
                            <h6 class="heading-small text-muted mb-4">{{ __('Service information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-row">
                                    {{--  service--}}
                                    <input type="hidden"  readonly  name="service_id" id="input-service_id" class="form-control"
                                     required>
                                    {{--  Code --}}
                                    <div class="col-md-4 col-auto form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-code">{{ __('Code') }}</label>
                                        <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Code') }}" value="{{ old('code') }}">
                                    
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  Descripcion  --}}
                                    <div class="col-md-8 col-auto form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                        <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>
                                    
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    
                                    {{--  total_price  --}}
                                    <div class="col-md-4 col-auto form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-total_price">{{ __('Total price') }}</label>
                                        <input type="numeric" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Total price') }}" value="{{ old('price') }}" required>
                                    
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  Discount  --}}
                                    <div class="col-md-4 col-auto form-group{{ $errors->has('discounted_price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-discounted_price">{{ __('Discounted price') }}</label>
                                        <input type="numeric" name="discounted_price" id="input-discounted_price" class="form-control form-control-alternative{{ $errors->has('discounted_price') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Discounted price') }}" value="{{ old('discounted_price') }}" required>
                                    
                                        @if ($errors->has('discounted_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('discounted_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--  category --}}
                                    <input type="hidden"  readonly  name="category_id" id="input-category_id" class="form-control"
                                     required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>

    function ServiceData(service_id, code, description, 
        price, discounted_price, category_id){
            document.getElementById("input-service_id").value = service_id;
            document.getElementById("input-code").value = code;
            document.getElementById("input-description").value = description;
            document.getElementById("input-price").value = price;
            document.getElementById("input-discounted_price").value = discounted_price;
            document.getElementById("input-category_id").value = service_id;
            
    }

    function getServiceData(id){
        $.ajax({
            url: "{{route('services.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "service_id" : id
            },
        success: function (response) {                
                ServiceData(response.id,response.code, response.description, response.price, response.discounted_price,
                response.category_id);                                 
            }
        });
            return false;
    }
    
    $(document).ready(function(){
        $('#services_table').on("click", ".edit-service", function(event) {
            var id = $(this).data('service');
            getServiceData(id);


        })
    });
</script>
@endpush