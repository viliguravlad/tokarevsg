@extends('layout')

@section('home')

    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Главная</title>

            <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
            <link href="{{ asset("css/cover.css") }}" rel="stylesheet">
            <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
            <!--<link href="/css/app.css" rel="stylesheet">-->                      
        </head>

        <body>

            <div class="site-wrapper">
                <div class="site-wrapper-inner">
                    <div class="cover-container">
                        
                        <div class="masthead clearfix">
                            <div class="inner">
                                <!--<h3 class="masthead-brand">Tokarev Sound Group</h3>-->
                                <h3 class="masthead-brand"><a href="https://tokarev-sg.com/" target="blank"><img src="img/1.png" type="image/png"></a></h3>
                                <ul class="nav masthead-nav masthead-left">
                                    <li class="active"><a href="/home">Home</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clients<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                                            <li><a href="/clients">Show all</a></li>
                                            <li><a href="/clients/create">Add client</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Send<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
                                            <li><a href="/send/single">Single</a></li>
                                            <li><a href="/send/multiple">Multiple</a></li>
                                        </ul>
                                    </li>
                                    <li></li>
                                    <li class="dropdown">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                            <span class="caret"></span>
                                        </button>
                                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>-->
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="/auth/logout">Выйти</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="inner cover">
                            <!--<h1 class="cover-heading">Добро пожаловать, {!! Auth::user()->name !!}!</h1>-->
                            <p class="lead">Выберите действие, которое хотите выполнить, из меню сверху.</p>
                            <p class="lead">Или нажмите на одну из кнопок ниже.</p>
                            <div class="text-center">
                                <p class="lead"> <a class="btn btn-lg btn-default" href="/send/single">Single</a> - отправка отчета клиенту.</p> 
                                <p class="lead"> <a class="btn btn-lg btn-default" href="/send/multiple">Multiple</a> - отправка многим клиентам.</p>  
                            </div>
                        </div>

                        <div class="mastfoot">
                            <div class="inner">
                                <p>Client for sending SMS, <a href="https://tokarev-sg.com/" target="blank">Tokarev Sound Group</a>, by <a href="http://vk.com/v.viligura" target="blank">Vlad Viligura</a>.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="{{ asset("js/bootstrap.min.js") }}"></script>
            <!--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
        </body>
    </html>

@stop