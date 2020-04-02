<div class="modal fade bd-example-modal-lg" id="modal-person_data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">{{ __('Information') }}</h5>

                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        @include('components.editPerson')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>

    function getInsureeData(id){
        $.ajax({
            url: "{{route('insurees.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id" : id
            },
        success: function (response) {                
                PersonData(response.person_data.id,response.person_data.last_name, response.person_data.maiden_name, response.person_data.name, response.person_data.birth_date,
                response.person_data.address, response.person_data.city, response.person_data.state, response.person_data.postal_code, 
                response.person_data.phone_number, response.person_data.email);                                 
            }
        });
            return false;
    }
    
    $(document).ready(function(){
        $('#insurees_table').on("click", ".edit-person", function(event) {
            var id = $(this).data('person');
            getInsureeData(id);


        })
    });
</script>
@endpush