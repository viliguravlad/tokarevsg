@extends('layout')

@section('auth')

<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">Login
				</div>
			    <div class="panel-body">
				    <form class="form-horizontal" role="form" method="POST" action="/auth/login">
			            <input type="hidden" name="_token" value="{{ csrf_token() }}">
			 
			            <div class="form-group">
			                <label class="col-md-4 control-label">Name</label>
			                <div class="col-md-6">
			                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
			                </div>
			            </div>                      
			 
			            <div class="form-group">
			                <label class="col-md-4 control-label">Password</label>
			                <div class="col-md-6">
			                    <input type="password" class="form-control" name="password">
			                </div>
			            </div>
			 
			            <div class="form-group">
			                <div class="col-md-6 col-md-offset-4">
			                    <button type="submit" class="btn btn-primary">
			                        Login
			                    </button>
			                </div>
			            </div>
			        </form>
				</div>
			</div>
		</div>
	</div>
</div>-->

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Авторизация</title>

        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("css/signing.css") }}" rel="stylesheet">           
    </head>

    <body>
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
		
		<div class="container">          
            <form class="form-signin" role="form" method="post" action="/auth/login">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h2 class="form-signin-heading">Пожалуйста, авторизуйтесь!</h2>
                <input type="text" class="form-control" name="name" placeholder="Логин" value="{{ old('name') }}">
                <input type="password" class="form-control" name="password" placeholder="Пароль">
                <button class="btn btn-lg btn-default btn-block" type="submit">Войти</button>
            </form>            
        </div>

		<script src="{{ asset("js/bootstrap.min.js") }}"></script>
    </body>
</html>
@endsection