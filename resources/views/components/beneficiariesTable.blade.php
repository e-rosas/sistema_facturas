@include('components.searchInsurees2')
<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Phone') }}</th>
                <th scope="col">{{ __('Birth date') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beneficiaries as $beneficiary)
                <tr>
                    <td><a href="{{ route('beneficiaries.show', $beneficiary) }}">{{ $beneficiary->fullName()}}</a></td>
                    <td>
                        <a href="mailto:{{$beneficiary->person_data->email}}">{{ $beneficiary->person_data->email }}</a>
                    </td>
                    <td>{{ $beneficiary->person_data->phone_number }}</td>
                    <td>{{ $beneficiary->person_data->birth_date->format('M-d-Y')}}</td>
                    <td>
                        <div>
                            <input id="insuree_selected" type="numeric" name="insuree_id" required>
                            <button id="change_insuree" class="btn-sm btn-warning" onclick="change('{{ $beneficiary->id }}') ? this.parentElement.submit() : ''">
                                Change
                            </button>
                        </div>  
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav class="d-flex justify-content-end" aria-label="...">
        {{ $beneficiaries->links() }}
    </nav>
</div>

