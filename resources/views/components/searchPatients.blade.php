<!-- For defining autocomplete -->
<div class="row">
  <select id='patient_id' class="custom-select form-control" name="patient_id" style="width: 100%">
    <option value='0'>Seleccionar paciente</option>
  </select>
  <input type="hidden" id="input-patient_id" value=0>
</div>

@push('js')
<!-- Script -->
<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){



  $("#patient_id").select2({
    minimumInputLength: 3,
    ajax: {
      url: "{{route('patients.searchName')}}",
      type:'post',
      dataType: 'json',
      delay: 250,
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
@push('headjs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush
