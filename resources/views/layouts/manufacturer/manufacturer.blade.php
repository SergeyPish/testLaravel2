@extends('base')

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand">Фильтр</span>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <div class="form-group">
                            <label for="type">Тип пива</label>
                            <select class="form-control" id="type" name="type_id" onchange="location = this.value;">
                                <option value="{{route('brand.index')}}">Выберите тип пива</option>
                                @if (count($types) > 0)
                                    @foreach ($types as $type)
                                        @if ($type_id == $type->id)
                                            <option value="{{route('brand.index', ['type_id' => $type->id])}}" selected="selected">{{$type->name}}</option>
                                        @else
                                            <option value="{{route('brand.index', ['type_id' => $type->id])}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="">Тип пива не добавлен в систему</option>
                                @endif
                            </select>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Производитель</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @if (count($manufacturers) > 0)
            @foreach($manufacturers as $manufacturer)
                <tr>
                    <th scope="row">{{$manufacturer->id}}</th>
                    <td>{{$manufacturer->name}}</td>
                    <td>
                        <a href="{{route('brand.show', ['id' => $manufacturer->id])}}" class="btn btn-outline-primary">Редактировать</a>
                        <a href="{{route('brand.delete', ['id' => $manufacturer->id])}}" class="btn btn-outline-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">Производители пока не добавлены</td>
            </tr>
        @endif
        <tfooter>
            <tr>
                <td colspan="3"><a href="{{route('brand.add')}}" class="btn btn-outline-primary">Добавить производителя</a></td>
            </tr>
        </tfooter>
        </tbody>
    </table>
    </div>
@endsection
