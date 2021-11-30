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
                                    <h4 class="page-title"> GESTEVENTO !!!</h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item">Administração</li>
                                        <li class="breadcrumb-item active"><a href="#">Ver Assento</a></li>
                                        <li class="breadcrumb-item active">Ver QRCODE</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-12">
                                    <div style="height:350px;background-color:none">
                                        
                                        <?php 
                                            $img=$novonome.'.png';
                                        ?>
                                        <div style="margin-left:350px" class="port m-b-20">
                                            <div style="width:1200px" class="portfolioContainer">
                                                <div class="col-sm-6 col-lg-3 col-md-4 webdesign illustrator">
                                                    <div class="gal-detail thumb">
                                                        <a href='{{ url("images/qrcodes/{$pasta}/{$img}") }}' class="image-popup" title="Screenshot-1">
                                                            <img style="width:250px;height:200px" src='{{ url("images/qrcodes/{$pasta}/{$img}") }}' class="thumb-img" alt="work-thumbnail">
                                                        </a>                                                        
                                                        <p class="text-muted text-center"><small>{{$novonome}}</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
</div>
@stop