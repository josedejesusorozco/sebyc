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
                        <button class="btn btn-success navbar-btn" style="margin-left: 15px;">Estimar biomasa</button>
                </nav>
            </div>
<!-- Fin menú vertical -->
<!-- Contenido -->
            <br>
            <!--<div class="col-xs-1 visible-xs" style="background-color: red;"></div>-->
            <div class="col-xs-12 col-sm-9 col-md-10">
                <!--<div class="well">
                    <h4>PIMoF</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque voluptates quas consequuntur sequi ab sunt non tenetur architecto, necessitatibus quia qui rem earum explicabo, reprehenderit magnam nisi cum dignissimos quasi!</p>
                </div>-->
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="well fill div-blue">
                            <h4>Arboles</h4>
                            <p>1 Million</p>
                            <div class="options options-blue">
                                <h3><span class="small">Aquí las opciones para subir el archivo</span></h3>
                                <p>
                                    {!! Form::open(array('url'=>'importa_arboles','method'=>'POST', 'files'=>true)) !!}
                                        <span class="btn btn-default btn-file btn-info">
                                            Subir archivo
                                        {!! Form::file('archivo', array('onchange'=>'this.form.submit()')) !!}
                                        </span>
                                        <!--{!! Form::submit('Submit', array('class'=>'send-btn')) !!}-->
                                    {!! Form::close() !!}
                                </p>
                                <p>
                                    <button class="btn btn-whatever">Descargar plantilla</button>
                                </p>
                            </div>
                            <a href="#" class="small-box-footer">
                                Mas información
                                <i class="glyphicon glyphicon-info-sign"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="well fill div-green">
                            <h4>Modelos alométricos</h4>
                            <p>100 Million</p>
                            <div class="options options-green">
                                <h3><span class="small">Aquí las opciones para subir el archivo</span></h3>
                                <p>
                                    {!! Form::open(array('url'=>'modelo_upload','method'=>'POST', 'files'=>true)) !!}
                                    <span class="btn btn-default btn-file btn-success">
                                            Subir archivo
                                    <!--
                                    <form action="modelo_upload" method="POST" enctype="multipart/forma-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="file" name="archivo">
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                    </form>
                                    -->
                                        {!! Form::file('archivo', array('onchange'=>'this.form.submit()')) !!}
                                    </span>
                                    <!--{!! Form::submit('Submit', array('class'=>'send-btn')) !!}-->
                                    {!! Form::close() !!}
                                </p>
                                <p>
                                    <button class="btn btn-whatever">Descargar plantilla</button>
                                </p>
                            </div>
                            <a href="#" class="small-box-footer">
                                Mas información
                                <i class="glyphicon glyphicon-info-sign"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="well fill div-yellow">
                            <h4>Densidades de la madera</h4>
                            <p>10 Million</p>
                            <a href="#" class="small-box-footer">
                                Mas información
                                <i class="glyphicon glyphicon-info-sign"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="well fill div-red">
                            <h4>Fracciones de carbono</h4>
                            <p>30%</p>
                            <a href="#" class="small-box-footer">
                                Mas información
                                <i class="glyphicon glyphicon-info-sign"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-xs-1 visible-xs" style="background-color: red;"></div>-->
<!-- Fin del contenido -->
        </div>
    </div>


    <script src="{{ asset('plugins/bootstrap/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
