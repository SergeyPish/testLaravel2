@extends('base')

@section('content')
    <div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Тип</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @if (count($types) > 0)
            @foreach($types as $type)
                <tr>
                    <th scope="row">{{$type->id}}</th>
                    <td>{{$type->name}}</td>
                    <td>
                        <a href="{{route('type.show', ['id' => $type->id])}}" class="btn btn-outline-primary">Редактировать</a>
                        <a href="{{route('type.delete', ['id' => $type->id])}}" class="btn btn-outline-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">Типы пива пока не добавлены</td>
            </tr>
        @endif
        <tfooter>
            <tr>
                <td colspan="3"><a href="{{route('type.add')}}" class="btn btn-outline-primary">Добавить тип</a></td>
            </tr>
        </tfooter>
        </tbody>
    </table>
    </div>
@endsection
