<!-- For defining autocomplete -->
  <select id='insuree_id' class="custom-select form-control{{ $errors->has('insuree_id') ? ' is-invalid' : '' }}" name="insuree_id"> 
    <option value='0'>Seleccionar asegurado</option>
  </select>

@push('js')
<!-- Script -->
<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){

    

  $("#insuree_id").select2({
    minimumInputLength: 3,
    ajax: { 
      url: "{{route('insurees.search')}}",
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