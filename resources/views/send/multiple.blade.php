@extends('layout')

@section('multiple')

	<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Отправка сообщений многим клиентам</title>
                
            <!-- Referencing Bootstrap CSS that is hosted locally -->
            <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
            <link href="{{ asset("css/cover.css") }}" rel="stylesheet">           
        </head>
	    
	    <body>  
	        
			<div class="site-wrapper">
	            <div class="site-wrapper-inner">
	                <div class="cover-container">
	                    @if(Session::has('messageSentMult'))
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p class="alert alert-success">{{ Session::get('messageSentMult') }}</p>
                        @endif
	                    <div class="masthead clearfix">
                            <div class="inner">
                                <!--<h3 class="masthead-brand">Tokarev Sound Group</h3>-->
                                <h3 class="masthead-brand"><a href="https://tokarev-sg.com/" target="blank"><img src="/img/1.png" type="image/png"></a></h3>
                                <ul class="nav masthead-nav masthead-left">
                                    <li><a href="/home">Home</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clients<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
                                            <li><a href="/clients">Show all</a></li>
                                            <li><a href="/clients/create">Add client</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown active">
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
	                        <h1 class="cover-heading">Введите сообщение для массовой рассылки:</h1>
	                        
	                        <p class="lead">(Максимум 150 символов)</p>
	                        
	                        <form method="post" role="form" action="/send/multiple">
	                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                            <div class="form-group col-xs-8 col-xs-offset-2">
	                                <textarea class="form-control" rows="5" name="holidayText" id="holidayTextField" placeholder="Введите текст транслитом" maxlength="150"
	                                          onkeyup="if(this.value.length > 0) { 
	                                                    document.getElementById('submit_but').disabled = false;
	                                                } 
	                                                else { 
	                                                    document.getElementById('submit_but').disabled = true;
	                                                }"></textarea>
	                            </div>
	                            
	                            <div class="form-group col-xs-6 col-xs-offset-3" required>
	                                <label class="radio-inline">
	                                    <input type="radio" name="state" id="inlineRadio1" value="male" checked="checked"> Мужчинам
	                                </label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="state" id="inlineRadio2" value="female"> Женщинам
	                                </label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="state" id="inlineRadio3" value="all"> Всем
	                                </label>
	                            </div>
	                            
	                            <div class="form-group col-xs-6 col-xs-offset-3" required>
	                                <label class="radio-inline">
	                                    <input type="radio" name="spamOrClient" id="spCl1" value="spam" checked="checked"> Спамерам
	                                </label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="spamOrClient" id="spCl2" value="client"> Клиентам
	                                </label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="spamOrClient" id="spCl2" value="spCl"> Всем
	                                </label>
	                            </div>
	                            
	                            <div class="form-group col-xs-6 col-xs-offset-3">
	                                <input type="submit" class="btn btn-lg btn-default" value="Отправить смс" id="submit_but" disabled>
	                            </div>
	                        </form> 
	                    </div>
	                    
	                    <div class="mastfoot">
	                        <div class="inner">
	                            <p>Client for sending SMS, <a href="https://tokarev-sg.com/" target="blank">Tokarev Sound Group</a>, by Vlad Viligura.</p>
	                        </div>
	                    </div>

	                </div>
	            </div>
        	</div>

	        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="{{ asset("js/bootstrap.min.js") }}"></script>
        </body>
    </html>
@stop
