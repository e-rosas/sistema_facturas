<!-- For defining autocomplete -->
  <select id='item_id' class="custom-select form-control" name="item_id" style="width: 80%"> 
    <option value='0'>Seleccionar artículo</option>
  </select>


@push('js')
<!-- Script -->
<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){



  $("#item_id").select2({
    minimumInputLength: 2,
    ajax: {
      url: "{{route('items.search')}}",
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

