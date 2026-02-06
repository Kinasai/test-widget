@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Тикеты</li>
            </ol>
        </nav>
        @if($tickets->count() > 0)
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Статус</th>
                <th>Дата ответа</th>
                <th>Дата создания</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($ticketsCollection as $ticket)
                <tr class="{{ $loop->even ? 'table-light' : '' }}">
                    <td>{{ $ticket['id'] }}</td>
                    <td>{{ $ticket['title'] }}</td>
                    <td>{{ $ticket['status_label'] }}</td>
                    <td>{{ $ticket['response_date'] }}</td>
                    <td>{{ $ticket['created_at'] }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket['id']) }}">
                            Перейти
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <a href="{{$tickets->previousPageUrl()}}">
            </a>
            @for($i=1;$i<=$tickets->lastPage();$i++)
                <a href="{{$tickets->url($i)}}">{{$i}}</a>
            @endfor
            <a href="{{$tickets->nextPageUrl()}}">
            </a>
        @else
            <p>No tickets found.</p>
        @endif

    </div>
@endsection
