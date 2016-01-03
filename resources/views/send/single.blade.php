@extends('layout')

@section('single')

	<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Отправка отчета клиенту</title>
                
            <!-- Referencing Bootstrap CSS that is hosted locally -->
            <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
            <link href="{{ asset("css/cover.css") }}" rel="stylesheet">

	        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

        </head>
	    
	    <body>  
	        
	        <div class="site-wrapper">
	            <div class="site-wrapper-inner">
	                <div class="cover-container">
	                    @if(Session::has('messageSentSingle'))
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p class="alert alert-success">{{ Session::get('messageSentSingle') }}</p>
                        @endif
                        @if(Session::has('messageSentSingleFail'))
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p class="alert alert-error">{{ Session::get('messageSentSingleFail') }}</p>
                        @endif
                        @if(Session::has('messageClientCreated'))
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p class="alert alert-success">{{ Session::get('messageClientCreated') }}</p>
                        @endif
	                    <div class="masthead clearfix">
                            <div class="inner">
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
	                    <div class="inner cover">
	                        <h1 class="cover-heading">Введите данные:</h1>
	                        <form method="post" class="" id="formSingle" action="/send/single">
	                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                            
                            	<div class="row">
	                                <div class="form-group col-xs-3 col-xs-offset-3">
		                                <input class="form-control" type="text" name="cardNo" id="cardNo" placeholder="Номер карточки" 
		                                       	 value="@if (Session::has('cardNum'))
																						      {{ Session::get('cardNum') }}
																						  @endif">
		                            </div>
		                            <div class="form-group col-xs-3">
	                                	<input class="form-control" type="text" name="nowPoints" id="nowPointsField" placeholder="Количество баллов" disabled>
	                                </div>
	                            </div>
	                            
						        <div class="form-group">
							        <a data-toggle="modal" href="" class="not-active"
							        	title="This is title" data-target="#myModal" id="refClientInfo">Подробнее...</a>
							    </div>


	                            <div class="form-group">
	                                <input type="submit" class="btn btn-lg btn-default" value="Отправить смс" id="submit_button" disabled>
	                            </div>

	                        </form>

							<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
					                <div class="modal-content">
										
									</div>
								</div>
							</div>

	                    </div>
	                    
	                    <div class="mastfoot">
	                        <div class="inner">
	                            <p>Client for sending SMS, <a href="https://tokarev-sg.com/" target="blank">Tokarev Sound Group</a>, by Vlad Viligura.</p>
	                        </div>
	                    </div>

	                </div>
	            </div>
	        </div>

	        <script type='text/javascript'>
				$(document).on('keyup', '#cardNo', function() {
					if($('#cardNo').val() != '') {
						$('#nowPointsField').prop('disabled', false);
						$('#refClientInfo').prop('disabled', false);
						$('#refClientInfo').removeClass('not-active');

						var cardID = $('#cardNo').val();
	                	var url = '/clients/' + cardID;
	                	$('#refClientInfo').attr('href', url);
					} else {
						$('#nowPointsField').prop('disabled', true);
						$('#refClientInfo').addClass('not-active');
						$('#submit_button').prop('disabled', true);
					}
				});

				$(document).on('keyup', '#nowPointsField', function() {
					if($('#nowPointsField').val() != '') {
						$('#submit_button').prop('disabled', false);
					} else {
						$('#submit_button').prop('disabled', true);
					}
				});
			</script>


            <script src="{{ asset("js/bootstrap.min.js") }}"></script>
        </body>
    </html>
@stop