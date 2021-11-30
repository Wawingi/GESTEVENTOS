<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}">

        <title>GESTEVENTO</title>
        
		<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ url('css/icons.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/estilo.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ url('css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.materialdesignicons.com/4.2.95/css/materialdesignicons.min.css"  rel="stylesheet">
        <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('plugins/jquery-circliful/css/jquery.circliful.css') }} " rel="stylesheet" type="text/css"/>    
        <script src="{{ url('js/jquery.min.js') }}"></script>
        <script src="{{ url('js/sweetalert2.min.js') }}"></script>
    </head>

    <body  class="fixed-left">
        <!-- Begin page -->
        <div  id="wrapper">
            
            <!-- ========== Inclusão do menu Bar ========== -->
            @include('menubar')
            <!-- ========== Inclusão do menu lateral ====== -->
            @include('menulateral')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            @yield('content')
            
            <!-- end content -->
           <footer class="footer">
                2018 © GESTEVENTO
           </footer>
        </div>
    </div>

    <script>
        var resizefunc = [];
    </script>

    <!-- Plugins  -->
    
    <script src="{{ url('js/modernizr.min.js') }}" type="text/javascript"></script>       
    <script src="{{ url('js/popper.min.js') }}"></script><!-- Popper for Bootstrap -->
    
    <!--<script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
    <script src="{{ url('js/bootstrap.min.js') }}"></script>


    <script type="text/javascript">
        //validação para adicionar dinamicamente acompanhante de convidado
         $(function(){
				// Clona a linha oculta que tem campos base e agrega no final da tabela
				$("#maisAcompanhante").on('click', function(){
					$("#tabela tbody tr:eq(0)").clone().removeClass('linha').appendTo("#tabela");
				});
			 
				// Evento que selecciona a linha e elimina 
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});
			});
       
       //validação do formulário do assento para cadeira sem capacidade
        document.getElementById("tipo").onchange = function() {
            alterar();
        };
        function alterar() {
            var dado = document.getElementById("tipo");
            var itemSelecionado = dado.options[dado.selectedIndex].value;
                if (itemSelecionado==="Cadeira") {
                    document.getElementById("el").style.display = 'none';
                }else {
                    document.getElementById("el").style.display = 'block';
                }
        }
    </script>  
    <!-- Plugins  -->  
    <script src="{{ url('js/modernizr.min.js') }}" type="text/javascript"></script>       
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/detect.js') }}"></script>
    <script src="{{ url('js/fastclick.js') }}"></script>
    <script src="{{ url('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ url('js/jquery.blockUI.js') }}"></script>
    <script src="{{ url('js/waves.js') }}"></script>
    <script src="{{ url('js/wow.min.js') }}"></script>
    <script src="{{ url('js/jquery.nicescroll.js') }}"></script>
    <script src="{{ url('js/jquery.scrollTo.min.js') }}"></script>

    <!-- Counter Up  -->
    <script src="{{ url('plugins/waypoints/lib/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>

    <!-- circliful Chart -->
    <script src="{{ url('plugins/jquery-circliful/js/jquery.circliful.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('plugins/jquery-sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>

    <!-- skycons -->
    <script src="{{ url('plugins/skyicons/skycons.min.js') }}" type="text/javascript"></script>
    <!-- Page js  -->
    <script src="{{ url('pages/jquery.dashboard.js') }}" type="text/javascript"></script>        
    <!-- Custom main Js -->
    <script src="{{ url('js/jquery.core.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/jquery.app.js') }}" type="text/javascript"></script>

    <!-- Gallery js -->
    <script src="{{ url('plugins/isotope/dist/isotope.pkgd.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('plugins/magnific-popup/dist/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>
</body>
</html>