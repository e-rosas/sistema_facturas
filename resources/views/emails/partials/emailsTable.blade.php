<div class="table-responsive">
    <table class="table table-flush" style="table-layout: fixed">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Fecha') }}</th>
                <th style="width: 20%;" scope="col">{{ __('Cobros') }}</th>
                <th scope="col">{{ __('Estado') }}</th>
                <th scope="col">{{ __('Comentarios') }}</th>
                <th scope="col">{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($letters as $letter)
            <tr>
                <td>{{ $letter->date->format('M-d-Y')}}</td>
                <td>
                    <span style="overflow: hidden; text-overflow: ellipsis; display:block">{{ $letter->content }}</span>
                </td>
                <td>{{ $letter->status() }}</td>
                <td>{{ $letter->comments }}</td>
                <td class="td-actions text-right">
                    <button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                        onClick="showEditLetterModal({{ $letter->id }})">
                        <i class="fas fa-pencil-alt fa-2 "></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
