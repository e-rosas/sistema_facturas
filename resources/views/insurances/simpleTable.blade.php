{{-- Table of insurances --}}
<div class="table-responsive">
    <table id="insurances-table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('ID Aseguranza') }}</th>
                <th scope="col">{{ __('Tipo') }}</th>
                <th scope="col">{{ __('Grupo') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insurances as $insurance)
                <tr>
                    <td>{{ $insurance->insurance_id }}</td>
                    <td>{{ $insurance->type }}</td>
                    <td>{{ $insurance->group_number }}</td>

                </tr>
                @if ($notSent)
                <td><input type="checkbox" name="insurances[]" value="{{ $insurance->id }}" checked></td>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
