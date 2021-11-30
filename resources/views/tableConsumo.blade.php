@foreach($consumos as $consumo)
    <tr>
        <td style="text-align: center">{{ $loop->iteration }}</td>
        <td style="text-align: center">{{ $consumo->categoria }}</td>
        <td style="text-align: center">{{ $consumo->designacao }}</td>
        <td style="text-align: center">{{ $consumo->quantidade_registada }}</td>
        <td style="text-align: center;word-spacing: 10px">
            <a href="#" id="{{$consumo->id}}" class="eliminar btn btn-danger btn-sm" title='eliminar'><i class='fa fa-trash-alt'></i></a>
        </td>
    </tr>
@endforeach