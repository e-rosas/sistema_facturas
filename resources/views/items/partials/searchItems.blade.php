<!-- For defining autocomplete -->
  <select id='item_id' class="custom-select form-control" name="item_id" style="width: 90%">
    <option value='0'>Seleccionar producto</option>
  </select>


@push('js')
<!-- Script -->
<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

  $('#item_id').on('select2:select', function (e) {
    var data = e.params.data;
    document.getElementById("custom-product-price").value = parseFloat(data.price.replace(/,/g,''));
    document.getElementById("custom-product-tax").checked = data.tax;
    document.getElementById("custom-product-name").value = data.description;
    document.getElementById("custom-product-nombre").value = data.descripcion;
  });



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

