@extends('layout')
 
@section('createUser')

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Регистрация нового пользователя</title>

        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("css/cover.css") }}" rel="stylesheet">
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    @if(Session::has('message'))
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
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
                                            <li><a href="/admin/createUser">Создать нового</a></li>
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

                    <div class="inner cover">
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                            <strong>Ошибка!</strong>
                            Возникли проблемы с введенными Вами данными.<br><br>
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif

                        <form class="form-signin" role="form" method="post" action="/admin">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h2 class="form-signin-heading">Регистрация нового пользователя</h2>
                            
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    
                                    <div class="form-group col-xs-8 col-xs-offset-2">
                                        <label class="control-label">Логин:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Логин" value="{{ old('new_name') }}">
                                    </div>
                                    
                                    <div class="form-group col-xs-8 col-xs-offset-2">
                                        <label class="control-label">Пароль:</label>
                                        <input type="password" class="form-control" name="password" placeholder="Пароль">
                                    </div>
                                    
                                    <div class="form-group col-xs-8 col-xs-offset-2">
                                        <label class="control-label">Подтвердите пароль:</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Подтверждение пароля">
                                    </div>

                                    <div class="form-group col-xs-8 col-xs-offset-2">
                                        <button class="btn btn-lg btn-default" type="submit">Зарегестрировать</button>
                                    </div>
                                    <div class="form-group col-xs-8 col-xs-offset-2">
                                        <a href="/home" class="btn btn-default btn-sm">Отмена</a>
                                    </div>


                                </div>
                            </div>
                            
                        </form>
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
    </body>
</html>
 
@endsection