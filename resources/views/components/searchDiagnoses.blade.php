<!-- For defining autocomplete -->
<div class="col-md-8">
  <select id='diagnosis_id' class="custom-select form-control{{ $errors->has('service_id') ? ' is-invalid' : '' }}" name="service_id"> 
    <option value='0'>Seleccionar diagnostico</option>
  </select>
</div>

@push('js')
<!-- Script -->
<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){

    

  $("#diagnosis_id").select2({
    minimumInputLength: 2,
    ajax: { 
      url: "{{route('diagnoses.search')}}",
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
        document.getElementById("input-diagnosis_code").value = response[0].code; 
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
