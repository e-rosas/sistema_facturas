<!-- For defining autocomplete -->
<div class="row">
    <select id='location_id' class="custom-select form-control" name="location_id" style="width: 100%">
        <option value='0'>Seleccionar ubicación</option>
    </select>
    <input type="hidden" id="input-location_id" value=0>
</div>

@push('js')
<!-- Script -->
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function () {

        $("#location_id").select2({
            minimumInputLength: 3,
            ajax: {
                url: "{{route('locations.search')}}",
                type: 'post',
                dataType: 'json',
                delay: 350,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });

    });

</script>
@endpush
