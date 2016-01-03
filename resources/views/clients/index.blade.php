@extends('layout')

@section('clients')

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
            <!--<link href="/css/app.css" rel="stylesheet">-->                      
        </head>

        <body>

            <div class="site-wrapper">
                <div class="site-wrapper-inner">
                    <div class="cover-container">
                        
                        <div class="masthead clearfix">
                            <div class="inner">
                                <!--<h3 class="masthead-brand">Tokarev Sound Group</h3>-->
                                <h3 class="masthead-brand"><a href="https://tokarev-sg.com/" target="blank"><img src="/img/1.png" type="image/png"></a></h3>
                                <ul class="nav masthead-nav masthead-left">
                                    <li><a href="/home">Home</a></li>
                                    <li class="dropdown active">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clients<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
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

                        <div class="inner-cover">
                            <div class="table-responsive">
                                <table class="table table-bordered header-fixed fb-posts" data-toggle="table" data-height="299" border='1'>
                                    <thead>
                                        <tr>
                                            <th><div style="width: 100px">Номер карточки</div></th>
                                            <th><div style="width: 200px">Фото</div></th>
                                            <th><div style="width: 200px">ФИО</div></th>
                                            <th><div style="width: 150px">Никнейм</div></th>
                                            <th><div style="width: 105px">Телефон</div></th>
                                            <th><div style="width: 52px">Спамер/клиент</div></th>
                                            <th><div style="width: 50px">Скидка</div></th>
                                            <th><div style="width: 100px">Баланс</div></th>
                                            <th><div style="width: 115px">Баланс (за всю историю)</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clients as $key => $value)
                                        <tr>
                                            <td><div style="width: 100px">{!! $value->id !!}</div></td>
                                            <td><img class="image" src="{!! $value->photo !!}" alt='' width="200" height="150"></td>
                                            <td><div style="width: 200px">{!! $value->lastName, ' ', $value->firstName, ' ', $value->surName !!}</div></td>
                                            <td><div style="width: 150px">{!! $value->nickName !!}</div></td>
                                            <td><div style="width: 105px">{!! $value->mobNum !!}</div></td>
                                            <td><div style="width: 52px">{!! $value->spamOrClient !!}</div></td>
                                            <td><div style="width: 50px">{!! $value->discount !!}</div></td>
                                            <td><div style="width: 100px">{!! $value->allPoints !!}</div></td>
                                            <td><div style="width: 100px">{!! $value->overallPoints !!}</div></td>
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

            <script type="text/javascript">
                $(".image").click(function() {
                    if($(this).attr('width') == 200) {
                        $(this).attr('width', '400');
                        $(this).attr('height', '300');
                    } else {
                        $(this).attr('width', '200');
                        $(this).attr('height', '150');        
                    }
                });
            </script>


            <script src="{{ asset("js/bootstrap.min.js") }}"></script>
            <!--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
        </body>
    </html>

@stop