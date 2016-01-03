@extends('layout')
 
@section('create')

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Добавление клиента</title>

        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("css/cover.css") }}" rel="stylesheet">
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
        <!--<link href="{{ asset("css/signing.css") }}" rel="stylesheet">-->
    </head>

    <body>
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    
                    <div class="masthead clearfix">
                        <div class="inner">
                            <h3 class="masthead-brand"><a href="https://tokarev-sg.com/" target="blank"><img src="/img/1.png" type="image/png"></a></h3>
                            <ul class="nav masthead-nav masthead-left">
                                <li><a href="/home">Home</a></li>
                                <li class="dropdown active">
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
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="/auth/logout">Выйти</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="inner">

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

                        <form class="form-signin" role="form" method="POST" action="/clients">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h2 class="form-signin-heading">Добавление нового клиента</h2>

                            <div class="row">
                                <div class="form-group col-xs-4 col-xs-offset-2">
                                    <label class="control-label">Номер карточки:</label>
                                    <input class="form-control" type="text" name="cardID" placeholder="№">

                                    <label class="control-label">Дата рождения:</label>
                                    <input class="form-control" type="text" name="birthDate" placeholder="дд.мм" maxlength="5">
                                    
                                    <label class="control-label">Мобильный телефон:</label>
                                    <input class="form-control" type="text" name="mobNum" placeholder="+380xxxxxxxxx" maxlength="13">
                                    
                                    <label class="control-label">Фото:</label>
                                    <input class="form-control" type="text" name="photo" placeholder="Ссылка на фото">

                                    <label class="control-label">Для спама / Клиент:</label>
                                    <select name="spamOrClient" class="form-control">
                                        <option selected="selected" value="spam">For spam</option>
                                        <option value="client">Client</option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-4">
                                    <label class="control-label">Фамилия:</label>
                                    <input class="form-control" type="text" name="lastName" placeholder="Фамилия">

                                    <label class="control-label">Имя:</label>
                                    <input class="form-control" type="text" name="firstName" placeholder="Имя">

                                    <label class="control-label">Отчество:</label>
                                    <input class="form-control" type="text" name="surName" placeholder="Отчество">

                                    <label class="control-label">Никнейм:</label>
                                    <input class="form-control" type="text" name="nickName" placeholder="Никнейм">

                                    <label class="control-label">Мужчина / Женщина:</label>
                                    <select name="state" class="form-control">
                                        <option selected="selected" value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-xs-8 col-xs-offset-2">
                                <button class="btn btn-lg btn-default" type="submit">Добавить</button>
                            </div>
                            <div class="form-group col-xs-8 col-xs-offset-2">
                                <a href="/home" class="btn btn-default btn-sm">Отмена</a>
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