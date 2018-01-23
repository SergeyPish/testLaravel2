@extends('base')

@section('content')
    <div class="container">
    <form action="{{ $action }}" method="POST">
        {{csrf_field()}}
        @isset ($typeInfo->id)
            <input type="hidden" name="id" value="{{$typeInfo->id}}"/>
        @endif
        <div class="form-group">
            <label for="type">Название типа</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : isset($typeInfo->name) ? $typeInfo->name : ''}}" id="type" placeholder="Введите название типа">
            @if($errors->has('name')) <div class="text-danger">{{$errors->first('name')}}</div> @endif
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    </div>
@endsection