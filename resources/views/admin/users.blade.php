@extends('layout')

@section('clients')

    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Список пользователей</title>

            <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
            <link href="{{ asset("css/cover.css") }}" rel="stylesheet">
            <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.css">

            <!-- Latest compiled and minified JavaScript -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <!--<link href="/css/app.css" rel="stylesheet">-->                      
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
                                    <li><a href="/admin/log">Лог</a></li>
                                    <li class="dropdown active">
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
                                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>-->
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="/auth/logout">Выйти</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="inner-cover">
                            <!--<div class="table-responsive">-->
                                <table class="table table-bordered header-fixed" id="table1" data-toggle="table" data-height="299" border='1'>
                                    <thead>
                                        <tr>
                                            <th><div style="width: 100px">ID</div></th>
                                            <th><div style="width: 200px">Пользователь</div></th>
                                            <!--<th><div style="width: 400px">Действия</div></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $value)
                                        <tr>
                                            <td><div style="width: 100px">{!! $value->id !!}</div></td>
                                            <td><div style="width: 200px">{!! $value->name !!}</div></td>
                                            <!--<td>
                                                <div style="width: 400px">
                                                    //<a href="edit/{!! $value->id !!}" class="btn btn-lg btn-default">Изменить</a>
                                                    //<a href="destroy/{!! $value->id !!}" class="btn btn-lg btn-default">Удалить</a>
                                                    //<form class="form-signin" role="form" method="POST" action="/admin/destroy/{!! $value->id !!}">
                                                    //    <input type="hidden" name="_method" value="DELETE">
                                                    //    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    //    <button class="btn btn-lg btn-default" type="submit">Delete</button>
                                                    //    array('url' => 'admin/destroy/' . $value->id, 'class' => 'pull-right'))
                                                    //</form>

                                                    {!! Form::open(['method' => 'DELETE', 'url' => 'admin/' . $value->id . '/destroy']) !!}
                                                        {!! Form::hidden('_token', csrf_token()) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::submit('Delete', array('class' => 'btn btn-default')) !!}
                                                    {!! Form::close() !!}

                                                </div>
                                            </td>-->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            <!--</div>-->
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