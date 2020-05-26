<div class="custom-control custom-radio custom-control-inline">
    <input type="radio" onclick="displayUSD(0)"  id="customRadioInlineMXN" {{ $USD ? '' : 'checked'}} value="MXN" name="currency" class="custom-control-input">
    <label class="custom-control-label" for="customRadioInlineMXN">MXN</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
    <input type="radio" onclick="displayUSD(1)" id="customRadioInlineUSD" {{ $USD ? 'checked' : ''}}  value="USD" name="currency" class="custom-control-input">
    <label class="custom-control-label" for="customRadioInlineUSD">USD</label>
</div>
@push('js')
<script>
    function displayUSD(block){
        if(block){
            var elementsMXN = document.getElementsByClassName("MXN"); //elementsMXN is an array
            for(var i = 0; i < elementsMXN.length; i++){
                elementsMXN[i].style.display = "none"; 
            }
            var elementsUSD = document.getElementsByClassName("USD"); //elementsUSD is an array
            for(var i = 0; i < elementsUSD.length; i++){
                elementsUSD[i].style.display = "block"; 
            }

        }
        else{
            var elementsMXN = document.getElementsByClassName("MXN"); //elementsMXN is an array
            for(var i = 0; i < elementsMXN.length; i++){
                elementsMXN[i].style.display = "block"; 
            }
            var elementsUSD = document.getElementsByClassName("USD"); //elementsUSD is an array
            for(var i = 0; i < elementsUSD.length; i++){
                elementsUSD[i].style.display = "none"; 
            }
        }
    }
</script>
@endpush
  
  