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
                                <option value="{{ $manufacturer_id ? route('beer.index', ['manufacturer_id' => $manufacturer_id]) : route('beer.index')}}">Выберите тип пива</option>
                                @if (count($types) > 0)
                                    @foreach ($types as $type)
                                        @if ($type_id == $type->id)
                                            <option value="{{ $manufacturer_id ? route('beer.index', ['type_id' => $type->id, 'manufacturer_id' => $manufacturer_id]) : route('beer.index', ['type_id' => $type->id])}}" selected="selected">{{$type->name}}</option>
                                        @else
                                            <option value="{{ $manufacturer_id ? route('beer.index', ['type_id' => $type->id, 'manufacturer_id' => $manufacturer_id]) : route('beer.index', ['type_id' => $type->id])}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="">Тип пива не добавлен в систему</option>
                                @endif
                            </select>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="form-group">
                            <label for="type">Производитель</label>
                            <select class="form-control" id="manufacturer" name="manufacturer_id" onchange="location = this.value;">
                                <option value="{{ $type_id ? route('beer.index', ['type_id' => $type_id]) : route('beer.index')}}">Выберите производителя</option>
                                @if (count($manufacturers) > 0)
                                    @foreach ($manufacturers as $manufacturer)
                                        @if ($manufacturer_id == $manufacturer->id)
                                            <option value="{{ $type_id ? route('beer.index', ['type_id' => $type_id, 'manufacturer_id' => $manufacturer->id]) : route('beer.index', ['manufacturer_id' => $manufacturer->id])}}" selected="selected">{{$manufacturer->name}}</option>
                                        @else
                                            <option value="{{ $type_id ? route('beer.index', ['type_id' => $type_id, 'manufacturer_id' => $manufacturer->id]) : route('beer.index', ['manufacturer_id' => $manufacturer->id])}}">{{$manufacturer->name}}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="">Производители не добавлены в систему</option>
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
            <th scope="col">Пиво</th>
            <th scope="col">Тип</th>
            <th scope="col">Производитель</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @if(count($beers) > 0)
            @foreach ($beers as $beer)
                <tr>
                    <th scope="row">{{$beer->id}}</th>
                    <td>{{$beer->name}}</td>
                    <td>{{$beer->type->name}}</td>
                    <td>{{$beer->manufacturer->name}}</td>
                    <td>
                        <a href="{{route('beer.show', ['id' => $beer->id])}}" class="btn btn-outline-primary">Редактировать</a>
                        <a href="{{route('beer.delete', ['id' => $beer->id])}}" class="btn btn-outline-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">Пиво пока не добавлено</td>
            </tr>
        @endif
        <tfooter>
            <tr>
                <td colspan="5"><a href="{{route('beer.add')}}" class="btn btn-outline-primary">Добавить пиво</a></td>
            </tr>
        </tfooter>
        </tbody>
    </table>
    </div>
@endsection
