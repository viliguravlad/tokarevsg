@extends('layout')
 
@section('show')

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal1"><span aria-hidden="true">&times;</span></button>
        @if (count($errors) > 0)
            <h4 class="modal-title" id="myModalLabel"><strong>Ошибка!</strong></h4>
        @else
            <h4 class="modal-title" id="myModalLabel">Информация о клиенте</h4>
        @endif
    </div>

    <div class="modal-body">
        <div class="container">
            <div class="text-left">
                @if (count($errors) > 0)
                    Возникли проблемы с введенными Вами данными.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                @else
                    <h1>Карточка №{!! $client->id !!}</h1>
                    <p>
                        <img class="image" src="{!! $client->photo !!}" alt='' width="400" height="300">
                    </p>
                    <h2>{!! $client->lastName, ' ', $client->firstName, ' ', $client->surName !!}</h2>
                    <h4>Никнейм: {!! $client->nickName !!}</h4>
                    <p>
                        <strong>Телефон:</strong> {!! $client->mobNum !!}<br>
                        <strong>Скидка:</strong> {!! $client->discount !!}%<br>
                        <strong>Всего баллов:</strong> {!! $client->allPoints !!}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal2">Close</button>
    </div>             

    <script>
        $(document).on('click', '#closeModal1, #closeModal2', function() {
            window.location.href = 'single';
        });
    </script>

@endsection

