<div class="form-row">
    <div class="col-md-6 col-sm-12">
        <label>Línea 1</label>
        <label class="form-control-label">{{ $location->first_line }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>Billing Línea 1</label>
        <label class="form-control-label">{{ $location->billing_first_line }}</label>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 col-sm-12">
        <label>Línea 2</label>
        <label class="form-control-label">{{ $location->second_line }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>Billing Línea 2</label>
        <label class="form-control-label">{{ $location->billing_second_line }}</label>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 col-sm-12">
        <label>Línea 3</label>
        <label class="form-control-label">{{ $location->third_line }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>Billing Línea 3</label>
        <label class="form-control-label">{{ $location->billing_third_line }}</label>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 col-sm-12">
        <label>Línea 4</label>
        <label class="form-control-label">{{ $location->fourth_line }}</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>Billing Línea 4</label>
        <label class="form-control-label">{{ $location->billing_fourth_line }}</label>
    </div>
</div>
<div class="form-row">
    <div class="col-md-8">
        <label>Teléfono</label>
        <label class="form-control-label">{{ $location->phone_number }}</label>
    </div>
    <div class="col-md-4">
        <label>Default</label>
        <label class="form-control-label">{{ $location->default ? 'Si' : 'No' }}</label>
    </div>
</div>
