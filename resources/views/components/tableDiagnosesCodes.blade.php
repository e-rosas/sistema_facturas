{{-- Table of services --}}
<div  class="table-responsive">
    <table id="diagnoses_table" class="table align-services-center table-flush">
        <tbody>
            
            @for ($i = 1; $i <= count($diagnoses_services->diagnoses); $i++)
                @for ($j = 1; $j <= count($diagnoses_services->diagnoses[$i]->diagnoses); $j++)
                    
                @endfor
            @endfor
            
            @foreach ($diagnoses_services as $diagnoses)
                @foreach ($diagnoses->services as $service)
                    <tr> 
                        <td><a  href="{{ route('services.show', $service->service) }}">{{ $service->service->code }}</a></td>
                        <td>{{ $service->description}}</td>
                        <td>{{ $service->DOS->format('d-m-Y') }}</td>
                        <td>{{ $service->DOS_to->format('d-m-Y') }}</td>
                        <td>{{ $service->discounted_price}}</td>
                        <td>{{ $service->quantity}}</td>
                        <td>{{ $service->total_discounted_price}}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>