<div class="col-xl-3 col-lg-6">
    <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">{{ $title }}</h5>
                    <span id="{{ $idMXN ?? 'mxn' }}" class="MXN" style="{{ $USD == 1 ? 'display: none' : '' }}"> {{ $valueMXN ?? 0 }} </span><span id="{{ $idUSD ?? 'idUSD' }}" class="USD" style="{{ $USD == 1 ? '' : 'display: none' }}" > {{ $value }} </span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape {{ $bg ?? 'bg-orange'  }} text-white rounded-circle shadow">
                        <i class="{{ $icon ?? 'fas fa-dollar-sign' }}  "></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

