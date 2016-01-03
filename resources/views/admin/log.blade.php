@extends('layout')

@section('log')

    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Клиенты</title>

            <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
            <link href="{{ asset("css/cover.css") }}" rel="stylesheet">
            <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.css">

            <!-- Latest compiled and minified JavaScript -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>                     
        </head>

        <body>

            <div class="site-wrapper">
                <div class="site-wrapper-inner">
                    <div class="cover-container">
                        
                        <div class="masthead clearfix">
                            <div class="inner">
                                <h3 class="masthead-brand"><a href="https://tokarev-sg.com/" target="blank"><img src="/img/1.png" type="image/png"></a></h3>
                                <ul class="nav masthead-nav masthead-left">
                                    <li><a href="/home">Главная</a></li>
                                    <li class="active"><a href="/admin/log">Лог</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Пользователи<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                                            <li><a href="/admin/users">Показать всех</a></li>
                                            <li><a href="/admin/create">Создать нового</a></li>
                                        </ul>
                                    </li>
                                    <li></li>
                                    <li class="dropdown">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="/auth/logout">Выйти</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="inner-cover">
                            <div class="table-responsive">
                                <table class="table table-bordered header-fixed" data-toggle="table" data-height="299" border='1'>
                                    <thead>
                                        <tr>
                                            <th><div style="width: 50px">ID</div></th>
                                            <th><div style="width: 200px">Пользователь</div></th>
                                            <th><div style="width: 742px">Действие</div></th>
                                            <th><div style="width: 165px">Время</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($activities as $key => $value)
                                        <tr>
                                            <td><div style="width: 50px">{!! $value->id !!}</div></td>
                                            <td><div style="width: 200px">{!! $value->user !!}</div></td>
                                            <td><div style="width: 742px">{!! $value->activity !!}</div></td>
                                            <td><div style="width: 150px">{!! $value->created_at !!}</div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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


            <script src="{{ asset("js/bootstrap.min.js") }}"></script>
            <!--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
        </body>
    </html>

@stop