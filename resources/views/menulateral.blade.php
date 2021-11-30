            <!-- ========== Inicio Menu Lateral ========== -->
            <div style="background-color:" class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Inicio</li>

                            <li>
                                <a href="{{ url('/dashboard') }}" class="waves-effect waves-primary"><i class="fas fa-home"></i><span> Página Inicial </span></a>
                            </li>
            
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fas fa-cogs"></i> <span> Administração </span>
                                    <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="{{ url('listarEvento') }}">Listar Eventos</a></li>
                                        <li><a href="{{ url('gerarapi') }}">Exportação de Dados</a></li> 
                                        <li><a href="{{ url('eventosdecorrer') }}">Eventos a Decorrer</a></li>                                                                                                                            
                                    </ul>
                                </li>
                           
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fas fa-bar-chart-o"></i>
                                    <span> Estatística </span> <span class="menu-arrow"></span> </a>
                                    <ul class="list-unstyled">
                                        <li><a href="#">Geral</a></li>
                                    </ul>
                                </li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-user-circle"></i>
                                    <span> Utilizadores </span> <span class="menu-arrow"></span> </a>
                                    <ul class="list-unstyled">                                    
                                        <li><a href="{{ url('listarUtilizadores')}}">Listar Utilizadores</a></li>
                                    </ul>
                                </li>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Fim menu lateral -->