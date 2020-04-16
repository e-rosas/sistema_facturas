<div class="card shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col-md-9 text-left">
                <h6 class="text-uppercase text-default ls-1 mb-1">Nota de crédito</h6>
                <h2 class="text-primary mb-0">{{ $credit->number ?? 'Sin nota de crédito n' }}</h2>   
            </div>
            <div class="col-md-3">
                @if (is_null($credit))
                    <h2 class="text-default mb-0">Sin nota de crédito</h2>
                @else
                    <h2 class="text-primary mb-0">{{$credit->date->format('d-m-Y')}}</h2>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <div class="h4 font-weight-300">
                <span> {{ $credit->amount_due ?? 'Sin nota de crédito' }} </span>
            </div>
            <div class="h4 font-weight-300">
                <span> {{ $credit->exchange_rate ?? 'Sin nota de crédito' }} </span>
            </div>
            <div class="h4 font-weight-300">
                @if (is_null($credit))
                <span> {{  'Sin nota de crédito' }} </span>
            </div>
                @else
                <span> {{ $credit->concept() ?? 'Sin nota de crédito' }} </span>
            </div>
                @endif
                
            <div class="h4 font-weight-300">
                <span> {{ $credit->comments ?? 'Sin nota de crédito' }} </span>
            </div>
        </div>
    </div>
</div>