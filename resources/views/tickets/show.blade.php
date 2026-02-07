@extends('layouts.app')
@section('content')

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Тикеты</a></li>
                <li class="breadcrumb-item active" aria-current="page">Тикет {{$ticket['id']}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-end">

        <div class="col-3">

            <form method="POST" action="{{ route('tickets.update-status', $ticket['id']) }}" class="d-inline">
                @csrf
                @method('PATCH')
                <label for="status">Изменить статус</label>
                <div class="d-flex gap-2">
                    <x-select name="status" class="form-control" :options="$statuses" :selected="$ticket['status']" />
                    <button class="btn btn-secondary" id="submit">Изменить</button>
                </div>
            </form>
        </div>
        </div>

        <div>Имя: {{optional($ticket['customer'])['name'] ?? 'Без имени'}}</div>
        <div>Почта: {{optional($ticket['customer'])['email'] ?? 'Без почты'}}</div>
        <div>Номер телефона: {{optional($ticket['customer'])['phone_number'] ?? 'Без номера'}}</div>
        <div>Тема: {{$ticket['title']}}</div>
        <div>Сообщение: {{$ticket['text']}}</div>
        <div>Статус: {{$ticket['status_label']}}</div>
        <div>Дата ответа: {{$ticket['response_date'] ?: 'Без ответа'}}</div>
        <div>Дата создания: {{$ticket['created_at'] ?: 'Нет данных'}}</div>

    @if($ticket['files']->count())
            <div class="card">
                <div class="card-header">
                    <h5>Вложения ({{ $ticket['files']->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($ticket['files'] as $attachment)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        @if(str_starts_with($attachment['mime_type'], 'image/'))
                                            <img src="{{ $attachment['url'] }}"
                                                 alt="{{ $attachment['name'] }}"
                                                 class="img-fluid mb-2"
                                                 style="max-height: 150px; object-fit: contain;">
                                        @endif
                                    </div>
                                    <a class="btn btn-secondary" target="_blank" href="{{ $attachment['url'] }}">Скачать</a>
                                </div>
                            </div>

                        @endforeach
            </div>
        @endif
                </div>
@endsection
