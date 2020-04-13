<!-- For defining autocomplete -->
<div class="row">
  <select id='service_id' class="custom-select form-control{{ $errors->has('service_id') ? ' is-invalid' : '' }}" name="service_id"> 
    <option value='0'>Seleccionar servicio</option>
  </select>
</div>

@push('js')
<!-- Script -->
<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){

    

  $("#service_id").select2({
    minimumInputLength: 3,
    ajax: { 
      url: "{{route('services.search')}}",
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
        console.log(response);
        document.getElementById("custom-price").value = parseFloat(response[0].price.replace(/,/g,'')); 
        document.getElementById("custom-discounted-price").value =parseFloat(response[0].discounted_price.replace(/,/g,'')); 
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