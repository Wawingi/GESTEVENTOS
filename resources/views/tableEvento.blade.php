@foreach($eventos as $evento)
    <tr>
        <td style="text-align: center">{{ $loop->iteration }}</td>
        <td style="text-align: center">{{ $evento->tipo }}</td>
        <td style="text-align: center">{{ $evento->entidade }}</td>
        <td style="text-align: center">{{ $evento->local }}</td>
        <td style="text-align: center">
            @if(date(strtotime($evento->data)) >= date(strtotime('today')))
                <div class="progress progress-md m-b-20">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    {{ date('d/m/Y',strtotime($evento->data)) }}
                    </div>
                </div>
            @else
                <div class="progress progress-md m-b-20">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    {{ date('d/m/Y',strtotime($evento->data)) }}
                    </div>
                </div>
            @endif
        </td>
        <td style="text-align: center">{{ $evento->hora }}</td>
        <td style="text-align: center;word-spacing: 10px">
            <a href='{{ url("/ver/{$evento->id}") }}' class="btn btn-primary btn-sm" title='Ver'><i class='fa fa-eye'></i></a>
            <a href='{{ url("/verConsumo/{$evento->id}") }}' class="btn btn-primary btn-sm" title='Consumo'><i class='fas fa-dollar-sign'></i></a>
            <a href="#" id="{{$evento->id}}" class="pegar btn btn-warning btn-sm" title='editar'><i class='fa fa-pencil-alt'></i></a>
            <a href="#" id="{{$evento->id}}" class="eliminar btn btn-danger btn-sm" title='eliminar'><i class='fa fa-trash-alt'></i></a>
        </td>
    </tr>
@endforeach