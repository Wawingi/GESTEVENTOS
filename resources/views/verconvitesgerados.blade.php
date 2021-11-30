@extends('home')
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">GESTEVENTO !!!</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Administração</li>
                            <li class="breadcrumb-item active">Listar Eventos</li>
                            <li class="breadcrumb-item active">Ver Evento</li>
							<li class="breadcrumb-item active"><a href="#">Convites Gerados</a></li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br>
            @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong>
                    {{ session('warning')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalrandomico">
				<i class='fa  fa-plus-square'></i> Gerar Mais Convite
			</button><hr>		
			<div class="port m-b-20">
                <div id="convitesTable" class="portfolioContainer">
                                           
                </div>
            </div>
			<br>
        </div>
    </div>
</div>
<script>
    function carregarDataTable(){
        var id_evento = 25;
        $.ajax({
            url: "{{ url('pegaConvitesGerados') }}/"+id_evento,
            success:function(data){
                $('#convitesTable').html(data);
            },
            error: function(e)
            {
                alert('Erro ao carregar dados');
            }
        })
    }
    carregarDataTable();

	$(window).on('load', function () {
		var $container = $('.portfolioContainer');
		$container.isotope({
			filter: '*',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
	
		$('.portfolioFilter a').click(function(){
			$('.portfolioFilter .current').removeClass('current');
			$(this).addClass('current');
	
			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
			return false;
		});
	});
</script>
@stop