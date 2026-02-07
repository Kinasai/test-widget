@extends('layouts.app')

@php
    $types = [
        'date' => 'Искать по дате',
        'status' => 'Искать по статусу',
        'email' => 'Искать по email',
        'phone_number' => 'Искать по телефону'
    ];

        $currentType = old('types', request('type') ?: 'date');
        $search = old('search', request('search') ?: null);

@endphp


@section('content')


    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Тикеты</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-end">
            <div class="d-flex gap-2">
                <x-select name="selectTypes" class="form-control" :options="$types" :selected="$currentType" />
                <x-input name="search" class="form-control"></x-input>
                <x-select name="statusSelect" class="form-control" :options="$statuses" />
                <button class="btn btn-secondary" onclick="goToSearch()">Искать</button>
            </div>
        </div>
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
            @if(!$tickets->onFirstPage())
            <a class="btn btn-outline-secondary" href="{{$tickets->withQueryString()->previousPageUrl()}}">
                Назад
            </a>
            @endif
        @for($i=1;$i<=$tickets->withQueryString()->lastPage();$i++)
                <a class="btn {{$tickets->currentPage() == $i ? 'btn-secondary' : 'btn-outline-secondary'}}" href="{{$tickets->withQueryString()->url($i)}}">{{$i}}</a>
            @endfor
            @if($tickets->currentPage() != $tickets->lastPage())
                <a class="btn btn-outline-secondary" href="{{$tickets->withQueryString()->nextPageUrl()}}">
                    Вперед
                </a>
            @endif
        @else
            <p>Тикеты не найдены.</p>
        @endif

    </div>
@endsection

<script>
    const goToSearch = () => {
        const url = new URL(`/tickets`, window.location.origin);

        if(type !== null && type.length && search !== null && search.length) {
            url.searchParams.set('type', type);
            url.searchParams.set('search', search);
        }

        window.location.href = url.toString();
    }


    let type = "{{ $currentType }}";
    let search = "{{ $search }}";

    document.addEventListener('DOMContentLoaded', function() {
        changeType()
        document.getElementById('search').value = search;
        document.getElementById('statusSelect').value = search;

        document.getElementById('selectTypes').addEventListener('change', function() {
            type = this.value;
            changeType();
            search = '';
            document.getElementById('search').value = search;
            document.getElementById('statusSelect').value = search;
        });
        document.getElementById('statusSelect').addEventListener('change', function() {
            search = this.value;
        });
        document.getElementById('search').addEventListener('input', function() {
            search = this.value;
        });
    })

    const changeType = () => {

        showInput(type !== 'status')

        switch (type) {
            case 'date':
                document.getElementById('search').type = 'date';
                break;
            case 'email':
                document.getElementById('search').type = 'email';
                break;
            case 'phone_number':
                document.getElementById('search').type = 'text';
                break;
        }
    }

    const showInput = (bool) => {
        if(bool) {
            document.getElementById('search').style.display = 'block';
            document.getElementById('statusSelect').style.display = 'none';
        } else {
            document.getElementById('search').style.display = 'none';
            document.getElementById('statusSelect').style.display = 'block';
        }
    }
</script>
