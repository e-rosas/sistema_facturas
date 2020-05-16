{{-- Table of services --}}
<div  class="table-responsive">
    <table id="diagnoses_table" class="table align-services-center table-flush">
        <thead class="thead-dark">
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