{{-- Table of services --}}

<div class="table-responsive">
    <h5>Diagnósticos</h5>
    <table id="diagnoses_table" class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Código') }}</th>
                <th scope="col">{{ __('Nombre') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->diagnoses as $diagnosis)
            <tr>
                <td>{{ $diagnosis->diagnosis_code}}</td>
                <td>{{ $diagnosis->diagnosis->name}}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
