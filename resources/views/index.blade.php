<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/estilos.css') }}" rel='stylesheet' type='text/css' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Estimaciones, carbono, árbol, árboles, biomasa" />

    <title>PIMoF</title>
</head>
<body>
    <div id="padre" class="invisible">
        <div  id="caja-negra"><h1>Espera</h1></div>
        <div id="bloqueo" style="z-index: 1000; position: absolute;"></div>
    </div>
<!-- Menú horizontal -->
    <nav class="navbar navbar-inverse visible-xs">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="#">Logo</a>-->
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Variables</a></li>
                    <li><a href="#">Carga de variables</a></li>
                    <li><a href="#">Gráficas</a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- Fin menú horizontal -->
    <div class="container-fluid">
        <div class="row content">
<!-- Menú vertical -->
            <div class="col-sm-3 col-md-2 hidden-xs menu-left">
                <nav class="navbar navbar-inverse navbar-left">
                        <p>                        
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">Plataforma Informática de Monitoreo Forestal </a>
                            </div>
                        </p>
                        <br>
                        <p>
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Carga de variables</a></li>
                                <li><a href="#">Gráficas</a></li>
                            </ul>
                        </p>
                        <button class="btn btn-info" id="estimacion_btn" value="{{ csrf_token() }}" >Comenzar estimación</button>
                </nav>
            </div>
<!-- Fin menú vertical -->
<!-- Contenido -->
            <br>
            <!--<div class="col-xs-1 visible-xs" style="background-color: red;"></div>-->
            <div class="col-xs-12 col-sm-9 col-md-10">
                <div class="row"  style="text-align: center; vertical-align: middle;">
                    <img src="img/logos.jpg" alt="" style="height: 170px; vertical-align: middle;">
                    <!--<div class="col-sm-2" style="text-align: center;"></div>
                    <div class="col-sm-3" style="text-align: center;"> 
                        <img src="img/conafor.jpg" alt="" style="height: 100px; vertical-align: middle;">
                    </div>
                    <div class="col-sm-3" style="text-align: center; vertical-align: middle;">
                        <img src="img/usaid.png" alt="" style="height: 170px; vertical-align: middle;">
                    </div>
                    <div class="col-sm-3" style="text-align: center; vertical-align: middle;">
                        <img src="img/Forestservice-shield.svg.png" alt="" style="height: 100px; vertical-align: middle;">
                    </div>-->
                    
                </div>

                <h1 style="text-align: center;">Sistema de Estimación de Biomasa y Carbono de México</h1>
                <br>

                <!--<div class="well">
                    <h4>PIMoF</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque voluptates quas consequuntur sequi ab sunt non tenetur architecto, necessitatibus quia qui rem earum explicabo, reprehenderit magnam nisi cum dignissimos quasi!</p>
                </div>-->


                <div class="row">

                    <div class="container-fluid">
                        
                        <div class="col-sm-1 hidden-xs"></div>
                        <div class="col-sm-10" id="tabla">
                            
                        </div>
                        <div class="col-sm-1 hidden-xs"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-1 hidden-xs"></div>
                    <div class="col-sm-10">
                    

                        <!--Cuadro importación arboles-->
                        <div class="col-sm-12 col-lg-6">
                            <div class="well fill div-blue">
                                <h1>Arboles</h1>
                                <h2><?php if ($arboles) echo $arboles . ' registros'; ?></h2>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(array('url'=>'importa_arboles','method'=>'POST', 'files'=>true, 'id' => 'form-arboles', 'class' => 'nobreak')) !!}
                                    <span class="btn btn-default btn-file btn-info">
                                        Subir archivo
                                        {!! Form::file('archivo', array('onchange'=>'bloqueo("#form-arboles")')) !!}
                                    </span>
                                <!--{!! Form::submit('Submit', array('class'=>'send-btn')) !!}-->
                                {!! Form::close() !!}
                                <button class="btn btn-whatever" onClick="window.location.href='{{ url('/') }}/plantillas/Arboles.xlsx'">Descargar plantilla</button>
                            
                            </div>
                        </div>

                        
                        <!--Cuadro importación modelos-->
                        <div class="col-sm-12 col-lg-6">
                            <div class="well fill div-green">
                                <h1>Modelos alométricos</h1>
                                <h2><?php if ($modelos) echo $modelos . ' registros'; ?></h2>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(array('url'=>'importa_modelos','method'=>'POST', 'files'=>true, 'id' => 'form-modelos', 'class' => 'nobreak')) !!}
                                    <span class="btn btn-default btn-file btn-success">
                                        Subir archivo
                                        {!! Form::file('archivo', array('onchange'=>'bloqueo("#form-modelos")')) !!}
                                    </span>
                                {!! Form::close() !!}
                                <button class="btn btn-whatever" onClick="window.location.href='{{ url('/') }}/plantillas/Modelos.xlsx'">Descargar plantilla</button>
                            </div>
                        </div>


                        <!--Cuadro importación densidades de la madera-->
                        <div class="col-sm-12 col-lg-6">
                            <div class="well fill div-yellow">
                                <h1>Densidades de la madera</h1>
                                <h2><?php if ($densidades) echo $densidades . ' registros'; ?></h2>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(array('url'=>'importa_densidades','method'=>'POST', 'files'=>true, 'id' => 'form-densidades', 'class' => 'nobreak')) !!}
                                    <span class="btn btn-default btn-file btn-warning">
                                        Subir archivo
                                        {!! Form::file('archivo', array('onchange'=>'bloqueo("#form-densidades")')) !!}
                                    </span>
                                {!! Form::close() !!}
                                <button class="btn btn-whatever" onClick="window.location.href='{{ url('/') }}/plantillas/Densidades_madera.xlsx'">Descargar plantilla</button>
                            </div>
                        </div>
                        

                        <!--Cuadro importación fracciones de carbono-->
                        <div class="col-sm-12 col-lg-6">
                            <div class="well fill div-red">
                                <h1>Fracciones de carbono</h1>
                                <h2><?php if ($fracciones) echo $fracciones . ' registros'; ?></h2>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(array('url'=>'importa_fracciones','method'=>'POST', 'files'=>true, 'id' => 'form-fracciones', 'class' => 'nobreak')) !!}
                                    <span class="btn btn-default btn-file btn-danger">
                                        Subir archivo
                                        {!! Form::file('archivo', array('onchange'=>'bloqueo("#form-fracciones")')) !!}
                                    </span>
                                {!! Form::close() !!}
                                <button class="btn btn-whatever" onClick="window.location.href='{{ url('/') }}/plantillas/Fracciones_carbono.xlsx'">Descargar plantilla</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 hidden-xs"></div>
                </div>
                <!--<img src="img/version_beta.jpg" style="z-index: 1200; position: fixed; bottom: 0px; right: 0px;">-->
            </div>
            <!--<div class="col-xs-1 visible-xs" style="background-color: red;"></div>-->
<!-- Fin del contenido -->
        </div>
    </div>


    <script src="{{ asset('plugins/bootstrap/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="vue/vue.js"></script>
    <script src="vue/axios/axios.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
