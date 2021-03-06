<div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="card-header bg-warning border-0">
            <div class="row">
                <div class="col-8 col-auto">
                    <h3 style="color:white" class="card-title text-uppercase  mb-0">Aseguranza</h3>
                </div>
                @if ($update ?? false)
                    <div class="col-4 text-right">
                        <button id="edit-insurance" type="button" class="btn btn-sm btn-default" data-toggle="modal"
                        data-target="#modal-change-insurance">Cambiar</i></button>
                    <br />
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body pt-0 pt-md-4">
            <div class="text-center">
                <h3>
                    {{ $insurer->name }}<span class="font-weight-light"></span>
                </h3>
                <div class="h4 font-weight-300">
                   <span><a  href=" {{ route('insurers.show', $insurer) }} " class="mr-4">{{ $insurer->code }}</a></span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $insurer->address }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $insurer->addressDetails() }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $insurer->phone_number }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <a href="mailto:{{$insurer->email}}">{{$insurer->email}}</a>
                </div>
            </div>
        </div>
    </div>
</div>