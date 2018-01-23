@extends('base')

@section('content')
    <div class="container">
    <form action="{{ $action }}" method="POST">
        {{csrf_field()}}
        @isset ($beerInfo->id)
            <input type="hidden" name="id" value="{{$beerInfo->id}}"/>
        @endif
        <div class="form-group">
            <label for="type">Название пива</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : isset($beerInfo->name) ? $beerInfo->name : ''}}" id="type" placeholder="Введите название пива">
            @if($errors->has('name')) <div class="text-danger">{{$errors->first('name')}}</div> @endif
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') ? old('description') : isset($beerInfo->description) ? $beerInfo->description : ''}}</textarea>
            @if($errors->has('description')) <div class="text-danger">{{$errors->first('description')}}</div> @endif
        </div>
        <div class="form-group">
            <label for="type">Тип пива</label>
            <select class="form-control" id="type" name="type_id">
                @if (count($types) > 0)
                    @foreach ($types as $type)
                        @isset ($beerInfo)
                            @if ($type->id == $beerInfo->type_id)
                                <option value="{{$type->id}}" selected="selected">{{$type->name}}</option>
                            @else
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endif
                        @else
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endisset
                    @endforeach
                @else
                    <option value="">Тип пива не добавлен в систему</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="manufacturer">Производитель</label>
            <select class="form-control" id="manufacturer" name="manufacturer_id">
                @if (count($manufacturers) > 0)
                    @foreach ($manufacturers as $manufacturer)
                        @isset ($beerInfo)
                            @if ($manufacturer->id == $beerInfo->manufacturer_id)
                                <option value="{{$manufacturer->id}}" selected="selected">{{$manufacturer->name}}</option>
                            @else
                                <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                            @endif
                        @else
                            <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                        @endisset
                    @endforeach
                @else
                    <option value="">Производители не добавлен в систему</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    </div>
@endsection