{{-- Table of insurances --}}
<div class="table-responsive">
    <table id="insurances-table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('ID Aseguranza') }}</th>
                <th scope="col">{{ __('Grupo') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insurances as $insurance)
                <tr>
                    <td> <a href="{{ route('insurances.show', $insurance->id) }}">{{ $insurance->insurance_id }}</a>
                    </td>
                    <td>{{ $insurance->group_number }}</td>
                    @if ($notSent)
                        <td><input type="checkbox" name="insurances[]" value="{{ $insurance->id }}" checked></td>
                    @endif
                </tr>

            @endforeach
        </tbody>
    </table>
</div>
