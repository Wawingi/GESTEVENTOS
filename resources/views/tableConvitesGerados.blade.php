@foreach($convidados as $convidado)
    <div class="col-sm-6 col-lg-3 col-md-4 webdesign illustrator">
        <div class="gal-detail thumb">
            <a href='{{ url("images/qrcodes/{$pasta}/{$convidado->nome}".".png") }}' class="image-popup" title="Screenshot-1">
                <img src='{{ url("images/qrcodes/{$pasta}/{$convidado->nome}".".png") }}' class="thumb-img" alt="work-thumbnail">
            </a>
            <h4 class="text-center">{{$convidado->nome}}</h4>
        </div>
    </div>  
@endforeach      