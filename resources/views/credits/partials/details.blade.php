<div class="card bg-gradient-default shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase text-light ls-1 mb-1">Nota de crédito</h6>
                <h2 class="text-white mb-0">{{ $credit->number ?? 'Sin nota de crédito' }}</h2>
            </div>
            <div class="col">
                <h2 class="text-white mb-0">{{ $credit->date->format('d-m-Y') ?? 'Sin nota de crédito' }}</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <div class="h4 font-weight-300">
                <span> {{ $credit->amount_due }} </span>
            </div>
            <div class="h4 font-weight-300">
                <span> {{ $credit->exchange_rate }} </span>
            </div>
            <div class="h4 font-weight-300">
                <span> {{ $credit->concept() }} </span>
            </div>
            <div class="h4 font-weight-300">
                <span> {{ $credit->comments }} </span>
            </div>
        </div>
    </div>
</div>