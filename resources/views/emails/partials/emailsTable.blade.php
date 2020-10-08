<div class="table-responsive">
    <table class="table table-flush" style="table-layout: fixed" id="letters_table">
        <thead class="thead-light">
            <tr>
                <th style="width: 10%;" scope="col">{{ __('Fecha') }}</th>
                <th style="width: 50%;" scope="col">{{ __('Cobros') }}</th>
                <th style="width: 10%;" scope="col">{{ __('Estado') }}</th>
                <th style="width: 20%;" scope="col">{{ __('Comentarios') }}</th>
                <th style="width: 10%;" scope="col">{{ __('Acciones') }}</th>
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
                <td><span
                        style="overflow: hidden; text-overflow: ellipsis; display:block">{{ $letter->comments }}</span>
                </td>
                <td class="td-actions text-right">
                    <button class="btn btn-info btn-sm btn-icon" rel="tooltip" type="button"
                        onClick="showEditLetterModal({{ $letter->id }})">
                        <i class="fas fa-pencil-alt fa-2 "></i>
                    </button>
                    <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                        onClick="DeleteLetter({{ $letter->id }})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
