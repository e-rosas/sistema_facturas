<div class="modal fade" id="edit-letter-modal" tabindex="-1" role="dialog" aria-labelledby="edit-letter-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-2">Editar</h6>
                    </div>
                    <div class="card-body px-lg-4 py-lg-4">
                        <input type="hidden" id="update-letter-id">
                        <div class="form-group">
                            {{--  Number --}}
                            <div class="form-group {{ $errors->has('content') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <textarea type="text" rows="5" name="content" id="update-letter-content"
                                        class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}"
                                        value="{{ old('content') }}"></textarea>
                                </div>
                            </div>
                            {{--  Date  --}}
                            <div class="form-group {{ $errors->has('date') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="date" id="update-letter-date"
                                        class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                        value="{{ old('date') }}" required>
                                    @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--  comments  --}}
                            <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>
                                    <textarea type="text" rows="3" name="comments" id="update-letter-comments"
                                        class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                        value="{{ old('comments') }}" placeholder="Observaciones"></textarea>
                                    @if ($errors->has('comments'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--  status  --}}
                            <div class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-info"></i></span>
                                    </div>
                                    <select class="form-control" id="update-status-letter">
                                        <option value="0">{{ __('Enviado.') }}</option>
                                        <option value="1">{{ __('Aseguranza contestó') }}</option>
                                    </select>
                                </div>
                            </div>
                            {{--  reply  --}}
                            <div class="form-group {{ $errors->has('reply') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                                    </div>
                                    <textarea type="text" rows="6" name="reply" id="update-letter-reply"
                                        class="form-control {{ $errors->has('reply') ? ' is-invalid' : '' }}"
                                        value="{{ old('reply') }}" placeholder="Aseguranza contestó..."></textarea>
                                    @if ($errors->has('reply'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reply') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="update-letter" class="btn btn-success mt-4">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script>
    function showEditLetterModal(id){
        getLetter(id);
        $('#edit-letter-modal').modal('show')
    }
    function getLetter(id){
        $.ajax({
            url: "{{route('letters.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "letter_id" : id
            },
        success: function (response) {
                displayLetterData(response.data.id, response.data.status_n,
                    response.data.date2, response.data.content,
                    response.data.comments,response.data.reply);
            }
        });
        return false;
    }
    function displayLetterData(letter_id, status, date, content, comments, reply){
        document.getElementById("update-letter-id").value = letter_id;
        document.getElementById("update-letter-date").value = date;
        document.getElementById("update-letter-comments").value = comments;
        document.getElementById("update-letter-reply").value = reply;
        document.getElementById("update-letter-content").value = content;
        document.getElementById("update-status-letter").value = status;

      }

    function DisplayLetters(data){
        var letters = data;
        var output = "";
        var bg = "";
        for(var i = 0; i < letters.length; i++){
            bg=letters[i].status2==2 ? "table-success" : "" ;
            output +="<tr class=" +bg+"value="+letters[i].id+">"
            + "<td>" + letters[i].date + "</td>"
            + "<td>" + letters[i].content + "</td>"
            + "<td>" + letters[i].status + "</td>"
            + "<td>" + letters[i].comments + "</td>"
            +'<td class="text-right"><button class="btn btn-info btn-sm btn-icon" type="button" onClick="showEditLetterModal(\'' + letters[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
             +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="DeleteLetter(\'' + letters[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
            + "</tr>";
            }
        $('#letters_table tbody').html(output);
    }

    function updateLetter(id,  date, comments, reply, content, status){
        $.ajax({
            url: "{{route('letters.update')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "date": date,
                "comments": comments,
                "reply": reply,
                "content": content,
                "status": status,

            },
        success: function (response) {
            DisplayLetters(response.data);
            $('#edit-letter-modal').modal('hide')

            }
        });
            return false;
    }

    function DeleteLetter(id){
        var r = confirm("Eliminar el correo?");
        if(r){
            $.ajax({
                url: "{{route('letters.destroy')}}",
                dataType: 'json',
                type:"delete",
                data: {
                "_token": "{{ csrf_token() }}",
                "letter_id" : id
                },
                success: function (response) {
                    DisplayLetters(response.data);
            }
        });
        return false;
        }

    }



    $(document).ready(function(){
        $("#update-letter").click(function(){
            var letter_id = document.getElementById("update-letter-id").value;

            var date = document.getElementById("update-letter-date").value;

            var comments = document.getElementById("update-letter-comments").value;

            var reply = document.getElementById("update-letter-reply").value;
            var content = document.getElementById("update-letter-content").value;
            var status = document.getElementById("update-status-letter").value;
            updateLetter(letter_id, date, comments, reply, content, status);

        });
    });
</script>

@endpush
