<div class="card shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col-md-9 text-left">
                <h6 class="text-uppercase text-default ls-1 mb-1">cargo</h6>
                <h2 id="charge-number" class="text-primary mb-0">{{ $charge->number ?? 'Sin cargo n' }}</h2>   
            </div>
            <div class="col-md-3">
                @if (is_null($charge))
                    <h2 id="charge-date" class="text-default mb-0">Sin cargo</h2>
                @else
                    <h2 id="charge-date" class="text-primary mb-0">{{$charge->date->format('d-m-Y')}}</h2>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <div class="h2 text-default font-weight-300">
                @if (is_null($charge))
                    <span id="charge-concept">Sin cargo</span>
                @else
                    <span id="charge-concept"> {{ $charge->concept() }} </span>          
                @endif
            </div>
            <div class="h4 font-weight-300">
                @if (is_null($charge))
                    <span id="charge-status">Sin cargo</span>
                @else
                    <span id="charge-status"> {{ $charge->status() }} </span>          
                @endif
            </div>
            <div class="h4 font-weight-300">Cantidad: 
                @if (is_null($charge))
                    <span id="charge-amount_charged">Sin cargo</span>
                @else
                    <span id="charge-amount_charged"> {{ $charge->getAmountCharged() }} </span>          
                @endif
            </div>
            <div class="h4 font-weight-300"> Tipo de cambio: 
                @if (is_null($charge))
                    <span id="charge-exchange_rate">Sin cargo</span>
                @else
                    <span id="charge-exchange_rate"> {{ $charge->getExchangeRate() }} </span>          
                @endif
            </div>
            
            <div class="h4 font-weight-300">
                <span id="charge-comments"> {{ $charge->comments ?? '' }} </span>
            </div>
        </div>
    </div>
</div>